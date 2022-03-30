<?php


//databse connection parameters
$servername = "localhost";
$username = "username";
$password = "password";

// Create connection
$conn = new mysqli($servername, $username, $password);

$sql = 'SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = "cp476"';
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "Database already exists";
    exit();
}

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "CREATE DATABASE cp476";
if ($conn->query($sql) === TRUE) {
    echo "Database created<br>";
}
else {
    echo "Error creating database" . $conn->error;
}

// Select created database
$conn->select_db("cp476");

// Create User table
$sql = "CREATE TABLE User (user_id int NOT NULL AUTO_INCREMENT, username varchar(255) NOT NULL UNIQUE, password varchar(255) NOT NULL, PRIMARY KEY (user_id))";
if ($conn->query($sql) === true) {
    echo "User table created<br>";
}
else {
    echo "Error creating User table" . $conn->error;
}

// Create Coin table
$sql = "CREATE TABLE Coin (coin_id int NOT NULL AUTO_INCREMENT, symbol varchar(255) NOT NULL, name varchar(255) NOT NULL, PRIMARY KEY (coin_id))";
if ($conn->query($sql) === true) {
    echo "Coin table created<br>";
}
else {
    echo "Error creating Coin table" . $conn->error;
}

// Creat UserCoin table
$sql = "CREATE TABLE UserCoin (user_id int NOT NULL, coin_id int NOT NULL, FOREIGN KEY (user_id) REFERENCES User(user_id), FOREIGN KEY (coin_id) REFERENCES Coin(coin_id))";
if ($conn->query($sql) === true) {
    echo "UserCoin table created<br>";
}
else {
    echo "Error creating UserCoin table" . $conn->error;
}

// Fill UserCoin table
$symbols = array("BTC", "ETH", "XRP", "DOGE", "NEO", "MATIC", "ADA", "LUNA", "SOL", "AVAX");
$names = array("Bitcoin", "Ethereum", "Ripple", "Dogecoin", "Neo", "Polygon", "Cardano", "Terra", "Solana", "Avalanche");


$query = $conn->prepare("INSERT INTO Coin VALUES (NULL, ?, ?)");

for ($i = 0; $i < count($symbols); $i++) {
    $query->bind_param("ss", $symbols[$i], $names[$i]);
    $query->execute();
}

$query->close();

// Add test user
$query = $conn->prepare("INSERT INTO User VALUES (NULL, ?, ?)");
$username = "test";
$password = "pass123";
$query->bind_param("ss", $username, $password);
$query->execute();

$conn->close();
?>