<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Security extends CI_Model
{
    public function encryptor($action, $string) {
        $secret_key = 'U7W4YTRVWIU3YNRW3YVRYT38RVYB3287TBR980ERGBFOF9FN';
        $secret_iv = '5VD6B8AEN1DB6D68DH23DQSEHGR885MK';
     
        $output = false;
        $encrypt_method = "AES-256-CBC";
        // hash
        $key = hash('sha256', $secret_key);
        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
     
        //do the encyption given text/string/number
        if( $action == 'e' ) {
            $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
            $output = base64_encode($output);
        }
        else if( $action == 'd' ){
            //decrypt the given text/string/number
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        }
     
        return $output;
    }
}
?>