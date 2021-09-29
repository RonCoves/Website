<?php
// Check for empty input signup
function emptyInputSignup($name, $email, $username, $pwd, $pwdRepeat)
{
    $result;
    if (empty($name) || empty($email) || empty($username) || empty($pwd) || empty($pwdRepeat))
    {
        $result = true;
    }
    else
    {
        $result = false;
    }
    return $result;
}

// Check invalid username
function invalidUid($username)
{
    $result;
    if (!preg_match("/^[a-zA-Z0-9]*$/", $username))
    {
        $result = true;
    }
    else
    {
        $result = false;
    }
    return $result;
}

// Check invalid email
function invalidEmail($email)
{
    $result;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        $result = true;
    }
    else
    {
        $result = false;
    }
    return $result;
}

// Check if passwords matches
function pwdMatch($pwd, $pwdrepeat)
{
    $result;
    if ($pwd !== $pwdrepeat)
    {
        $result = true;
    }
    else
    {
        $result = false;
    }
    return $result;
}

// Check if username is in database, if so then return data
function uidExists($conn, $username)
{
    $sql = "SELECT * FROM users WHERE usersUid = ? OR usersEmail = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: ../pg2_admin.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $username, $username);
    mysqli_stmt_execute($stmt);

    // returns the results from a prepared statement
    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData))
    {
        return $row;
    }
    else
    {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

// Insert new user into database
function createUser($conn, $name, $email, $username, $pwd, $admin)
{
    $sql = "INSERT INTO users (usersName, usersEmail, usersUid, usersPwd, admin) VALUES (?, ?, ?, ?, ?);";

    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: ../pg2_admin.php?error=stmtfailed");
        exit();
    }

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "sssss", $name, $email, $username, $hashedPwd, $admin);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    header("location: ../pg2_admin.php?error=noerrors");
    exit();

}

// Check for empty input login
function emptyInputLogin($username, $pwd)
{
    $result;
    if (empty($username) || empty($pwd))
    {
        $result = true;
    }
    else
    {
        $result = false;
    }
    return $result;
}

// Log user into website
function loginUser($conn, $username, $pwd)
{
    $uidExists = uidExists($conn, $username);

    if ($uidExists === false)
    {
        header("location: ../pg1_login.php?error=wronglogin");
        exit();
    }

    $pwdHashed = $uidExists["usersPwd"];
    $checkPwd = password_verify($pwd, $pwdHashed);

    if ($checkPwd === false)
    {
        header("location: ../pg1_login.php?error=wronglogin");
        exit();
    }

    elseif ($checkPwd === true)
    {
        session_start();
        $_SESSION["userid"] = $uidExists["usersId"];
        $_SESSION["userUid"] = $uidExists["usersUid"];

        $query = ("SELECT `admin` FROM `users` WHERE `usersEmail` = '$username' ;");
        $result2 = mysqli_query($conn, $query);

        if ($username == $_SESSION["userUid"])
        {
            header("location: ../pg1_login.php?error=wronguid");
        }
        if ($result2)
        {
            $row2 = mysqli_fetch_assoc($result2);

            // get user type here - admin or login
            $user_type = $row2['admin'];
            if ($user_type == "1")
            {

                header("location: ../pg2_admin.php?error=noerrorA");
            }

            if ($user_type == "0")
            {

                header("location: ../pg3_user.php?error=noerrorU");
            }

            exit();
        }
    }

}
?>