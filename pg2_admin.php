<!DOCTYPE HTML>
<?php
session_start();
require_once "php/connection.php";

?>

<html lang = "en">
<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="css/style.css">
    <title>Project_R00143625_RonCoveney</title>

</head>

<body>

<nav id="topnav">
  <?php
if (isset($_SESSION["userUid"]))
{
    echo "<a href='php/logout.php'> Log out </a>";

}

?>
  <a class="active" href="pg2_admin.php">Admin Page</a>
  <a href="pg3_user.php">Users Page</a>
 
</nav>

<div class = "userContainer">
  <br><br>
<?php

if (isset($_SESSION["userUid"]))
{
      echo "<img src='php/uploads/" . $_SESSION['userUid'] . ".png' alt='user' class='user'>";
      echo "<h2><strong><em>Welcome " . $_SESSION["userUid"] . "</em></strong></h2>";
}

?>
</div>
<br/>

<?php
  include_once('php/connection.php');
  $query = "SELECT * from users";
  $result = mysqli_query($conn, $query);
?>


<table class = "center"> 
  <tr>
    <th colspan="6"><h2>User Information</h2></th>
  </tr>
  <tr>
    <th>ID</th>
    <th>Name</th>
    <th>Email</th>
    <th>User Name</th>
    <th>Hashed Password</th>
    <th>Admin 1=Yes 0=No</th>
  </tr>
  <?php
    while($rows = mysqli_fetch_assoc($result))
    {
  ?>
      <tr>
        <td><?php echo $rows ['usersId']; ?> </td>
        <td><?php echo $rows ['usersName']; ?> </td>
        <td><?php echo $rows ['usersEmail']; ?> </td>
        <td><?php echo $rows ['usersUid']; ?> </td>
        <td><?php echo $rows ['usersPwd']; ?> </td>
        <td><?php echo $rows ['admin']; ?> </td>

      </tr>
<?php
    }
?>
</table>

    <span id='wrapper'>
      <span id='row'>
        <span id='column'>
          <span id ='column_L'>

            <br>
            <form class = "id" action="php/signup.php" method="post">
              <h2>Change Admin Status</h2>
                <h4>Please enter the ID number of the user you want to alter</h4>
                  <input type="int" name="idNo" placeholder="ID Number">
                <h3>Do you want them as an Administrator?</h3>
              <label>
                <input type="radio" name="admin" value= 1 >
                  <span>Yes</span>
              </label>
              <label> 
                <input type="radio" name="admin" value= 0 checked>
                  <span>No</span>
              </label>

              <button type="submit" name="alterSubmit">Change Admin Status</button>
              <h2>Delete User</h2>
              <h4>Please enter the ID number of the user you want to delete</h4>
              <input type="int" name="idNo3" placeholder="ID Number">
              
              <button type="submit" name="deleteSubmit">Delete User</button>

            </form>

            <br><br><br><br><br>
            <br><br><br><br><br>
            <br><br><br><br><br>
            <br><br><br><br><br>
            <br><br><br><br><br>
            <br><br><br><br><br>
            <?php
            // Error messages
            if (isset($_GET["error"]))
            {
              if ($_GET["error"] == "emptyinput")
              {
                  echo "<h1> Fill in all fields! </h1>";
              }
              else if ($_GET["error"] == "invaliduid")
              {
                  echo "<h1>Choose a proper username!</h1>";
              }
              else if ($_GET["error"] == "invalidemail")
              {
                  echo "<h1>Choose a proper email!</h1>";
              }
              else if ($_GET["error"] == "passwordsdontmatch")
              {
                  echo "<h1>Passwords do not match!</h1>";
              }
              else if ($_GET["error"] == "stmtfailed")
              {
                  echo "<h1>Something went wrong!</h1>";
              }
              else if ($_GET["error"] == "usernametaken")
              {
                  echo "<h1>Username already taken!</h1>";
              }
              else if ($_GET["error"] == "pwdbError")
              {
                  echo "<h1>ERROR -Users Password has not been Updated!</h1>";
              }
              else if ($_GET["error"] == "dbError")
              {
                  echo "<h1>ERROR -The Admin Stats has not been Updated!</h1>";
              }
               else if ($_GET["error"] == "notdel")
              {
                  echo "<h1>ERROR -The user has not been deleted</h1>";
              }
              else if ($_GET["error"] == "noerrors")
              {
                  echo "<h1>You have signed up!</h1>";
              }
              else if ($_GET["error"] == "dbupdate")
              {
                  echo "<h1>The Admin Stats has been Updated!</h1>";
              }
              else if ($_GET["error"] == "pwupdate")
              {
                  echo "<h1>Users Password has been Updated!</h1>";
              }
              else if ($_GET["error"] == "userdeleted")
              {
                  echo "<h1>User has been deleted!</h1>";
              }

            }

            ?>

          </span>
        </span>
        <span id='column'>
          <span id = 'column_M'>
           <br>   
            <form class= "signup-form" action="php/signup.php" method="post" enctype="multipart/form-data">
              <h2>Create New User</h2>
                <h4>New User Details</h4>
                  <input type="text" name="name" placeholder="Full name...">
                  <input type="text" name="email" placeholder="Email...">
                  <input type="text" name="uid" placeholder="Username...">
                    <h3> Please upload a Small image for the Profile 
                      <br> Images less then 30KB accepted 
                        <br> 
                      </h3>
                    <h3>(Check suggestes_profile_imgs folder for supplied images)</h3>
              
                  <input type="file" name="file"class="inputfile" >
                    <label for="file">Upload Image
                    </label>
              <input type="password" name="pwd" placeholder="Password...">
              <input type="password" name="pwdrepeat" placeholder="Repeat password...">
              
              <h3>Is this User an Administrator?</h3>
              <label>
                <input type="radio" name="adminRadio" value= 1 >
                <span>Yes</span>
              </label>
              <label> 
                <input type="radio" name="adminRadio" value= 0 checked>
                <span>No</span>
              </label>
              <br/><br/>
              <button type="submit" name="submit">Sign up</button>
            </form>
          </span>
        </span>
        <span id ='column'>
          <span id ='column_R'>
            <br>
            <form class = "pass" action="php/signup.php" method="post">
              <h2>Change a users Password</h2>
              <h4>Please enter the ID number of the user you want to alter</h4>
                <input type="text" name="idNo2" placeholder="ID Number">
              <h3>Please enter the new Password?</h3>
                <input type="password" name="pwdAlter" placeholder="New Password..."><br/><br/>
              <button type="submit" name="pwdSubmit">Change user Password</button>
            </form>
          </span>
        </span>
      </span>
    </span>
  </body>
</html>
