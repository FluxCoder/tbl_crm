<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Encryption Class
 *
 * 
 * @author James Roffey
 * @version 0.0.1
 * 
 */

class CustomEncryption {    

    /**
     * Encrypts a string and returns a URL safe version of the hash
     *
     * @param string $text
     * @return string
     */
    public function encrypt($text){
        $first_key = base64_decode(config_item('first_encryption_key'));
        $second_key = base64_decode(config_item('second_encryption_key'));    
        
        $method = "aes-256-cbc";    
        $iv_length = openssl_cipher_iv_length($method);
        $iv = openssl_random_pseudo_bytes($iv_length);
                
        $first_encrypted = openssl_encrypt($text,$method,$first_key, OPENSSL_RAW_DATA ,$iv);    
        $second_encrypted = hash_hmac('sha3-512', $first_encrypted, $second_key, TRUE);
        
        $output = $this->base64url_encode($iv.$second_encrypted.$first_encrypted);    

        return $output;  
    }


    /**
     * Returns decrypted version of hash
     *
     * @param string $text
     * @return string
     */
    public function decrypt($text){
        $first_key = base64_decode(config_item('first_encryption_key'));
        $second_key = base64_decode(config_item('second_encryption_key'));          
        $mix = $this->base64url_decode($text);
                
        $method = "aes-256-cbc";    
        $iv_length = openssl_cipher_iv_length($method);
                    
        $iv = substr($mix,0,$iv_length);
        $second_encrypted = substr($mix,$iv_length,64);
        $first_encrypted = substr($mix,$iv_length+64);
                    
        $data = openssl_decrypt($first_encrypted,$method,$first_key,OPENSSL_RAW_DATA,$iv);
        $second_encrypted_new = hash_hmac('sha3-512', $first_encrypted, $second_key, TRUE);
            
        if (hash_equals($second_encrypted,$second_encrypted_new))
        return $data;
            
        return false;
    }


    /**
     * Returns a Base64 encoded string that is URL safe
     *
     * @param string $text
     * @return string
     */
    function base64url_encode($text) { 
        return rtrim(strtr(base64_encode($text), '+/', '-_'), '='); 
    } 


    /**
     * Returns a string that was Base 64 encoded with URL safety
     *
     * @param string $text
     * @return string
     */
    function base64url_decode($text) { 
        return base64_decode(str_pad(strtr($text, '-_', '+/'), strlen($text) % 4, '=', STR_PAD_RIGHT)); 
    } 



}