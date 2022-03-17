<?php
    if(isset($_POST['SubmitButton'])) {
        $name = $_POST["username"];
        $password = $_POST["password"];
        
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

        $sql = "SELECT lastname  FROM MyGuests WHERE firstname = 'John'";
        $result = $conn->query($sql);
        print_r($result);

        if ($result != null) {
            if ($result === $password) {echo "Record updated successfully";
            }
            else{echo "incorrect username/password";
            }
            
        } else {
        echo "Error updating record: " . $conn->error;
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
