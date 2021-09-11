<?php
session_start();

include("../classes/connect.php");
include("../classes/login.php");
include("../classes/user.php");
//check if  user is logged in 
if (isset($_SESSION['mercury_user_id']) && is_numeric($_SESSION['mercury_user_id'])) {
    $id = $_SESSION['mercury_user_id'];
    $login = new login();
    $result = $login->check_login($id);

    if ($result) {
        //user data

        $user = new User();
        $user_data = $user->get_data($id);
        if (!$user_data) {
            header("location: index.php");
            die;
        }
    } else {
        header("location : index.php");
        die;
    }
} else {
    header("location : index.php");
    die;
}

?>


<?php

include('db.php');

$id = $_GET['id'];
$user_id = $user_data['user_id'];
$select = mysqli_query($con, "SELECT * FROM publication WHERE id='$id' AND userposted=$user_id ");
$row = mysqli_fetch_assoc($select);
if (!$row) {
?>
    <script>
        window.location.href = '../home.php?you_can_not_delete';
    </script>
<?php
} else {
    $sql = "DELETE FROM publication WHERE id='$id' AND userposted=$user_id ";
    mysqli_query($con, "DELETE FROM likes WHERE postid='$id'");
    mysqli_query($con, "DELETE FROM comment WHERE idpost='$id'");
}
if ($row['image'] != '.') {
    $name = $row['image'];
    $i = 1;
}
if ($row['video'] != '.') {
    $name = $row['video'];
    $i = 0;
}

$result = mysqli_query($con, $sql);
if ($result) {
    echo "file delete successfuly";
    if ($i === 0) {
        unlink("../uploads/video/$name");
    } else {
        unlink("../uploads/image/$name");
    }
?>
    <script>
        window.location.href = '../home.php?file_delete_successfuly';
    </script>
<?php
} else {
    echo "not deleted";
?>
    <script>
        window.location.href = '../home.php?error';
    </script>
<?php
}


?>