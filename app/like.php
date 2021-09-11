
<?php



if (isset($_POST['liked'])) {
    $postid = $_POST['postid'];
    $result = mysqli_query($con, "SELECT * FROM publication WHERE id=$postid");
    $row = mysqli_fetch_array($result);
    $n = $row['likes'];

    $imageNotif = $row['image'];
    $videoNotif = $row['video'];
    $datelike = date('Y-m-d H:i:s');
    $user_id=$user_data['user_id'];
    $notiflike=1;
    $notifcomment=0;
    mysqli_query($con, "INSERT INTO likes (userid, postid,date) VALUES ($user_id, $postid,'$datelike')");
    mysqli_query($con, "INSERT INTO notification (userid, postid,date,likes,comment) VALUES ($user_id, $postid,'$datelike','$notiflike','$notifcomment')");
    mysqli_query($con, "UPDATE publication SET likes=$n+1 WHERE id=$postid");

    echo $n + 1;
    exit();
}
if (isset($_POST['unliked'])) {
    $postid = $_POST['postid'];
    $result = mysqli_query($con, "SELECT * FROM publication WHERE id=$postid");
    $row = mysqli_fetch_array($result);
    $n = $row['likes'];
    $user_id=$user_data['user_id'];

    mysqli_query($con, "DELETE FROM likes WHERE postid=$postid AND userid=$user_id");
    mysqli_query($con, "DELETE FROM notification WHERE postid=$postid AND userid=$user_id AND likes=1");
    mysqli_query($con, "UPDATE publication SET likes=$n-1 WHERE id=$postid");

    echo $n - 1;
    exit();
}

// Retrieve posts from the database
$posts = mysqli_query($con, "SELECT * FROM publication");
