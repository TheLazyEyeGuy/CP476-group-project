<?php
session_start();

if (array_key_exists("user_id", $_SESSION)) {
  header("Location: http://localhost/dashboard.html");
  exit();
}

    /*
$login = false;
if ($login) {;
    echo("logged in");
}else {
    echo ("not logged in");
    
}
*/
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Title of the document</title>
  </head>
  <body>
    <form>
        You are not logged in, please log in or sign up and then log in
        <br>
        <input type="button" onclick="window.location.href='http://localhost/login.php';" value="log in" />
        <input type="button" onclick="window.location.href='http://localhost/sign_up.php';" value="sign up" />
    </form>
  </body>
</html>