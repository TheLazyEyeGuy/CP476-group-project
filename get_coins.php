<?php
//Get coins from database
//Get coin prices from database or directly from API?
//Get favourited coins from database

//Convert into three lists?

// Dummy data for testing

$coins = array("btc", "eth", "xrp", "doge");
$prices = array("53172.21", "3740.14", "0.83", "0.16");
$favCoins = array("eth", "doge");
$responseString = "";

if (count($coins) > 0) {
    $responseString .= $coins[0];

    for($i = 1; $i < count($coins); $i++) {
        $responseString .= "," . $coins[$i];
    }
}

$responseString = $responseString . ":";

if (count($prices) > 0) {
    $responseString .= $prices[0];

    for ($i = 1; $i < count($prices); $i++) {
        $responseString .= "," . $prices[$i];
    }
}

$responseString = $responseString . ":";

if (count($favCoins) > 0) {
    $responseString .= $favCoins[0];

    for ($i = 1; $i < count($favCoins); $i++) {
        $responseString .= "," . $favCoins[$i];
    }
}

echo $responseString;//json_encode($responseString);
?>