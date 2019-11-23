<?php 
/*
https://api.sigfox.com/v2/devices/1D9E7B/messages
Authorization: Basic NWRkOTQ3YzcwNDk5ZjUwMzFiN2Y1YzVjOjc1NmUzNGE4YzU1YTc4ZjBlODI1NGJhZGQxMGM3NWNk
*/
include_once('model/DataParser.php');
include_once('model/InsertMesures.php');
$curl = curl_init();

$url = "https://api.sigfox.com/v2/devices/1D9E7B/messages";
curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($curl, CURLOPT_USERPWD, "5dd947c70499f5031b7f5c5c:756e34a8c55a78f0e8254badd10c75cd");
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($curl);
curl_close($curl);
$arr = json_decode($result, true);
$parser = new DataParser();
$insert = new InsertMesures();
foreach($arr['data'] as $element)
{
    //echo "<br>Data " . $element['data'];
    $data = $element['data'];
    $mesures = $parser->parser($data);
    if($mesures)
    {
        foreach($mesures as $ele)
        {
            //echo "Temperatura: " . $ele[0] . " Humitat: " . $ele[1] . "<br>";
			$insert->insertMesure('1D9E7B',$element['time']);
			$insert->insertTemperature('1D9E7B',$element['time'],$ele[0]);
			$insert->insertHumidity('1D9E7B',$element['time'],$ele[1]);
        }
    }
    //echo $data;
    //echo "<br>Time " . $element['time'];
}
//echo $result;
?>