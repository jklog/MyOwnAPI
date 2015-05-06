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

// $string =  Request::input("http://localhost.local/sample.json");


// $string =  Request::input("http://localhost.local/sample.json");

$json = json_decode(file_get_contents('http://myownapi.local/makers/3/vehicles'), true);

//$json = json_decode(file_get_contents('http://www.biocatalogue.org/tags.json?limit=10'), true);

// $json = json_decode(file_get_contents('https://api.twitter.com/1.1/followers/ids.json
// '), true);



//http://www.biocatalogue.org/search.json?q=ebi

// $json = file_get_contents('http://localhost.local/sample.json');


// $encoded = base64_encode($json);
// $decoded = base64_decode($encoded);
// $bicoded = base64_encode($decoded);

// $decoded = base64_decode(base64_encode($string));

//echo $bicoded .'<br/>';
echo "<b>var_dump() from hi.blade.php</b>" .'<br/><br/>';
// echo "decoded string: <br/>". $decoded.'<br/><br/>';
var_dump($json);

echo '<br/><br/>';

echo " <b>print_r from hi.blade.php</b>" .'<br/><br/>';

print_r($json);

// echo "encoded string: <br/>". $encoded .'<br/><br/>';





?>