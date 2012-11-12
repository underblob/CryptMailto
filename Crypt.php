<?php

/*
DOCUMENTATION

To instantiate the class:
include( 'path/to/Crypt.php' );
$Crypt = new Crypt();

To encrypt a string:
$encrypted_string = $Crypt->encrypt( $string_to_encrypt, $secret_passphrase );

To decrypt a string:
$decrypted_string = $Crypt->decrypt( $encrypted_string, $secret_passphrase );

*/

class Crypt {

	public function __construct() {}

	/**
	 * @desc Decodes a string from base64.
	 * @param string $data
	 * @return string
	 */
	public function decodeBase64( $data ) {
		$base_64 	= strtr( $data, '-_', '+/' );
		return base64_decode( $base_64 );
	}

	/**
	 * @desc Decrypt data string using key.
	 * @param string $data
	 * @param string $key
	 * @return string
	 */
	public function decrypt( $data, $key ) {
		$result 	= '';
		//$data 	= $this->decodeBase64( $data );
		$data 		= base64_decode( $data );
		for ( $i = 0;  $i < strlen( $data );  $i++ ) {
			$char 		= substr( $data, $i, 1 );
			$key_char 	= substr( $key, ( $i % strlen( $key ) ) -1, 1 );
			$char 		= chr( ord( $char ) - ord( $key_char ) );
			$result 	.= $char;
		}
		return $result;
	}

	/**
	 * @desc Encodes a string in base64.
	 * @param string $data
	 * @return string
	 */
	public function encodeBase64( $data ) {
		$base_64 	= base64_encode( $data );
		return strtr( $base_64, '+/', '-_' );
	}

	/**
	 * @desc Encrypt data string using key.
	 * @param string $data
	 * @param string $key
	 * @return string
	 */
	public function encrypt( $data, $key ) {
		$result 	= '';
		for ( $i = 0;  $i < strlen( $data );  $i++ ) {
			$char 		= substr( $data, $i, 1 );
			$key_char 	= substr( $key, ( $i % strlen( $key ) ) -1, 1 );
			$char 		= chr( ord( $char ) + ord( $key_char ) );
			$result 	.= $char;
		}
		//return $this->encodeBase64( $result );
		return base64_encode( $result );
	}

}

