<!DOCTYPE HTML>
<?php
  session_start();
  include_once "php/connection.php";
  include_once "php/functions.php";
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
          $uid = $_SESSION["userUid"];
          $que = ("SELECT `admin` FROM `users` WHERE `usersUid` = '$uid' ;");
          $res = mysqli_query($conn, $que);

            if($res){
              $row = mysqli_fetch_assoc($res);
              $admin = $row['admin'];
              if ($admin == "1"){
                echo "
        <a href='php/logout.php'>Log out</a>";
                echo "
        <a href='pg2_admin.php'>Admin Page</a>";
                ?>
        <a class="active" href='pg3_user.php'>User Page</a>;
                
        <?php
              }
              if ($admin == "0"){
                echo "
        <a href='php/logout.php'>Log out</a>";
                ?>
        <a class="active" href='pg3_user.php'>User Page</a>;
                
        <?php
              }  
            }
          }
      ?>
      </nav>
      <br>
        <br>
          <div class="userImg">
      <?php
        if (isset($_SESSION["userUid"]))
        {
            echo "
                <img src='php/uploads/" . $_SESSION['userUid'] . ".png' alt='user' class='user'width='300' height='300'>";
            echo "
                  <h1>
                    <strong>
                      <em>Welcome " . $_SESSION["userUid"] . "</em>
                    </strong>
                  </h1>";
        }
      ?>
            </div>
            <br>
              <br>
                <br>
                  <br>
                    <br>
                  <br>
                <br>
              <br>
            <section class="index-intro">
          <h1>Customer details page</h1>
        <p>Interesting Stuff!!</p>
      </section>
    <h3>In order to get to the Admin Page Please Log in as an Administrator </h3>
  </body>
</html>