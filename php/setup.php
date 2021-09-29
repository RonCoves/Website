<?php

if (isset($_POST['installDb']))
{

	$serveraddress= "localhost";
	$dbUser = "root";
	$dbPassword = "";
	// Create connection
	$conn1 = mysqli_connect($serveraddress, $dbUser, $dbPassword);

	// Create database
	$sqli = "CREATE DATABASE phpData";
	$dbc = mysqli_query($conn1, $sqli);



    include_once "connection.php";

    $create = ("CREATE TABLE users 
        (
        usersId int(11) not null PRIMARY KEY AUTO_INCREMENT,
        usersName varchar(128) not null,
        usersEmail varchar(128) not null,
        usersUid varchar(128) not null,
        usersPwd varchar(128) not null,
        admin int(1) not null
        );");

          $res = mysqli_query($conn, $create);


         	if($res){ 
        		header("location: ../pg1_login.php?error=databasegood");
	   		}    

    $setHashedPwd = password_hash(123, PASSWORD_DEFAULT);
    $insert = "INSERT INTO users (usersName, usersEmail, usersUid, usersPwd, admin) VALUES ('Ron', 'ron@ron.com', 'Ron', '$setHashedPwd', '1');";
    $insert2 = "INSERT INTO users (usersName, usersEmail, usersUid, usersPwd, admin) VALUES ('Magda', 'magda@magda.com', 'Magda', '$setHashedPwd', '0');";

    $res2 = mysqli_query($conn, $insert);
    $res3 = mysqli_query($conn, $insert2);

 	
}

?>
