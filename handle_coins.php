<?php

function processText($str) {
    $favCoins = explode(",", $str);
    return $favCoins;
}

$text = $_POST["favCoins"];
$favCoins = processText($text);

// Test to ensure data received
// Replace with database operation updating list of favourite stocks
$myfile = fopen("test.txt", "w");
fwrite($myfile, $text);
fclose($myfile);
?>