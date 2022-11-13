<?php
header('Content-type: text/plain');

function _getJSON($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    //curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json, text/plain, */*', 'Authorization: Ubi_v1 t='.apcu_fetch('uplayconnect_ticket'), 'Ubi-AppId: 39baebad-39e5-4552-8c25-2c9b919064e2', 'Connection: keep-alive', 'Keep-Alive: timeout 0, max 0'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // so curl_exec returns data
    // grab URL and pass it to the browser; store returned data
    $curlRes = curl_exec($ch);

    if (curl_errno($ch))
    {
        echo 'Error:' . curl_error($ch);
    }

    // close cURL resource, and free up system resources
    curl_close($ch);
    // Decode returned JSON so it can be handled as a multi-dimensional associative array
    return json_decode($curlRes, true);
};

// Romanize numbers for better aesthetic
function romanize($num)  
{ 
    // Be sure to convert the given parameter into an integer
    $n = intval($num);
    $result = ''; 
 
    // Declare a lookup array that we will use to traverse the number: 
    $lookup = array(
        'IV' => 'IV', 'III' => 'III', 'II' => 'II', 'I' => 'I'
    ); 
 
    foreach ($lookup as $roman => $value)  
    {
        // Look for number of matches
        $matches = intval($n / $value); 
 
        // Concatenate characters
        $result .= str_repeat($roman, $matches); 
 
        // Substract that from the number 
        $n = $n % $value; 
    } 

    return $result; 
}; 

$apikey = '46cf15635e393ef08e5fcd7719a6a2df';
$machine = 'PC';
$nick = 'shJazz_ttv';

$data = _getJSON('https://api.mozambiquehe.re/bridge?&auth=46cf15635e393ef08e5fcd7719a6a2df&player=shJazz_ttv&platform=PC');
     
$rdiv = intval($data['global']['rank']['rankDiv']);
	 
$rank = _getJSON('https://api.mozambiquehe.re/bridge?&auth=46cf15635e393ef08e5fcd7719a6a2df&player=shJazz_ttv&platform=PC');
        
echo " $player Apex Rank: " . $rank['global']['rank']['rankName'] . " " . romanize($rdiv) .  " 「" . $rank['global']['rank']['rankScore'] . "ᴿᴾ」";

    // More Explained Rank info output
    // echo "Apex Rank: ".$result['global']['rank']['rankName']." ".$result['global']['rank']['rankDiv']." ";
    // echo "Score: ".$result['global']['rank']['rankScore']
