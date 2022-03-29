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

    

    $stmt1 = $conn->prepare("SELECT Username FROM Login_test WHERE Pass= ?");
    $stmt1->bind_param("s", $pass);
    $stmt1->execute();
    $stmt1->bind_result($result2);
    $stmt1->fetch();

    if (in_array($result1, array($result2))) {
        echo "initiating login";
        //redirect to main page and login in
        header("Location: http://localhost/dashboard.php");
        exit();
    } else {
        echo "incorrect username or password" . $conn->error;
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