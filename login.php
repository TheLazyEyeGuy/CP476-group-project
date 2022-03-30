<?php
session_start();

if (array_key_exists("user_id", $_SESSION)) {
    header("Location: http://localhost/dashboard.html");
    exit();
  }

if(isset($_POST['SubmitButton'])) {
    $name = $_POST["username"];
    $pass = $_POST["password"];
    
    $servername = "localhost";
    $username = "root";
    $password = "username";
    $dbname = "cp476";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT user_id FROM User WHERE username= ? AND password= ?");
    $stmt->bind_param("ss", $name, $pass);
    $stmt->execute();
    
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Initating login";
        $_SESSION["user_id"] = $result->fetch_assoc()["user_id"];
        //redirect to main page and login
        header("Location: http://localhost/dashboard.html");
        $conn->close();
        exit();
    }
    else {
        echo "Incorrect username or password" . $conn->error;
        $conn->close();
    }
    
    //$stmt->store_result();
    //$stmt->bind_result($result1);
    //$stmt->fetch();

    

    //$stmt1 = $conn->prepare("SELECT username FROM User WHERE password= ?");
    //$stmt1->bind_param("s", $pass);
    //$stmt1->execute();
    //$stmt1->bind_result($result2);
    //$stmt1->fetch();

    //if (in_array($result1, array($result2))) {
    //    echo "initiating login";
    //    //redirect to main page and login in
    //    header("Location: http://localhost/dashboard.php");
    //    exit();
    //} else {
    //    echo "incorrect username or password" . $conn->error;
    //}
}
?>

<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
    <form action="#" method="post">
        Username:
        <input type="text" id="username" name="username"><br>
        Password:
        <input type="text" id="password" name="password"><br>
        <input type="submit" name="SubmitButton" value="Submit">
    </form>


</body>
</html>