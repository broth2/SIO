import hashlib



def shuffle(str):

    shuffle_str = []
    #shuffling the string
    if len(str) % 2 == 0:
        #dividir em grupos de 2
        splits = [str[i:i+2] for i in range(0, len(str),2)]
        for s,i in splits: 
            shuffle_str.append(i)
            shuffle_str.append(s)

        #print(shuffle_str)
           
    #se for impar

    else:
        save_caracter = str[-1]
        str_par = str[:-1]
        #fazer o mesmo com todas as letras menos com a ultimna

        splits = [str_par[i:i+2] for i in range(0, len(str_par),2)]
        for s,i in splits: 
            shuffle_str.append(i)
            shuffle_str.append(s)

        shuffle_str.append(save_caracter)
        #print(shuffle_str)
    str_shuffled ="".join(shuffle_str)
    return str_shuffled




def digest_function(str):
    shuffle_str = shuffle(str)
    hash_str= hashlib.sha256(shuffle_str.encode()).hexdigest()
    digest_concat = shuffle(hash_str) #diminui as probabilidades de ser descoberto
    #print(digest_concat)
    return digest_concat

def check_equal_digest(digested, str):
    str_to_digest = digest_function(str)
    
    if str_to_digest == digested:
        return True
    
    else:
        return False
        