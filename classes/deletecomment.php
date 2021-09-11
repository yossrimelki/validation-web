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

include('db.php');

$id = $_GET['id'];
$user_id = $user_data['user_id'];


$select = mysqli_query($con, "SELECT * FROM comment WHERE id='$id' AND iduser=$user_id ");
$row = mysqli_fetch_assoc($select);
if (!$row) {
?>
    <script>
        window.location.href = '../home.php?you_can_not_delete_this_comment';
    </script>
<?php
} else {
    $postid=$row['idpost'];
    $sql = "DELETE FROM comment WHERE id='$id' AND iduser=$user_id ";
    $resultpost = mysqli_query($con, "SELECT * FROM publication WHERE id=$postid");
    $rowpost = mysqli_fetch_array($resultpost);
    $n = $rowpost['comment'];
    mysqli_query($con, "UPDATE publication SET comment=$n-1 WHERE id=$postid");
    mysqli_query($con, "DELETE FROM notification WHERE postid=$postid AND userid=$user_id AND comment=1");
}

$result = mysqli_query($con, $sql);


if($result){
?>
<script>
    window.location.href = '../home.php?file_delete_successfuly';
</script>

<?php
}