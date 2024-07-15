import os
import random
import json
from cryptography.hazmat.primitives.kdf.pbkdf2 import PBKDF2HMAC
from cryptography.hazmat.primitives.ciphers import Cipher, algorithms, modes
from cryptography.hazmat.primitives import padding, hashes

class Enc():
    def __init__(self, pw):
        self.pw = pw

    def pad_it(self, content):
        # codifica e mete padding numa string
        padder = padding.PKCS7(128).padder()
        padded_data = padder.update(content.encode()) + padder.finalize()
        return padded_data

    def unpad_it(self, content):
        # tira o padding e descodifica um byte array
        unpadder = padding.PKCS7(128).unpadder()
        data = unpadder.update(content) + unpadder.finalize()
        return data.decode()

    def crypt_it(self, content, chave, iv):
        cipher = Cipher(algorithms.AES(chave), modes.CBC(iv))
        encryptor = cipher.encryptor()
        unreadable_data = encryptor.update(content) + encryptor.finalize()      
        return unreadable_data

    def dcrypt_it(self, content, chave, ivt):
        cipher = Cipher(algorithms.AES(chave), modes.CBC(ivt))
        decryptor = cipher.decryptor()
        readable_data = decryptor.update(content) + decryptor.finalize()
        return readable_data

    def gen_key(self, size):
        return ''.join(chr(random.randint(0, 0xFF)) for i in range(size))
    
    def compute_key(self, password, salt):
        kdf = PBKDF2HMAC(algorithm=hashes.SHA256(), length=32, salt=salt, iterations=100000)
        key = kdf.derive(password.encode())
        return key[:16]

    def encrypt(self, payload, chave, iv):
        return self.crypt_it(self.pad_it(payload), chave, iv)

    def decrypt(self, payload, chave, iv):
        return self.unpad_it(self.dcrypt_it(payload, chave, iv))

    def encrypt_file(self, content):
        with open('local_db/data.json', 'wb') as outfile:
            iv = os.urandom(16)
            salt = os.urandom(16)
            outfile.write(iv)
            outfile.write(salt)
            outfile.write(self.encrypt(json.dumps(content), self.compute_key(self.pw, salt), iv))

    def decrypt_file(self):
        with open('local_db/data.json', 'rb') as infile:
            iv = infile.read(16)
            salt=infile.read(16)
            chave=self.compute_key(self.pw, salt) 
            f = infile.read()
        basic_string = self.decrypt(f,chave,iv)
        lista = json.loads(basic_string)

        return lista

    def check_dns(self, dns):
        content = self.decrypt_file()
        for entry in content:
            if dns==list(entry.keys())[0]:
                return content
        return None
    

    def insert_dns(self, dns, username, password):
        if self.check_dns(dns):
            tdic={"username":username}
            tdic["password"]=password
            dns_list= self.decrypt_file()
            for item in dns_list:
                if dns in item:
                    item[dns].append(tdic)
            self.encrypt_file(dns_list)
            return None

        dic = {
            dns:[{
                "username":username,
                "password":password
            }]
        }

        dns_list = self.decrypt_file()
        dns_list.append(dic)
        self.encrypt_file(dns_list)
    
    def remove_dns(self,dns,username,id):
        nid=int(id)-1
        if self.check_dns(dns):
            dns_list = self.check_dns(dns)
            for entry in dns_list:
                if dns in entry :
                    entry[dns].pop(nid)
                    break
            self.encrypt_file(dns_list)
            
    
    def edit_dns(self,dns,username,password,id):
        if self.check_dns(dns):
            self.remove_dns(dns,username,id)
            self.insert_dns(dns,username,password)

    def get_dns_data(self, dns):
        data = self.check_dns(dns)
        if not data:
            return None
        
        for entry in data:
            if dns==list(entry.keys())[0]:
                return entry[dns]
         
        return None
        

