<?php
    if (isset($_POST["submit"]))
    {

        $username = $_POST["uid"];
        $pwd = $_POST["pwd"];
        //functions can be found in functions.php
        require_once "connection.php";
        require_once 'functions.php';

        // Left inputs empty
        if (emptyInputLogin($username, $pwd) === true)
        {
            header("location: ../pg1_login.php?error=emptyinput");
            exit();
        }

        // Now we insert the user into the database
        loginUser($conn, $username, $pwd);

    }
    else
    {
        header("location: ../pg1_login.php");
        exit();
    }

?>
