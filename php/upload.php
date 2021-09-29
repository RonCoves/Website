<?php
if (isset($_POST['upload']))
{
    $file = $_FILES['file'];

    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

    // Here we get the file extension of the uploaded file
    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    //which file types we will allow
    $allowed = array(
        'jpg',
        'jpeg',
        'png',
        'pdf'
    );

    //check if the file is an allowed file type
    if (in_array($fileActualExt, $allowed))
    {
        //Check for upload errors
        if ($fileError === 0)
        {
            // Here we check for file size
            if ($fileSize < 1000000)
            {
                // Here we create a new unique name for the file
                $fileNameNew = uniqid('', true) . "." . $fileActualExt;
                // Here we create the path the file should get uploaded to
                $fileDestination = 'uploads/' . $fileNameNew;
                // Now we upload the file!
                move_uploaded_file($fileTmpName, $fileDestination);
                // And send the user back to the front page
                header("location: ../pg2_admin.php?error=success");
            }
            else
            {
                header("location: ../pg2_admin.php?error=size");

            }
        }
        else
        {
            header("location: ../pg2_admin.php?error=oops");
        }
    }
    else
    {
        header("location: ../pg2_admin.php?error=incorrectfile");
    }
}
?>
