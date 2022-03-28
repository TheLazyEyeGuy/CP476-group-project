<?php

$data = file_get_contents("https://api.binance.com/api/v3/ticker/price");

$json = json_decode($data, true);
$cryptoarray = array("BTCUSDT", "ETHUSDT");


foreach ($json as $x){

    if (in_array($x['symbol'], $cryptoarray))
    {
        $cryptoarray[$x['symbol']] =  $x['price'];
    }


}
print_r($cryptoarray);

?>