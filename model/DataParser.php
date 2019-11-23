<?php
class DataParser {
    function parser($data) {
        if ($this->checkDataFormat($data)) {
            $results = [];
            for ($x = 0; $x < 6; $x++) {
                $temp = hexdec( substr($data, $x*2, 2) );
                $hum = hexdec( substr($data, $x*2+12, 2) );
                $results[] = [$temp, $hum];
                //echo "Mesure " . ($x+1) . ": Temperature " . $temp . " Celsius - Humidity: " . $hum . "%<br>"; 
            }
            return $results;
        }
        return false;	
	}

    private function checkDataFormat($data) {
        //When first temperature is 0 (represented as 00h), JSON by default erase these 0's.
        if (strlen($data) == 22) $data = "00" . $data;
        //When first temperature is 0 < t < 9 (represented as 0Xh), JSON by default erase the 0.
        else if (strlen($data) == 23) $data = "0" . $data;
        return strlen($data) == 24;
    }
}
/* Some Basic Testing
$testDataParser = new DataParser();
//Should work
if ($testDataParser->parser("123456789abc123456789abc")) echo "bruh2";
$testDataParser->parser("123456789abc123456789ab");
$testDataParser->parser("123456789abc123456789a");
//Should NOT work
if ($testDataParser->parser("123456789abc")) echo "Bruh";
$testDataParser->parser("123456789abc123456789abc123456789abc");*/
?>