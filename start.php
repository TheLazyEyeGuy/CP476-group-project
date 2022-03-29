<?php
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
        you are not logged in, please log in or sign up and then log in
        <br>
        <input type="button" onclick="window.location.href='http://localhost/login.php';" value="log in" />
        <input type="button" onclick="window.location.href='http://localhost/sign_up.php';" value="sign up" />
    </form>
  </body>
</html>