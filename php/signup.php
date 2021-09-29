<?php
if (isset($_POST["submit"]))
{

    // get the form data 
    $name = $_POST["name"];
    $email = $_POST["email"];
    $username = $_POST["uid"];
    $pwd = $_POST["pwd"];
    $pwdRepeat = $_POST["pwdrepeat"];
    $admin = $_POST["adminRadio"];
    $file = $_FILES['file'];
    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

    // functions in functions.php
    require_once "connection.php";
    require_once "functions.php";
    

    //  file extension of the uploaded file
    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    // which file types permitted
    $allowed = array(
        'jpg',
        'jpeg',
        'png',
        'pdf'
    );

    // Now we check if the file is an allowed file type
    if (in_array($fileActualExt, $allowed))
    {
        // Here we check for upload errors
        if ($fileError === 0)
        {
            // Here we check for file size
            if ($fileSize < 30000)
            {
                // Here we create a new unique name for the file
                $fileNameNew = $username . "." . $fileActualExt;

                // Here we create the path the file should get uploaded to
                $fileDestination = 'uploads/' . $fileNameNew;
                // Now we upload the file!
                move_uploaded_file($fileTmpName, $fileDestination);
                // And send the user back to the front page
                header("location: ../pg2_admin.php?upload=success");
            }
            else
            {
                echo "Your file is too big!";
            }
        }
        else
        {
            echo "There was an error uploading your file!";
        }
    }
    else
    {
        echo "You cannot upload files of this type!";
    }

    // Left inputs empty
    if (emptyInputSignup($name, $email, $username, $pwd, $pwdRepeat) !== false)
    {
        header("location: ../pg2_admin.php?error=emptyinput");
        exit();
    }
    // wrong username chosen
    if (invalidUid($uid) !== false)
    {
        header("location: ../pg2_admin.php?error=invaliduid");
        exit();
    }
    // wrong email chosen
    if (invalidEmail($email) !== false)
    {
        header("location: ../pg2_admin.php?error=invalidemail");
        exit();
    }
    //  passwords match?
    if (pwdMatch($pwd, $pwdRepeat) !== false)
    {
        header("location: ../pg2_admin.php?error=passwordsdontmatch");
        exit();
    }
    // Is the username taken
    if (uidExists($conn, $username) !== false)
    {
        header("location: ../pg2_admin.php?error=usernametaken");
        exit();
    }

    //insert the user into the database
    createUser($conn, $name, $email, $username, $pwd, $admin);
}




//alter user admin status
if (isset($_POST["alterSubmit"]))
{
    $alterAdmin = $_POST["admin"];
    $idNo = $_POST["idNo"];

    require_once "connection.php";

   $update = "UPDATE users SET admin =  '$alterAdmin' WHERE usersId = '$idNo'";
   if(mysqli_query($conn, $update)){
        echo "Admin Status Updated";
        header("location: ../pg2_admin.php?error=dbupdate");
   } 
   else{
        echo "There was an error updating the database";
        header("location: ../pg2_admin.php?error=dbError");
   }
} 


//alter user password
if (isset($_POST["pwdSubmit"]))
{
    $pwdAlter = $_POST["pwdAlter"];
    $idNo2 = $_POST["idNo2"];

    require_once "connection.php";
    $hashpwdAlter = password_hash($pwdAlter, PASSWORD_DEFAULT);

   $update2 = "UPDATE users SET usersPwd = '$hashpwdAlter' WHERE usersId = '$idNo2'";
   if(mysqli_query($conn, $update2)){ 
        header("location: ../pg2_admin.php?error=pwupdate");
   } 
   else{
        header("location: ../pg2_admin.php?error=pwdbError");
   }
}


//delete user
if (isset($_POST["deleteSubmit"]))
{
    $idNo3 = $_POST["idNo3"];

    require_once "connection.php";

   $update3 = "DELETE FROM users WHERE usersId = '$idNo3'";
   if(mysqli_query($conn, $update3)){
        header("location: ../pg2_admin.php?error=userdeleted");
   } 
   else{
        header("location: ../pg2_admin.php?error=notdel");
   }
}
?>