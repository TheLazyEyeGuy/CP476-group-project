<?php

if(isset($_POST['SubmitButton'])) {
    $name = $_POST["username"];
    $pass = $_POST["password"];
    
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

    $stmt = $conn->prepare("SELECT Username FROM Login_test WHERE Username= ?");
    $stmt->bind_param("s", $name);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($result1);
    $stmt->fetch();   

    
    if ($result1 == "" and $name !== "" and $pass !== "") {
        $stmt->free_result();
        $stmt->close();
        $stmt = $conn->prepare("INSERT INTO Login_test VALUES (?, ?)");
        $stmt->bind_param("ss", $name, $pass);
        $stmt->execute();
        echo "account created";
        //redirect to main page and login in
    } else {
        echo "username and password cannot be empty" . $conn->error;
    }
    
}

?>

<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
    <form action="#" method="post">
        username:
        <input type="text" id="username" name="username"><br>
        password:
        <input type="text" id="password" name="password"><br>
        <input type="submit" name="SubmitButton">
    </form>


</body>
</html>