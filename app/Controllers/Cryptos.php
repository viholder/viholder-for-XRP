<?php
namespace App\Controllers;

require   '/opt/bitnami/apache/htdocs/vh/crypto/ethereum/vendor/autoload.php';

use App\Controllers\AdminBaseController;
 

use Sop\CryptoTypes\Asymmetric\EC\ECPublicKey;
use Sop\CryptoTypes\Asymmetric\EC\ECPrivateKey;
use Sop\CryptoEncoding\PEM;
use kornrunner\Keccak;

class Cryptos extends AdminBaseController
{

    public $title = 'Cryptos';
    public $menu = 'cryptos';

    public function index()
    {
        $config = [
            'private_key_type' => OPENSSL_KEYTYPE_EC,
            'curve_name' => 'secp256k1'
        ];
        
        $res = openssl_pkey_new($config);
        
        if (!$res) {
            echo 'ERROR: Fail to generate private key. -> ' . openssl_error_string();
            exit;
        }
        
        openssl_pkey_export($res, $priv_key);
        
        $key_detail = openssl_pkey_get_details($res);
        $pub_key = $key_detail["key"];
        
        $priv_pem = PEM::fromString($priv_key);
        
        $ec_priv_key = ECPrivateKey::fromPEM($priv_pem);
        
        $ec_priv_seq = $ec_priv_key->toASN1();
        
        $priv_key_hex = bin2hex($ec_priv_seq->at(1)->asOctetString()->string());
        $priv_key_len = strlen($priv_key_hex) / 2;
        $pub_key_hex = bin2hex($ec_priv_seq->at(3)->asTagged()->asExplicit()->asBitString()->string());
        $pub_key_len = strlen($pub_key_hex) / 2;
        
        $pub_key_hex_2 = substr($pub_key_hex, 2);
        $pub_key_len_2 = strlen($pub_key_hex_2) / 2;
        
        $hash = Keccak::hash(hex2bin($pub_key_hex_2), 256);
        
        $wallet_address = '0x' . substr($hash, -40);
        $wallet_private_key = '0x' . $priv_key_hex;
        
        echo "\r\n   SAVE BUT DO NOT SHARE THIS (Private Key): " . $wallet_private_key;
        echo "\r\n   Address: " . $wallet_address . " \n";
        echo "\r\n  userID:". logged('id');
    }

}

