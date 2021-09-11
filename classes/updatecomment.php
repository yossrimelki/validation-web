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
				header("location: index.php");
				die;
			}
		}else{
			header("location : index.php");
			die;
		}
	}
	else {
		header("location : index.php");
		die;
	}
include('db.php');

if (isset($_POST['updatecomment'])){
    $id=$_GET['id'];
    $content=$_POST['newcomment'];
    $date = date('Y-m-d H:i:s');
    $update = mysqli_query($con, "UPDATE comment SET content='$content', date='$date' WHERE id='$id'");
}

if($update){
    ?>
    <script>
        window.location.href = '../home.php?data_update_seccessfully';
    </script>
<?php
} else {
    echo "update failed";
}
