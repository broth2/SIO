import boto3
import random

def publish_text_message(phone_number, message):
    client = boto3.client('sns', 'eu-west-3')
    client.publish(PhoneNumber=phone_number, Message=message)


def gen_pass_code():
    pass_code = ""
    for i in range(5):
        pass_code += str(random.randint(0,9))
    return pass_code

message = "Your pass code is: " + gen_pass_code()

publish_text_message("+351XXXXXXXXX", message)