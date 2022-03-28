<?php
$servername = "localhost";
$username = "root";
$password = "";     // Fill in
$dbName = "cp467";

// Create SQL database connection
$conn = new MySQLi($servername, $username, $password, $dbName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = 1;    // TODO: Automatically get user_id later when cookies are implemented

//Get coins from database
$coins = array();

$query = "SELECT symbol FROM Coin";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        array_push($coins, $row["symbol"]);
    }
}

//Get favourited coins from database
$favCoins = array();

$query = "SELECT coin_id FROM Usercoin WHERE user_id = ?";
$sql = $conn->prepare($query);
$sql->bind_param("i", $user_id);
$sql->execute();
$result = $sql->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        array_push($favCoins, $coins[$row["coin_id"] - 1]);
    }
}

$conn->close();
//Get coin prices from database or directly from API?


// Dummy data for testing
//$coins = array("btc", "eth", "xrp", "doge");
//$prices = array("53172.21", "3740.14", "0.83", "0.16");
$prices = array();
//$favCoins = array("eth", "doge");
//$favCoins = array();
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