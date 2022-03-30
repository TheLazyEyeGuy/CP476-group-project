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
    $password = "password*";
    $dbname = "cp476";

    if ($name == "" or $pass == "") {
        echo "Username and password cannot be empty";
    }
    else {
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        }

        $stmt = $conn->prepare("SELECT username FROM User WHERE username= ?");
        $stmt->bind_param("s", $name);
        $stmt->execute();

        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            echo "Username already exists";
            $conn->close();
        }
        else {
            $stmt->close();

            $stmt = $conn->prepare("INSERT INTO User (user_id, username, password) VALUES (NULL, ?, ?)");
            $stmt->bind_param("ss", $name, $pass);
            $stmt->execute();

            echo "Account created";
            header("Location: http://localhost/start.php");
            $conn->close();
            exit();
        }
    }

    
    //if ($result1 == "" and $name !== "" and $pass !== "") {
    //    $stmt->free_result();
    //    $stmt->close();
    //    $stmt = $conn->prepare("INSERT INTO User (user_id, username, password) VALUES (NULL, ?, ?)");
    //    $stmt->bind_param("ss", $name, $pass);
    //    $stmt->execute();
    //    echo "account created";
        //redirect to main page and login in
        //TODO make database initiallize cookies upon new user
    //    header("Location: http://localhost/start.php");
    //    exit();
    //} else {
    //    echo "username and password cannot be empty" . $conn->error;
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
        <input type="submit" name="SubmitButton">
    </form>


</body>
</html>