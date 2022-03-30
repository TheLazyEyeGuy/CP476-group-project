<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "username";     // Fill in
$dbName = "cp476";

// Create SQL database connection
$conn = new MySQLi($servername, $username, $password, $dbName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//$user_id = 1;    // TODO: Automatically get user_id later when cookies are 
$user_id = $_SESSION["user_id"];

if (strlen($_POST["Add"]) > 0) {
    $coin_id = $_POST["Add"];
    // TODO: check if entry already exists (ensure no garbage data)
    $query = "INSERT INTO UserCoin VALUES (?, ?)";
}
else {
    $coin_id = $_POST["Remove"];
    $query = "DELETE FROM UserCoin WHERE user_id = ? AND coin_id = ?";
}

$coin_id += 1;      // Offset to match array starting form 0 and DB id starting at 1

$sql = $conn->prepare($query);
$sql->bind_param("ii", $user_id, $coin_id);
$sql->execute();

$conn->close();
?>