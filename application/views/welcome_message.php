<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Password Class
 *
 * This class makes use of the password_hash function on peppered
 * passwords to make them a bit stronger.
 * 
 * @author James Roffey
 */

class Password {

	/* Default is 10  */
	protected $_cost = 10;


	/* Default is PASSWORD_BCRYPT  */
	protected $_algo = PASSWORD_BCRYPT;


	/**
	 * Returns a hashed password
	 * 
	 * This will first pepper the password for added security
	 * 
	 * @param string $password
	 * @return string
	 */
	public function hash($password){
		$password_peppered = hash_hmac("sha256", $password, config_item('pepper'));
		$password_hashed = password_hash($password_peppered, $this->_algo, ['cost' => $this->_cost]);
		echo '<hr />'.$password_peppered.'<br />';
		return $this->base64_url_encode($password_hashed);
	}


	/**
	 * Verify if text matches hash
	 *
	 * @param string $password
	 * @param string $hash
	 * @return bool
	 */
	public function verify_hash($password, $hash){
		$password_peppered = hash_hmac("sha256", $password, config_item('pepper'));
		echo '<hr />'.$password_peppered.'<br />';
		return password_verify($password_peppered, $this->base64_url_decode($hash));
	}


	/**
	 * Returns Base64 "URL" encoded string
	 * 
	 * I'm using this function here as it helps to hide what encryption
	 * method is being used.
	 *
	 * @param string $input
	 * @return string
	 */
	function base64_url_encode($input) {
		return strtr(base64_encode($input), '+/=', '._-');
	}
	

	/**
	 * Returns dcoded Base64 encoded "URL" string
	 * 
	 * I'm using this function here as it helps to hide what encryption
	 * method is being used.
	 *
	 * @param string $input
	 * @return string
	 */
	function base64_url_decode($input) {
		return base64_decode(strtr($input, '._-', '+/='));
	}
	   
}

$password = new password;

$password_hash = $password->hash('password123');

if($password->verify_hash('password123',$password_hash)){
	echo 'yes';
} else {
	echo 'no';
}

echo '<br /><br />'.$password_hash.'<br />';

// $pepper = 'ihieuhgiueg';
// $pwd = 'test123';
// echo hash_hmac("sha256", $pwd, $pepper);

?>
<br><br><br><br><br>
<?php

// Store a string into the variable which
// need to be Encrypted
$simple_string = "Welcome to GeeksforGeeks\n";

// Display the original string
echo "Original String: " . $simple_string;

// Store the cipher method
$ciphering = "AES-128-CTR";

// Use OpenSSl Encryption method
$iv_length = openssl_cipher_iv_length($ciphering);
$options = 0;

// Non-NULL Initialization Vector for encryption
$encryption_iv = '1234567891011121';

// Store the encryption key
$encryption_key = "GeeksforGeeks";

// Use openssl_encrypt() function to encrypt the data
$encryption = openssl_encrypt($simple_string, $ciphering,
			$encryption_key, $options, $encryption_iv);

// Display the encrypted string
echo "Encrypted String: " . $encryption . "\n";

// Non-NULL Initialization Vector for decryption
$decryption_iv = '1234567891011121';

// Store the decryption key
$decryption_key = "GeeksforGeeks";

// Use openssl_decrypt() function to decrypt the data
$decryption=openssl_decrypt ($encryption, $ciphering,
		$decryption_key, $options, $decryption_iv);

// Display the decrypted string
echo "Decrypted String: " . $decryption;

?>
<hr />
<?php
// Save The Keys In Your Configuration File
define('FIRSTKEY','Lk5Uz3slx3BrAghS1aaW5AYgWZRV0tIX5eI0yPchFz4=');
define('SECONDKEY','EZ44mFi3TlAey1b2w4Y7lVDuqO+SRxGXsa7nctnr/JmMrA2vN6EJhrvdVZbxaQs5jpSe34X3ejFK/o9+Y5c83w==');
?>

<?php
function secured_encrypt($data)
{
	global $password;
$first_key = base64_decode(FIRSTKEY);
$second_key = base64_decode(SECONDKEY);    
    
$method = "aes-256-cbc";    
$iv_length = openssl_cipher_iv_length($method);
$iv = openssl_random_pseudo_bytes($iv_length);
        
$first_encrypted = openssl_encrypt($data,$method,$first_key, OPENSSL_RAW_DATA ,$iv);    
$second_encrypted = hash_hmac('sha3-512', $first_encrypted, $second_key, TRUE);
            
// $output = $password->base64_encode($iv.$second_encrypted.$first_encrypted);    
$output = base64url_encode($iv.$second_encrypted.$first_encrypted);    

// return strtr(base64_encode($iv.$second_encrypted.$first_encrypted), './-', '+#=');
return $output;        
}
$hashnew = secured_encrypt('test');
echo $hashnew.'<br />';

function secured_decrypt($input)
{
$first_key = base64_decode(FIRSTKEY);
$second_key = base64_decode(SECONDKEY);            
$mix = base64url_decode($input);
        
$method = "aes-256-cbc";    
$iv_length = openssl_cipher_iv_length($method);
            
$iv = substr($mix,0,$iv_length);
$second_encrypted = substr($mix,$iv_length,64);
$first_encrypted = substr($mix,$iv_length+64);
            
$data = openssl_decrypt($first_encrypted,$method,$first_key,OPENSSL_RAW_DATA,$iv);
$second_encrypted_new = hash_hmac('sha3-512', $first_encrypted, $second_key, TRUE);
    
if (hash_equals($second_encrypted,$second_encrypted_new))
return $data;
    
return 'nope';
}
echo secured_decrypt($hashnew);

function base64url_encode($data) { 
	return rtrim(strtr(base64_encode($data), '+/', '-_'), '='); 
  } 
  
  function base64url_decode($data) { 
	return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT)); 
  } 
?>