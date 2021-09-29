<?php
	session_start();
	session_unset();
	session_destroy();

	header("location: ../pg1_login.php");
	exit();
?>