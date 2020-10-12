<?php

namespace Jowath\Helper;

class Cipher
{
	const SALTSIZE = 8;
	const KEYSIZE = 32;
	const IVSIZE = 16;

	const PASSPHRASE = "ET49z296DkbH29WGNtT+r1wVTR9uvH7wO6qR6X/kRzmT/IuMAfhXTJMTSf2ZsFQxkPG9vASLxMdWBZBQKBgDA06yPfgVbiGBcRqqEvYogXlw9NjQSNA+1Y0tImM/AYTUd8dPb0Rcod4S4qcUAv9nD0zvqaAoOoea3zQvqDnUtAuMoT34/lFI/ipgrFzViNAweP5Bws/5bniqm5hp7XCOA0Upy23IGrPQKVRT0dLpqDpS/gWPs4y0bH67eMSEXfAoGAYQ4wE1cjU4zj2wgdjiB/JFzW+FbEXqDVYzvh6jjgf0OeGVqKn8qbRrKX6lHaKYn2i3G5QhYapVQyD/3oQsLEVY4TCVJocNRuwNX1d8Wz168vycHFniON7XHwSS4usI+maFn41T239ahjwYe5V2O0ObsT/yADb2ZU+H2TOz4BliY=";

	private $lastError;

	public function __construct()
	{
	    $this->lastError = "";
	}

    /**
     * encrypts data with OpenSSL AES standards
     * @param $passphrase
     * @param $data
     * @return string
     */
	public function encryptAES($data, $passphrase = ""){

	    if($passphrase === ""){
	        $passphrase = self::PASSPHRASE;
        }
		
		$salt = openssl_random_pseudo_bytes(self::SALTSIZE);
		
		$derived_keys = $this->EVP_BytesToKey($salt, $passphrase, 'sha1');

		$prepared_key = $derived_keys['key'];
		$iv = $derived_keys['iv'];

		$ciphertext_b64 = base64_encode("Salted__".$salt.openssl_encrypt($data,"AES-256-CBC", $prepared_key,OPENSSL_RAW_DATA, $iv));
		
		return $ciphertext_b64;

		//end of encryptAES function
	}

    /**
     * decrypts data with OpenSSL AES standards
     * @param $passphrase
     * @param $data
     * @return string
     */
	public function decryptAES($data, $passphrase = ""){

        if($passphrase === ""){
            $passphrase = self::PASSPHRASE;
        }

		$data = base64_decode($data);
		
		if(substr($data,0,8) === "Salted__"){
			$salt = substr($data,8,self::SALTSIZE);
			$data = substr($data,8+self::SALTSIZE);
		}else{
		    $this->lastError = "Could not find salt";
			return false;
		}
		
		$derived_keys = $this->EVP_BytesToKey($salt, $passphrase, 'sha1');

		$prepared_key = $derived_keys['key'];
		$iv = $derived_keys['iv'];

		$plainText = openssl_decrypt($data,"AES-256-CBC", $prepared_key,OPENSSL_RAW_DATA, $iv);

		return $plainText;

		//end of decryptAES function
	}

    /**
     * generates an encryption key and an initialization vector
     * @param $salt
     * @param $password
     * @param $cipher
     * @return array
     */
	public function EVP_BytesToKey($salt, $password, $cipher) {
	    
	    $bytes = "";
	    $last = "";

	    // 32 bytes key + 16 bytes IV = 48 bytes.
	    $byte_length = self::IVSIZE + self::KEYSIZE;

	    while(strlen($bytes) < $byte_length) {
	        $last = hash($cipher, $last . $password . $salt, true);
	        $bytes.= $last;
	    }

	    $key = mb_substr($bytes, 0, self::KEYSIZE, '8bit');
		$iv = mb_substr($bytes, self::KEYSIZE, self::IVSIZE, '8bit');

		$keys = array('key' => $key, 'iv' => $iv);

		return $keys;
	}

	//end of class
}

?>