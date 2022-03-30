<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "password";     // Fill in
$dbName = "cp476";
$responseString = "";

// Create SQL database connection
$conn = new MySQLi($servername, $username, $password, $dbName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//Get coin symbols and names from database
$coins = array();
$coinNames = array();

$query = "SELECT name, symbol FROM Coin";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        array_push($coins, $row["symbol"]);
        array_push($coinNames, $row["name"]);
    }
}

// Add list of coins to response string
if (count($coins) > 0) {
    $responseString .= $coins[0];

    for($i = 1; $i < count($coins); $i++) {
        $responseString .= "," . $coins[$i];
    }
}

$responseString = $responseString . ":";

//Get favourited coins from database
$favCoins = array();
$favCoinNames = array();

if (array_key_exists("user_id", $_SESSION)) {       // If session cookie has a corresponding user_id (logged in)
    $user_id = $_SESSION["user_id"];

    $query = "SELECT coin_id FROM Usercoin WHERE user_id = ?";
    $sql = $conn->prepare($query);
    $sql->bind_param("i", $user_id);
    $sql->execute();
    $result = $sql->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            array_push($favCoins, $coins[$row["coin_id"] - 1]);
            array_push($favCoinNames, $coinNames[$row["coin_id"] - 1]);
        }
    }
}

else {
    // Default coins for users who aren't logged in
    $favCoins = array("BTC", "ETH", "XRP");
    $favCoinNames = array("Bitcoin", "Ethereum", "Ripple");
}

$conn->close();

// Add list of favourtite coin names to response string
if (count($favCoinNames) > 0) {
    $responseString .= $favCoinNames[0];

    for ($i = 1; $i < count($favCoinNames); $i++) {
        $responseString .= "," . $favCoinNames[$i];
    }
}

$responseString = $responseString . ":";

// Add list of favourite coins to response string
if (count($favCoins) > 0) {
    $responseString .= $favCoins[0];

    for ($i = 1; $i < count($favCoins); $i++) {
        $responseString .= "," . $favCoins[$i];
    }
}

$responseString = $responseString . ":";


//Get coin prices directly from API
//$prices = array("53172.21", "3740.14", "0.83", "0.16");
$prices = array();

for ($i = 0; $i < count($favCoins); $i++) {
    $favCoins[$i] = $favCoins[$i] . "USDT";
}

$data = file_get_contents("https://api.binance.com/api/v3/ticker/price");
$json = json_decode($data, true);

foreach ($json as $pair) {
    if (in_array($pair["symbol"], $favCoins)) {      // Remove USDT from end of json decoded symbol
        array_push($prices, $pair["price"]);
    }
}

// Add list of favourite coin prices to response string
if (count($prices) > 0) {
    $responseString .= $prices[0];

    for ($i = 1; $i < count($prices); $i++) {
        $responseString .= "," . $prices[$i];
    }
}

$responseString = $responseString . ":";

// Add boolean to signify login to response string
if(array_key_exists("user_id", $_SESSION)) {
    $responseString .= 1;
}
else {
    $responseString .= 0;
}

echo $responseString;
?>