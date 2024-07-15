from flask import Flask, url_for, request, render_template, make_response,  abort, redirect, session, jsonify
import os, json, requests, random, string, hashlib, ssl, pymysql.cursors
from utils.digest import *
from utils.getbits import *

app = Flask(__name__, static_folder="static")
app.config['SERVER_NAME'] = "170.2.0.4:5001"
#app.config['SERVER_NAME'] = "127.0.0.2:5001"
app.config['SECRET_KEY'] = "yesfinance"
app.config["BITS_TRADED"] = 66
app.config["com_errors"] = False
app.config["good_ending"] = False
db = pymysql.connect(user='user', password='user',  host='170.2.0.2', port=3306, database='Lokals', cursorclass=pymysql.cursors.DictCursor) 
#db = pymysql.connect(user='user', password='user',  host='localhost', port=9999, database='Lokals', cursorclass=pymysql.cursors.DictCursor)   

    
@app.route('/server_auth', methods=['POST', 'GET']) # -> Parte do protocolo
def sever_auth(): 

    if request.method == 'POST':
        request_content=request.get_json()
        
        if isinstance(request_content, dict) and user_in_db(request_content["1"]): #Se for dic significa que e a 1a. mensagem
            app.config[request.remote_addr+"_errors"]= False
            app.config[request.remote_addr+"_good_ending"]= False
            app.config[request.remote_addr+"_usrnm"] = request_content["1"]
            
            dun = digest_function(request_content["1"])
            session["dun"] = dun
            session["passyword"] = user_in_db(request_content["1"])
            session["dunpw"] = stringtoBits(digest_function(dun + session["passyword"]))
            return dun, 200 #reply

        elif isinstance(request_content, str): #as outras sao bits
            request_content = eval(request_content)
            if not app.config[request.remote_addr+"_errors"] and request_content[0]<app.config["BITS_TRADED"]:
                if session["dunpw"][request_content[0]]!=request_content[1]:
                    app.config[request.remote_addr+"_errors"]=True
                    print("[SRV]Rejected", request_content[1])
                    misinformation = random.randint(0,1)
                    print("[SRV]Sending:", misinformation)
                    return str((request_content[0]+1, misinformation)), 200
                else:
                    print("[SRV]Accepted", request_content[1])
                    if request_content[0]+1>=app.config["BITS_TRADED"]:
                        print("[SRV]Last bit ack, sending random...")
                        app.config[request.remote_addr+"_good_ending"] = True
                        return str((request_content[0],random.randint(0,1))), 200
                    else:
                        if request_content[0]+2==app.config["BITS_TRADED"]:
                            print("impresao ultimo bit")
                            app.config[request.remote_addr+"_good_ending"]=True
                        return str((request_content[0]+1,session["dunpw"][request_content[0]+1])), 200
            else:
                app.config[request.remote_addr+"_errors"]=True
                misinformation = random.randint(0,1)
                print("[SRV]Sending:", misinformation)
                return str((request_content[0]+1, misinformation)), 200
        else:
            return "", 501
            
    elif request.method == 'GET':
        vldnt = not app.config[request.remote_addr+"_errors"] and app.config[request.remote_addr+"_good_ending"]
        print("validation:", vldnt)
        if vldnt:
            return redirect(f"http://127.0.0.1:9090/final_auth.php?user={app.config[request.remote_addr+'_usrnm']}")
        else:
            return f"<a>validation for {request.remote_addr}: {vldnt} </a>"



def user_in_db(mail):
    crsr = db.cursor()
    #mail = "'cheese@burger.com'"
    crsr.execute(f"SELECT * FROM users WHERE email='{mail}'")
    results = crsr.fetchall()
    if len(results)==1:
        return results[0]["password_"]
    

if __name__ == '__main__':                                                    
    app.run()

