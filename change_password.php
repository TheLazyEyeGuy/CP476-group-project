<?php
if(isset($_POST['SubmitButton'])) {
    $name = $_POST["username"];
    $pass = $_POST["password"];
    $newpass = $_POST["new_password"];
    
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
        $stmt->free_result();
        $stmt->close();
        $stmt1->free_result();
        $stmt1->close();
        $stmt2 = $conn->prepare("UPDATE Login_test SET Pass = ? WHERE Username = ?");
        $stmt2->bind_param("ss", $newpass, $name);
        $stmt2->execute();
        //changes password and go back to main page
        //shouldnt have to pass any cookie data
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
        current password:
        <input type="text" id="password" name="password"><br>
        new password:
        <input type="text" id="new_password" name="new_password"><br>
        <input type="submit" name="SubmitButton">
    </form>


</body>
</html>