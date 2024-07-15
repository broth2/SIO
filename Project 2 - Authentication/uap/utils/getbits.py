
def stringtoBits(st):
     """Commented lines switch to bytearray"""
     bytese = st.encode()
     res2=""
     for mb in bytese:
          res='{0:08b}'.format(mb)
          res2+=res
          n=int(res,2)
     tmp=int(res2,2)
     final=bin(tmp)
     return final.replace('b','')

def bitsToString(bins):
     return ''.join(chr(int(''.join(x), 2)) for x in zip( * [iter(bins)] * 8))
     