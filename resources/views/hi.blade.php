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
/*    display: table;*/
    font-weight: 100;
    font-family: 'Lato';
  }

  .container {
    text-align: center;
    display: table-cell;
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
          <h2>API / UPC  Demo</h2>
        </div>
      </div>
    </div>
  </div>
</div>

<?php

$file = 'http://localhost.local/tbl_transactions.json';
$qry = 'http://myownapi.local/makers/10/vehicles';
$nl = '<br/>';
$break = '<br/>~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~<br/>';
$upc = '01234567890';
$str = $upc;

function UPC_checkdigit($str){ 
    if(!preg_match('/^[0-9]{11,12}$/',$str))return; 
    for($i=0; $i<=10; $i++){ 
        $digit+= $str[$i] * (!fmod($i,2) ? 3 : 1); 
    } 
    $digit=substr(500-$digit,-1); 
    if(strlen($str)==12){ 
        return $digit==substr($str,-1); 
    }else{ 
        return $digit; 
    } 
}

echo '<b>' . $str . genChkDgt("$str") . '</b>';
echo $nl ;
echo 'UPC_checkdigit';
echo $break;

function genChkDgt($upc_code){
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

echo  '<b>' . $upc . genChkDgt("$upc") . '</b>';
echo $nl ;
echo 'genChkDgt';

echo $break;

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