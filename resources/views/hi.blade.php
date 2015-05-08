@extends('app')

@section('content')

<link href='//fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>

<style>
  body {
    margin: 10;
    padding: 10;
    width: 85%;
    height: 100%;
    color: #9f9f9f;
    display: table;
    font-weight: 100;
    font-family: 'Lato';
  }
  .container {
    text-align: center;
    display: table-caption;
    vertical-align: middle;
  }
  .content {
    text-align: center;
    display: inline-block;
  }
  .title {
    font-size: 96px;
    margin-bottom: 40px;
  }
  .quote {
    font-size: 24px;
  }
</style>


<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">home panel heading</div>
        <div class="panel-body">
          <h2>Scratch Pad</h2>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="panel-body">
  <h3>UPC examples</h3>
<?php

$break = '<hr/>';

/////////////////////////////////////////

// EAN //

/////////////////////////////////////////
// Restrict to 12 numeric chars
$ean = '012345678901';
$string = $ean;
$nl = '<br/>';

/////////////////////////////////////////
function ean13_checkdigit($digits){
// first change digits to a string so that we can access individual numbers
$digits =(string)$digits;
// 1. Add the values of the digits in the even-numbered positions: 2, 4, 6, etc.
$even_sum = $digits{1} + $digits{3} + $digits{5} + $digits{7} + $digits{9} + $digits{11};
// 2. Multiply this result by 3.
$even_sum_three = $even_sum * 3;
// 3. Add the values of the digits in the odd-numbered positions: 1, 3, 5, etc.
$odd_sum = $digits{0} + $digits{2} + $digits{4} + $digits{6} + $digits{8} + $digits{10};
// 4. Sum the results of steps 2 and 3.
$total_sum = $even_sum_three + $odd_sum;
// 5. The check character is the smallest number which, when added to the result in step 4,  produces a multiple of 10.
$next_ten = (ceil($total_sum/10))*10;
$check_digit = $next_ten - $total_sum;
return $digits . $check_digit;
}
echo  '<b>' . ean13_checkdigit("$ean") . '</b>';
echo $nl ;
echo 'ean13_checkdigit';
echo $break;
/////////////////////////////////////////
/////////////////////////////////////////
?>
</div>

<?php

$file = 'http://localhost.local/tbl_transactions.json';
$qry = 'http://myownapi.local/makers/1/vehicles';
$nl = '<br/>';
$break = '<hr/>';

/////////////////////////////////////////

// UPC //

/////////////////////////////////////////
// Restrict to 11 numeric chars
$upc = '01234567890';  


//longer alternative
function upc_checkdigit($upc_code){
    $odd_total  = 0;
    $even_total = 0;
 
    for($i=0; $i<11; $i++)
    {
        if((($i+1)%2) == 0) {
            /* Sum even digits */
            $even_total += $upc_code[$i];
        } else {
            /* Sum odd digits */
            $odd_total += $upc_code[$i];
        }
    }
 
    $sum = (3 * $odd_total) + $even_total;
 
    /* Get the remainder MOD 10*/
    $check_digit = $sum % 10;
 
    /* If the result is not zero, subtract the result from ten. */
    return ($check_digit > 0) ? 10 - $check_digit : $check_digit;
}

echo  '<b>' . $upc . upc_checkdigit("$upc") . '</b>';
echo $nl ;
echo 'upc_checkdigit';
echo $break;


$nl = '<br/>';
$break = '<hr/>';

/////////////////////////////////////////

// ITF //

/////////////////////////////////////////

// include('php-barcode.php');

// $gtin = '10384478861804';

$gtin = '1000446001111'; 

$code = $gtin;

echo DNS1D::getBarcodeHTML($gtin, "I25");
//echo $nl ;
echo 'I25';
echo $break;
echo DNS1D::getBarcodeHTML($gtin, "I25+");
//echo $nl ;
echo 'I25+';
echo $break;
/////////////////////////////////////////

// MOD10 //

/////////////////////////////////////////

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

echo "output of luhn_calc: ";
echo luhn_calc($gtin);
echo $nl ;

echo "output of luhn_check: ";
echo luhn_check($gtin);
echo $nl ;

echo "output of luhn_create: ";
echo luhn_create($gtin);
echo $nl ;
echo '<h3>luhn funcs</h3>';
echo $break;

/////////////////////////////////////////////

/**
 * CALCULATE LUHN
 * ==============
 * Calculates the Luhn digit for the passed string, then returns the
 * full sting.
 *
 *       var delta = new Array (0,1,2,3,4,-4,-3,-2,-1,0);
 *
 *        for (i=Luhn.length-1; i>=0; i-=2 )
 *        {
 *               var deltaIndex = parseInt(Luhn.substring(i,i+1));
 *               var deltaValue = delta[deltaIndex];
 *               sum += deltaValue;
 *        }
 *
 *
 * @param type $input
 * @return type
 */
 function calculateLuhn($input)  {
    $sum = 0;
    $doubleIt = true ;

    $delta = Array (0, 2, 4, 6, 8, 1, 3, 5, 7, 9) ;

    for ($ind = strlen($input)-1; $ind >= 0; $ind--) {
        $digit = intval(substr($input, $ind, 1)) ;
        if ($doubleIt) {
            $sum += $delta[$digit] ;
        } else {
            $sum += $digit ;
        }
        $doubleIt = !$doubleIt ;
    }

    $mod10 = $sum % 10;
    $mod10 = 10 - $mod10;
    if ($mod10==10) {
        $mod10=0;
    }
    return $input . $mod10 ;
}
echo "output of calculateLuhn: ";
echo calculateLuhn($gtin);
echo $nl ;
echo '<h3>calculateLuhn</h3>';
echo $break;
echo $nl;
##################################



##################################
echo $nl;
?>
<div class="panel-body">
  <h3>API examples</h3>

</div>

<?php

$apiString = json_decode(file_get_contents($qry), true);
$json = file_get_contents($file);

// $encoded = base64_encode($json);
// $decoded = base64_decode($encoded);
// $decoded = base64_decode(base64_encode($string));

echo " <b>'print_r' from $qry</b>" .$break;
print_r($apiString);

echo $break;

echo " <b>'dd' from $qry</b>" .$break;

dd($apiString);

echo '<br/>' .$break;

echo "<b>var_dump() from $file</b>" .$break;
// echo "decoded string: <br/>". $decoded.'<br/><br/>';

return dd($json);

echo '<br/><br/>';
echo $break. '<b>EOF var_dump</b>';

// echo $json;
// echo "encoded string: <br/>". $encoded .'<br/><br/>';
?>
@endsection
