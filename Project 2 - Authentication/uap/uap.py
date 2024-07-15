from json import encoder
from math import trunc
from typing import Tuple
from requests.models import Response
from flask import Flask, url_for, request, render_template, make_response,  abort, redirect, session
from markupsafe import escape
from werkzeug.exceptions import BadRequestKeyError
from utils.encrypt import Enc
import json, requests, random, string, hashlib
from utils.digest import *
from utils.getbits import *
import html,cgi


app = Flask(__name__, static_folder="static")
app.config.from_file("local_db/configs.json", load=json.load)

@app.route("/contents")
def display_all():
    #rota apenas para debug
    encoder = Enc("xgorda")
    all_credentials=encoder.decrypt_file()
    session['content'] = all_credentials #session é um dic do flask que vai guardar os dados da sessão
    return render_template('all_content.html', data=session['content'])

@app.route('/access', methods=['POST', 'GET'])
def access():
    if request.method=="POST":
        dns_server = session['visitor'] 

        if 'content' in request.form:
            password = request.form["content"] 
            encoder = Enc(password)
            session['pw']= password 


            try:  #descodificar a base de dados, vê se a encryptation key está bem
                credentials=encoder.get_dns_data(dns_server)
                session["credencials"] = credentials
                return render_template('content.html', data=credentials)
            except ValueError:
                return render_template('access.html', l="Incorrect Decryption Password")
                
        elif 'addform' in request.form:
            encoder=Enc(session['pw'])
            encoder.insert_dns(session['visitor'], request.form["email"], request.form["password"])
            credentials=encoder.get_dns_data(dns_server)
            return render_template('content.html',data=credentials)


        elif 'deleteform' in request.form:
            encoder=Enc(session['pw'])
            encoder.remove_dns(session['visitor'], request.form["delete_email"],request.form["deid"])
            credentials=encoder.get_dns_data(dns_server)
            return render_template('content.html',data=credentials)


        elif 'editform' in request.form:
            encoder=Enc(session['pw'])
            encoder.edit_dns(session['visitor'], request.form["edit_email"], request.form["edit_password"],request.form["edid"])
            credentials=encoder.get_dns_data(dns_server)
            return render_template('content.html',data=credentials)

        return render_template('content.html',data=session["credencials"])

    elif request.method=="GET":
        session['visitor'] = "http://"+request.args.get("link") #link de quem acede
        return render_template('access.html') 
    else:
        abort(412)


@app.route('/choose',methods=['POST', 'GET'])
def choose():
    if request.args.get("idx"):
        idx = int(request.args.get("idx"))
        validation = validate_credentials(session["credencials"][idx]["username"], session["credencials"][idx]["password"])
        print("validation: ", validation)
        if validation:
            return redirect(session['visitor'])
        else:
            abort(401)

@app.errorhandler(412)
def not_found(error):
    resp = make_response(render_template('auth_failed.html', error=412, l="Cannot handle this request"), 412)
    return resp

@app.errorhandler(401)
def not_found(error):
    resp = make_response(render_template('auth_failed.html', error=401, l="Invalid Login Credentials(protocol fail)"), 401)
    return resp

def validate_credentials(un, pw):
    un = {1:un}
    reqs_session = requests.session()
    r = reqs_session.post(session['visitor'], json=un) #estabelece a comunicacao

    #Handle ao response
    if r.status_code==200: #analisar os dados 
        pw_md5 = hashlib.md5(pw.encode()).hexdigest()
        challenge_response = digest_function(r.text+pw_md5)
        position = 0
        errors = False
        good_ending=True
        challenge_bits =  stringtoBits(challenge_response)
        for i in range(app.config["BITS_TRADED"]):
            if not errors:
                if position !=0 and position==eval(r.text)[0]:
                    if challenge_bits[i]!=eval(r.text)[1]:
                        errors=True
                        print("[UAP]Rejected", eval(r.text)[1])
                    else:
                        print("[UAP]Accepted", eval(r.text)[1])
                    position += 1
                    continue
                elif position != 0 and eval(r.text)[0]+1==app.config["BITS_TRADED"]:
                    errors=True
                    print("[UAP]Rejected extra bit...")
                if position!=0 and eval(r.text)[0]%2==0:
                    errors=True
                    print("[UAP]Rejected, there are more bits...", eval(r.text)[1])
                    misinformation = random.randint(0,1)
                    print("[UAP]Sending:", misinformation)
                    r = reqs_session.post(session['visitor'], json=str((position, misinformation)))
                    position +=1
                else:
                    r = reqs_session.post(session['visitor'], json=str((position, challenge_bits[i])))
                    position +=1
            else:
                misinformation = random.randint(0,1)
                print("[UAP]Sending:", misinformation)
                r = reqs_session.post(session['visitor'], json=str((position, misinformation)))
                position +=1
        
        response_size = eval(r.text)[0]
        if response_size+1 != app.config["BITS_TRADED"]:
            good_ending = False

        print(not errors , good_ending)
        if not errors and good_ending:
            print("uap accepts")
        else:
            print("uap rejects")
        #ter good ending false quer dizer que se quiser posso abusar do outro
        #ter errors true quer dizer que o outro pode nos abusar
        return not errors and good_ending
        
    elif r==400:
        render_template("username_not_found.html")


#no caso de se mandar um numero impar de bits:
#   o uap estar a espera de 25 bits, o server estar a espera de 26 bits:
#       o server vai deixar o uap se autenticar porque nao recebe resposta ao seu http post response, acha que foi aceite
#       o uap sabe que o server mandou um bit a mais, autentica-se se quiser, mas se quiser pode rejeitar o server
#   o uap estar a espera de 25 bits, o server estar a espera de 24 bits:
#       o server vai reparar que vem um bit a mais e vai bloquear o uap
#       o uap recebe um bit a mais e vai bloquear o server
#no caso de se mandar um numero par de bits:                                ->unicos que podem acontecer
#   o uap estar a espera de 24 bits, o server estar a espera de 25 bits:
#       o server nao chega a receber o ultimo bit, entao nao ativa a flag good ending, vai bloquear o uap, mas se for malicioso pode ter acesso aos dados
#       o uap aceita o ultimo bit, para ele esta tudo bem e espera ter acesso ao server
#   o uap estar a espera de 24 bits, o server estar a espera de 23 bits:
#       o server manda o seu ultimo bit, mas vai receber uma resposta que considera errado e bloqueia o uap
#       o uap repara que recebe um indice par, bloqueia o server e manda um random

#print(request.base_url)
#print(request.remote_addr)