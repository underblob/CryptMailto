
/*

==================================================
DEPENDENCIES
Must include <script> for Crypt.js _BEFORE_ inclusion of this script.
Must include <script> for jQuery _BEFORE_ inclustion of this script.
This class extends the Crypt class.
This Javascript class works in conjunction with the CryptMailto PHP class.

@see Crypt.js
@see CryptMailto.php

Example:
 <script src="http://code.jquery.com/jquery-latest.js"></script>
 <script src="js/Crypt.js"></script>
 <script src="js/CryptMailto.js"></script>

==================================================
USAGE
If all of the emails have been converted using the CryptMailto PHP class,
they can all be decoded by putting this <script> at the bottom of your page:

<script>
	var CM = new CryptMailto();
	CM.decryptMailtags( '<?=$CryptMailto->passPhrase ?>' );
</script>


*/

if ( typeof CryptMailto === 'undefined' ) {
	var CryptMailto 		= function() {};
	CryptMailto.prototype 	= new Crypt();
}

/**
 * @desc Decrypt anchor tag so it's readable.
 * @param $anchor object - Expects a jQuery object: <a class="mailto">ENCRYPTEDEMAIL</a>.
 * @return object - jQuery object.
 */
CryptMailto.prototype.decryptMailTag = function( $anchor, key ) {
	var encEmail 	= $anchor.text();
	var decEmail 	= this.decrypt( $anchor.text(), key );
	$anchor.attr( {
		'href' 	: 'mailto:' +decEmail
	} ).text( decEmail );

	return $anchor;
};

/**
 * @desc Decrypt all the anchor tags on a page with .mailto class: <a class="mailto">ENCRYPTEDEMAIL</a>.
 * @param string key
 */
CryptMailto.prototype.decryptMailTags = function( key ) {
	var $anchors 	= $( 'a.mailto' ),
		self 		= this;
	$.each( $anchors, function( index, elem ) {
		elem 	= self.decryptMailTag( $( elem ), key );
	} );
}
