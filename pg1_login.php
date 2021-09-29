<!DOCTYPE HTML>
<?php
session_start();
?>
<html lang = "en">
  <head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="css/style.css">
      <title>Project_R00143625_RonCoveney</title>
    </head>
    <body>


<br><br><br><br><br>
<br><br><br><br><br>



  
<h4> Database populated with 2 users:</h4>
<table class ="left">
  <tr>
    <th>Email</th>
    <th>Password</th>
  </tr>
  <tr>
    <td>ron@ron.com</td>
    <td>123</td>
  </tr>
  <tr>
    <td>magda@magda.com</td>
    <td>123</td>
  </tr>
</table>
<h4> Database Name: phpdata</h4>
<form class = "login" action="php/login.php" method="post">
  <h2>Log In</h2>
  <input type="text" name="uid" placeholder="Email...">
    <input type="password" name="pwd" placeholder="Password...">
      <button type="submit" name="submit">Log in</button>
    </form>
    <br><br><br><br><br><br>
    <br><br><br><br><br><br>

  <?php
// Error messages
if (isset($_GET["error"]))
{
    if ($_GET["error"] == "emptyinput")
    {
        echo "<h1>Please Fill in all fields!</h1>";
    }
    elseif ($_GET["error"] == "wronglogin")
    {
        echo "<h1>Wrong login!</h1>";
    }
   elseif ($_GET["error"] == "wronguid")
    {
        echo "<h1>Please use your Email Address!</h1>";
    }
}
?>

</body>
</html>

