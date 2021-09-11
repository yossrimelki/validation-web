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


$iduser=$user_data['user_id'];
$postid = $_GET['id'];
$date=date('Y-m-d H:i:s');
$sql=mysqli_query($con,"INSERT INTO signaler (userid,postid,date) VALUES ('$iduser','$postid','$date');");
header("Location: ../home.php?signaled");