{{-- <!DOCTYPE html>
<html lang="en">
<html>
<head>
  <title>Hi Document</title>
</head>
<body>
    
    <h1>Hello {{ $name }}</h1>

    

 </body>
</html> --}}

<?php // base64_encode()/base64_decode() example

//$string = new HttpRequest('http://localhost.local/sample.json', HttpRequest::getUrl);

// $json =  Request::input("http://localhost.local/samples.json");


// $string =  Request::input("http://localhost.local/sample.json");

$apiString = json_decode(file_get_contents('http://myownapi.local/makers/3/vehicles'), true);



 //$apiString = json_decode(file_get_contents('http://l5api.local/v1/sample/'), true);


// $json = json_decode(file_get_contents('http://www.biocatalogue.org/search.json?q=ebi'), true);

// $json = json_decode(file_get_contents('https://api.twitter.com/1.1/followers/ids.json
// '), true);



//http://www.biocatalogue.org/search.json?q=ebi

////////////////////$json = json_decode(file_get_contents('http://localhost.local/tbl_transactions.json'), true);
// $json = json_encode($file);

$json = file_get_contents('http://localhost.local/tbl_transactions.json');
//$json = json_decode(file_get_contents('http://myownapi.local/makers/3/vehicles'), true);


// $encoded = base64_encode($json);
// $decoded = base64_decode($encoded);
// $bicoded = base64_encode($decoded);

// $decoded = base64_decode(base64_encode($string));

echo " <b>'print_r' from 'http://myownapi.local/makers/1/vehicles'</b>" .'<br/>========================<br/>';
print_r($apiString);

echo '<br/><br/>';

echo " <b>'dd' from 'http://myownapi.local/makers/1/vehicles'</b>" .'<br/>========================<br/>';

dd($apiString);


echo '<br/>' .'<br/>========================<br/>';


//echo $bicoded .'<br/>';
echo "<b>var_dump() from 'http://localhost.local/tbl_transactions.json'</b>" .'<br/>========================<br/>';
// echo "decoded string: <br/>". $decoded.'<br/><br/>';

return dd($json);

echo '<br/><br/>';
echo '========================<br/>'. '<b>EOF var_dump</b>';



// echo $json;

// echo "encoded string: <br/>". $encoded .'<br/><br/>';





?>