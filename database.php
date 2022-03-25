<?php


//databse connection parameters
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "myDB";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

/*
//create new table
$sql = "CREATE TABLE Login_Test (
  Username varchar(255) NOT NULL UNIQUE,
  Pass varchar(255) NOT NULL
)";
if ($conn->query($sql) === true) {
    echo "Table Created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}
*/

//insert example
//Username field is unique, so repeats crash the db
//table currently contains:
//(lazy,Pass), (Campbell, Word), (test,Pass)
/*
$sql = "INSERT INTO Login_Test VALUES ('test', 'Pass')";
if ($conn->query($sql) === true) {
    echo "data inserted successfully";
} else {
    echo "Error inserting data: " . $conn->error;
}
*/

//match username to password
//sql1 should have only 1 row as usernames are unique
//sql2 can have more than 1 row because passwords are not unique
$sql1 = "SELECT Username FROM Login_test WHERE Username= 'lazy'";
$sql2 = "SELECT Username FROM Login_test WHERE Pass= 'Pass'";

//result 1 contains the username, which is confirmed to exist if querry passes
//result 2 contains all usernames with the same password (security issue?) 
//but only checks if the username exists inside
$result1 = mysqli_query($conn, $sql1);
$result2 = mysqli_query($conn, $sql2);
if (in_array($result1, array($result2))) {
    echo "initiating loging";
} else {
    echo "incorrect username or password" . $conn->error;
}


/*
//update example
$sql = "UPDATE MyGuests SET lastname='Doe' WHERE id=2";
if ($conn->query($sql) === true) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}
*/

//always close connection
$conn->close();
?>
