CryptMailto Documentation
=========================


Crypt.php
---------

**Instantiate**
```php
	include_once( 'Crypt.php' );
	$Crypt = new Crypt();
```

**Crypt::decrypt**( string *$data*, string *$key* )  
returns string  
Decrypt a string using the same key from the encryption.  

**Crypt::encrypt**( string *$data*, string *$key* )  
returns string  
Encrypt a string using a key.  


CryptMailto.php
---------------

**Instantiate**
```php
	include_once( 'Crypt.php' );
	include_once( 'CryptMailto.php' );
	$CM = new CryptMailto();
```

**CryptMailto::passPhrase** string  
This random key is generated everytime **CryptMailto** is intantiated.  

**CryptMailto::convertAnchors**( string *$html* )  
returns string  
Finds all email addresses in a string and formats them as anchors:  
```html
	<a class="mailto">ENCRYPTEDEMAIL</a>
```

**CryptMail::encryptMailto**( string *$str* )  
returns string  
Encrypts a string.  

**CryptMail::encryptMailtoAnchor**( string *$str* )  
returns string  
Encrypts a string and formats it as an anchor:  
```html
	<a class="mailto">ENCRYPTEDEMAIL</a>
```


Crypt.js
--------

**Instantiate**
```html
	<script src="Crypt.js"></script>
	<script>
	var CryptObj = new Crypt();
	</script>
```

**Crypt.decrypt**( string *data*, string *key* )  
returns string  
Decrpyt a string using the same key from the encryption.  

**Crypt.encrypt( string *data*, string *key* )  
returns string  
Encrypt a key using a key.  


CryptMailto.js
--------------
**Instantiate**
```html
	<script src="Crypt.js"></script>
	<script src="CryptMailto.js"></script>
	<script>
	var CM = new CryptMailto();
	</script>
```

**CryptMailto.decryptMailTags**( string *key* )  
returns null  
Uses jQuery to decrypt all encrypted anchors on the page with the .mailto class.  
Before:  
```html
	<a class="mailto">ENCRYPTEDEMAIL</a>
```
After:  
```html
	<a href="mailto:decrypted@email.com" class="mailto">decrypted@email.com</a>
```
