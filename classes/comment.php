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

if (isset($_POST['commenter'])){
    $postid = $_GET['id'];
    $result = mysqli_query($con, "SELECT * FROM publication WHERE id=$postid");
    $row = mysqli_fetch_array($result);
    $n = $row['comment'];

  
    $comment=$_POST['comment'];
    $notifcomment=1;
    $notiflike=0;
    if($comment==="" && $postid===""){
        echo "comment failed! : empty form";
    }else{
        $date=date('Y-m-d H:i:s');
        $sql=mysqli_query($con,"INSERT INTO comment (content,iduser,date,idpost) VALUES ('$comment','$iduser','$date','$postid');");
        mysqli_query($con, "INSERT INTO notification (userid, postid,date,likes,comment) VALUES ($iduser, $postid,'$date','$notiflike','$notifcomment')");
        mysqli_query($con, "UPDATE publication SET comment=$n+1 WHERE id=$postid");
        header("Location: ../home.php?commented ");
    }
}