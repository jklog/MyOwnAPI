<?php

/***
 * Calculates the Luhn checksum.
 * @param $s (string) the string to check.,
 * @return mixed FALSE if $s does not consists only of decimal digits, otherwise the luhn checksum is returned.
 */
function luhn_calc($s) {  
	settype($s, 'string');
	if (!ctype_digit($s)) return false;
	$n = 0;
	for ($i = 0; $i < strlen($s); $i++) {
		$t = substr($s, $i, 1) * (2 - ($i & 1));
		if ($t > 9) $t -= 9;
		$n += $t;
	}
	return (10 - ($n % 10)) % 10;
}

/***
 * Determines whether the specified string is a valid luhn number.
 * @param $s (string) a luhn number to validate
 * @return boolean TRUE if the specified string is a valid luhn number; FALSE otherwise.
 */
function luhn_check($s) {
	settype($s, 'string');
	$n = luhn_calc(substr($s, 0, -1));
	if ($n === false) return false;
	return $n == substr($s, -1);
}

/***
 * Appends the Luhn checksum to the specified string.
 * @param $s (string) the string to calculate the Luhn checksum.
 * @return mixed FALSE if $s does not consists only of decimal digits, otherwise the concactated string of $s and the Luhn checksum is returned.
 */
function luhn_create($s) {
	settype($s, 'string');
	if (!ctype_digit($s)) return false;
	return $s . luhn_calc($s);
}
?>