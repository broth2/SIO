# project-2---authentication-equipa_30

This project consisted in developing a challenge-response authentication protocol and a User Authentication Application (UAP) for a Web
Application using Flask.


## How to run

### uap
```
cd uap
export FLASK_APP=uap
flask run
```

### app_auth
```
cd app_auth
docker-compose build
docker-compose up
```
wait up to 4 minutes for database to initialize

### Addresses

UAP: http://127.0.0.1:5000
App: http://127.0.0.1:9090
App Flask Api: http://170.2.0.4:5000


## UAP

For our UAP we chose to use an encrypted JSON file as a database (`data.json`). It consists of a list of dictionaries, in each entry
has a DNS as a key and a list as a value. This is a list of more dictionaries, each dictionary is a user/password combination for that
DNS. We assume the database is already populated and that the access password is *xgorda*. The */access* route will handle first time and
recurrent visits and decode the database in order to represent the data. The */choose* route will be used after the user selects a pair 
of credentials. After the user inputs the correct encryption password, all the username/password pairs for the DNS that redirected to the
*UAP* are presented. The user may remove, add or edit any of them. The next logical step is to choose one to begin the protocol.

## Encryption

Our JSON file is encrypted with AES. In order to calculate the encryption key, we created a *compute_key* function that mixes the
database's password and a random salt. We create a 32 bits long *PBKDF2HMAC* object (bit key) with 100000 iterations using SHA256 and the
salt. Then, we compute the encryption key using the *derive* method from the Python *cryptography* library with the encoded password as
argument. This will generate a 128 bit key for the AES algorithm, the IV is also 16 random bytes, the same as the salt. We make sure that
the data we are going to encrypt is padded, encrypt it and write it to the file. Before this write, we write the IV and salt, to make 
decryption possible.

## Decryption

The process of decrypting the file is symmetric to the encryption's. We start by reading the first 16 bytes corresponding to the IV and
the next 16 corresponding to the salt. With both of these, we can calculate the same encryption key, and with that we decrypt with the
AES algorithm and remove the padding.

## E-Chap Protocol

With HTTP Request and Responses we produce our E-Chap. We chose a total of 66 bits traded (number that can be changed in our 
`configs.json`).When choosing a number (**N**) between 1 and 512, multiple of 8, we wanted a small even number. Small because the
probability of someone guessing our number was (1/2)^**N** and even because our protocol relies on sending on the *UAP* sending HTTP 
Requests and receiving HTTP Responses. An even number prevents that any bit is stuck with a non-reply, although some code was made to 
handle most of that problem. A simplified run down of our protocol is as follows: the user is redirected to the *UAP's* main page, where 
they are asked to insert the database password, after that the user must select a pair of username/password credentials, the *UAP* then 
starts the protocol with a HTTP Post request with the username to whoever(the app authentication server) accessed it's main page. This 
first message is a dictionary, to distinguish from all the others. 
The server receives the username and creates a digest with it, a digest with the username's digest and the corresponding
password and also checks if the user is present in the server's database. The server, through a HTTP Post response, send the username's
digest to the *UAP*. After receiving this, the server's challenge, the *UAP* creates its own, which is a digest of this and the user's
password, if they have the same password on each end, the *UAP's* challenge should be the same and the digest calculated on the server.
What now follows are **N**/2 HTTP Post Requests, sent by the *UAP*, in which each request has a bit of the challenge, and each response
will have the following bit. The bits represent the bits in the *UAP's* challenge. Each side will compare the incoming bit to what its
expecting, if it doesn't match, the protocol is not aborted, the side that detected the error just sends a random bit. Two variables were
created on each side, one to represent if wrong bits were detected(*errors*) and another to represent if a every bit was received as 
expected(*good_ending*). On the server side, these variables are specific for a certain *UAP* address. After all bits are traded, and the 
*UAP* considers the connection valid, a redirect occurs, if the variables specific to the *UAP's* address mentioned earlier indicate the 
connection is valid, another redirect happens, this time to a specific PHP page that will log the user in based on the username. We 
assume that this last connection, between the server's flask api and the PHP page is always secure. 
NOTE: although username is mentioned, in our implementation an email is being used.

## Data Encryption - Digest

Our digest funcion starts by shuffling the letters in a given string.Note that the shuffle process could not be made in a random way, 
so therefore we could check if a certain digest was correct or not. The shuffled string is then encrypted with a *SHA-256* algorithm,
the resulting hexadecimal characters are then shuffled again.

## Server

The server was devolped as a flask API much like the *UAP*. There is only one route, to handle the Get requests for authentication
validation and the Post requests for the protocol. 


### Members 
Nome          | Nmec    | %
------------- | ------- | --------------
Artur Romão   | 98470   | 25%
Mariana Rosa  | 98390   | 25%
Nuno Fahla    | 97631   | 25%
Paulo Pereira | 98430   | 25%
