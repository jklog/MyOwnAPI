<?php // base64_encode()/base64_decode() example
$string  = 'Encoding and Decoding Encrypted PHP Code';
$encoded = base64_decode($string);
$decoded = base64_decode(base64_encode($string));
echo $encoded ."\n";
echo $decoded;
echo 'messages sent with success';
?>