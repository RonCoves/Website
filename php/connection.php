<?php
$servername = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "phpData";
//Pass connection to database

$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);

if (!$conn)
{
    die("Connection failed: " . mysqli_connect_error());
}

?>