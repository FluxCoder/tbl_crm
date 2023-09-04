<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Password Class
 *
 * This class makes use of the password_hash function on peppered
 * passwords to make them a bit stronger.
 * 
 * @author James Roffey
 * @version 0.0.1
 * 
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