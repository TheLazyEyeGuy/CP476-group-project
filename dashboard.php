<?php
    
$login = false;
if ($login) {;
    echo("logged in");
}else {
    echo ("not logged in");
    
}

?>

<!DOCTYPE html>
<html>
  <head>
    <title>Title of the document</title>
  </head>
  <body>
    <form>
        you are not logged in
        <input type="button" onclick="window.location.href='http://localhost/login.php';" value="log in" />
        <input type="button" onclick="window.location.href='http://localhost/sign_up.php';" value="sign up" />
        
        you are logged in 
        <input type="button" onclick="window.location.href='http://localhost/change_password.php';" value="change password" />
    </form>
  </body>
</html>