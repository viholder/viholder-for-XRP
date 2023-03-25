import sys
import mysql.connector
import xrpl

from xrpl.account import get_balance
from xrpl.clients import JsonRpcClient
from xrpl.models.requests import Tx
from xrpl.models.transactions import Payment
from xrpl.transaction import (
    safe_sign_and_autofill_transaction,
    send_reliable_submission,
)

if len(sys.argv) > 1:   
    rpc_url = sys.argv[1]
    contractID = sys.argv[2]
    userID = sys.argv[3]
    walletID = sys.argv[4]
 
from xrpl.clients import JsonRpcClient
JSON_RPC_URL = rpc_url
client = JsonRpcClient(JSON_RPC_URL)


from xrpl.core import keypairs
seed = keypairs.generate_seed()
public, private = keypairs.derive_keypair(seed)
test_account = keypairs.derive_classic_address(public)
 
wallet_from_seed = xrpl.wallet.Wallet(seed, 0)
 

 
mydb = mysql.connector.connect(
    host="127.0.0.1",
    user="",
    password="",
    database=""
    )

print ("connected")

 

mycursor = mydb.cursor()

sql = ("UPDATE contracts SET  contract_address ='"+wallet_from_seed.classic_address+"' where id='"+contractID+"'")
sql2 = ("UPDATE wallets SET  wallet_address ='"+wallet_from_seed.classic_address+"', wallet_public ='"+public+"', wallet_key ='"+private+"', wallet_seed ='"+seed+"',  wallet_currency ='XRP' where id='"+walletID+"'")
 
mycursor.execute(sql2)

mydb.commit()

print ("ok")

   


 
