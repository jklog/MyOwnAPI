@extends('app')

@section('content')

<link href='//fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>

<style>
  body {
    margin: 10;
    padding: 10;
    width: 85%;
    height: 100%;
    color: #000;
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
use Carbon\Carbon;
// use Monolog\Logger;
// use Clockwork\Support;
// use Clockwork\DataSource;

$visited = Carbon::now();
$who = 'Jon Krawczuk';
$page = Request::path() . '.blade.php';

echo '<p> you are on: <b>' . $page .'</p>';
echo '<p> you are: <b>' . $who .'</b></p>';

// dd($visited);

$now = Carbon::now();
// echo $now->toFormattedDateString();

// $page = Hash::make('hi.blade.php');

//adds key:value pair to app_settings table
A2Way\LaravelAppSettings\AppSettings::set('page', $now);
A2Way\LaravelAppSettings\AppSettings::set('last-visit', $visited);
A2Way\LaravelAppSettings\AppSettings::set('user', $who);
// A2Way\LaravelAppSettings\AppSettings::set('user', 'After Display on Screen');

Log::info(' $page variable set via A2Way with value: '.$page);
Log::info(' $visited variable set via A2Way with value: '.$visited);
Log::info(' $who variable set via A2Way with value: '.$page);

/////////////////////////////////////////

// Clockwork::info('info from clockwork');
Debugbar::info($page);
Debugbar::error('My Error!');
Debugbar::warning('My Watch out…');
Debugbar::addMessage('MyAnother message', 'mylabel');

Debugbar::startMeasure('render','Time for rendering');

Debugbar::addMeasure('now', LARAVEL_START, microtime(true));

Debugbar::measure('My long operation', function() {
      for($i=0; $i<99; $i++)
      {
        return 'Hello World';
      }

});

Debugbar::stopMeasure('render');
/////////////////////////////////////////



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

$gtin = '1000446001111'; 

$code = $gtin;

echo DNS1D::getBarcodeHTML($gtin, "I25");
//echo $nl ;
echo 'I25';
echo $break;
echo $gtin;
echo $break;

echo DNS1D::getBarcodeHTML($gtin, "I25+");
//echo $nl ;
echo 'I25+';
echo $break;

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

//  dd($apiString);

echo '<br/>' .$break;

// echo "<b>var_dump() from $file</b>" .$break;
// // echo "decoded string: <br/>". $decoded.'<br/><br/>';

// return dd($json);

// echo '<br/><br/>';
// echo $break. '<b>EOF var_dump</b>';

// echo $json;
// echo "encoded string: <br/>". $encoded .'<br/><br/>';
?>
@endsection
