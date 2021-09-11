<?php

session_start();

include ("../classes/connect.php");
include ("../classes/login.php");
include ("../classes/user.php");
//check if  user is logged in 
if (isset($_SESSION['mercury_user_id'])&& is_numeric($_SESSION['mercury_user_id']))
{
    $id =$_SESSION ['mercury_user_id'];
    $login = new login();
    $result =$login->check_login($id);

    if ($result)
    {	
        //user data

        $user = new User();
        $user_data =$user->get_data($id);
        if (!$user_data)
        {
            header("location: ../index.php");
            die;
        }
    }else{
        header("location : ../index.php");
        die;
    }
}
else {
    header("location : ../index.php");
    die;
}


include('db.php');


if (isset($_POST['submit'])) {
    $file = $_FILES['file'];

    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

   
    $user_id=$user_data['user_id'];
    $user_name=$user_data['fullname'];
    $date = date('Y-m-d H:i:s');

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png', 'pdf');
    $allowedV = array('mp4', 'm4v');
    if ($fileName!=""){
    if (in_array($fileActualExt, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 10000000) {
                $fileNameNew = uniqid('', true).".".$fileActualExt;
                $fileDestination = '../uploads/image/'.$fileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);
                $sql = "INSERT INTO story (video,image,date,userid) VALUES('.','$fileNameNew','$date','$user_id')";
                $res = mysqli_query($con, $sql);

                header("Location: ../home.php?uploadsuccess");
            } else {
                echo "your file is too big!";
            }
        } else {
            echo "there was an error uploading your file!";
        }
    } else if(in_array($fileActualExt, $allowedV)){
        if ($fileError === 0) {
            if ($fileSize < 100000000) {
                $fileNameNewV = uniqid('', true).".".$fileActualExt;
                $fileDestinationV = '../uploads/video/'.$fileNameNewV;
                move_uploaded_file($fileTmpName, $fileDestinationV);
                $sqlV = "INSERT INTO story (image,video,date,userid) VALUES('.','$fileNameNewV','$date','$user_id')";
                $res = mysqli_query($con, $sqlV);

                header("Location: ../home.php?uploadsuccess");
            } else {
                echo "your file is too big!";
            }
        } else {
            echo "there was an error uploading your file!";
        }
    }
    else {
        echo "you cannot uplload files of this type!";
    }
}else{
    echo "upload failed !!! empty form";
}
}
