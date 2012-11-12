<?php

include( 'inc/php/Crypt.php' );
include( 'inc/php/CryptMailto.php' );
$CM 		= new CryptMailto();

$html 		= <<<HTML
<p>
random@robots-party.com <br />
craigers@krunk.com<br />
sightings@los-feliz-skunk.org<br />
</p>
HTML;

$enc_html 	= $CM->convertAnchors( $html );

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>CryptMailto Examples</title>
	<link rel="stylesheet" href="http://twitter.github.com/bootstrap/assets/css/bootstrap.css" />
</head>

<body style="padding-bottom:20.0em;">

	<div class="container">
		<div class="row">
			<div class="offset2 span8">
				<h1>CryptMailto Examples</h1>
				<p>
					<code>CryptMailto</code> is a utility for obfuscating email addresses from
					robots/crawlers using PHP and then decrypting them with Javascript and jQuery for legibility in the view.
				</p>

				<p>Encryption/decryption methods were borrowed from <a href="https://github.com/Hunter-Dolan/Crypt">Hunter-Dolan/Crypt</a></p>

				<hr />
				<h2>Include PHP Class</h2>
				<p>Be sure to include the PHP classes at the top of your page/script and instantiate the class.</p>
<pre>&lt;?php
include_once( 'Crypt.php' );
include_once( 'CryptMailto.php' );
$CM = new CryptMailto();
?&gt;</pre>

				<hr />
				<h2>Convert Entire Code Blocks</h2>
				<h3>Before</h3>
				<p>Use raw email addresses without <code>&lt;a&gt;</code> in your variablized HTML:</p>
<pre>&lt;?php
$html = &lt;&lt;&lt;HTML
<?=htmlentities( $html ) ?>

HTML;
?&gt;</pre>
				</p>

				<h3>After</h3>
				<h4>Using <code>convertAnchors</code> Method</h4>
<pre>&lt;?php echo $CM->convertAnchors( $html ); ?&gt;
&lt;!-- Will output: --&gt;
<?=htmlentities( $enc_html ) ?>
</pre>

				<hr />
				<h2>Convert Single Email Address</h2>
				<h4>Using <code>encryptMailtoAnchor</code> Method</h4>
				<p>This method will render the entire anchor tag for you.</p>
<pre>&lt;?php echo $CM->encryptMailtoAnchor( 'sightings@los-feliz-skunk.org' ) ?&gt;
&lt;!-- Will output: --&gt;
<?=htmlentities( $CM->encryptMailtoAnchor( 'sightings@los-feliz-skunk.org' ) ) ?>
</pre>

				<h4>Using <code>encryptMailto</code> Method</h4>
				<p>This method will render only the encrypted email address. This is helpful if you need to add other attributes in the <code>&lt;a&gt;</code>.</p>
<pre>&lt;a class="ogrelink mailto" rel="contact"&gt;
&lt;?php echo $CM->encryptMailto( 'sightings@los-feliz-skunk.org' ) ?&gt;
&lt;/a&gt;
&lt;!-- Will output: --&gt;
&lt;a class="ogrelink mailto" rel="contact"&gt;
<?=htmlentities( $CM->encryptMailto( 'sightings@los-feliz-skunk.org' ) ) ?>

&lt;/a&gt;
</pre>

				<hr />
				<h2>Decrypt with Javascript</h2>
				<p>Add the following <code>&lt;script&gt;</code> code just above the closing <code>&lt;body&gt;</code> tag to decrypt the anchors.</p>
<pre>&lt;script src="http://code.jquery.com/jquery-latest.min.js"&gt;&lt;/script&gt;
&lt;script src="js/Crypt.js"&gt;&lt;/script&gt;
&lt;script src="js/CryptMailto.js"&gt;&lt;/script&gt;
&lt;script&gt;
	var CM = new CryptMailto();
	CM.decryptMailtags( '&lt;?php echo $CM->passPhrase ?&gt;' );
&lt;/script&gt;
</pre>

				<h4>Output:</h4>
				<?=$enc_html ?>

			</div>
		</div>
	</div>


	<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
	<script type="text/javascript" src="inc/js/Crypt.js"></script>
	<script type="text/javascript" src="inc/js/CryptMailto.js"></script>
	<script type="text/javascript">
		var CM 	= new CryptMailto();
		var passPhrase 	= "<?=$CM->passPhrase ?>";
		CM.decryptMailTags( passPhrase );
	</script>

</body>
</html>

