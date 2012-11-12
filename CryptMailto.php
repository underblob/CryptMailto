<?php

/**
 * @see examples.php
 */

class CryptMailto extends Crypt {

	public $passPhrase;

	public function __construct() {
		parent::__construct();
		$this->passPhrase 	= $this->_rndString();
	}

	/**
	 * @desc Find email addresses and convert them: <a class="mailto">[ENCRYPTEDEMAIL]</a>
	 * @param string $html_str
	 * @return string
	 */
	public function convertAnchors( $html_str ) {
		$emails 	= $this->_regexEmails( $html_str );
		$tags 		= array();
		foreach( $emails as $email ) {
			$tags[] 	= '<a class="mailto">' . $this->encrypt( $email, $this->passPhrase ) . '</a>';
		}
		$html_str 	= str_replace( $emails, $tags, $html_str );
		return $html_str;
	}

	/**
	 */
	public function encryptMailto( $str ) {
		return $this->encrypt( $str, $this->passPhrase );
	}

	public function encryptMailtoAnchor( $str ) {
		$tag 		= '<a class="mailto">' . $this->encryptMailto( $str ) . '</a>';
		return $tag;
	}

	/**
	 * @desc Extract all email addresses from an HTML string.
	 * @param string $html_str
	 * @return array
	 */
	private function _regexEmails( $html_str ) {
		preg_match_all(
			"/[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})/i",
			$html_str,
			$matches
		);
		return $matches[ 0 ]; // array.
	}

	/**
	 * @desc Return a random string.
	 * @param int $length - Optional: Desired length of string to return.
	 * @return string
	 */
	private function _rndString( $length=20 ) {
		$str 	= substr(
			str_shuffle( "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ" ),
			0,
			$length
		);
		return $str;
	}

}