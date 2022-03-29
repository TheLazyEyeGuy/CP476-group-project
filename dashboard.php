<?php
//TODO implement cookies to display coin data
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

        
        you are logged in as 
        <br>
        <input type="button" onclick="window.location.href='http://localhost/change_password.php';" value="change password" />
        use these for the coin selecter page to go there and back respectively
        <input type="button" onclick="window.location.href='http://localhost/adress';" value="change tracked coins" />
        <input type="button" onclick="window.location.href='http://localhost/dashboard.php';" value="return to dashboard" />

    </form>
  </body>
</html>