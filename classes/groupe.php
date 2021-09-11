<?php
session_start();
include("connect.php");
include("login.php");
include("user.php");
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
            header("location: ../index.php");
            die;
        }
    } else {
        header("location : ../index.php");
        die;
    }
} else {
    header("location : ../index.php");
    die;
}

?>



<?php
include('db.php');
include('../app/like.php');
?>
<style>
    <?php
    include('../style/styleindex.css');
    include('../style/stylegroup.css');
    include('../style/styleslikes.css');
    ?>
</style>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>group</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
</head>

<body>

    <nav>
        <div class="topMenu">
            <div class="menuLink">
                <a class="linkLogo" href="../home.php" style="color: #ef9d87;"><img class="linkImg" src="../img/logo.png" alt=""></a>
                <a href="../disgroup.php" class="linkKey" style="color: #ef9d87;">GROUP</a>
                <a href="../profilpost.php" class="linkKey">PROFIL</a>
            </div>
            <div class="menuSearch">
                <div class="searchBox">
                    <input type="text" name="" id="" class="search" placeholder="what are you looking for?">
                    <button type="submit" class="search-btn">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
            <div class="menuOption">
                <a href="../creerpost.php" class="optionLink" title="creer"><i class="fas fa-plus-square hov"></i></a>
                <a href="../notification.php" class="optionLink" title="notification"><i class="fa fa-heart hov"></i><span style="color: #ef9d87;"></span></a>
                <a href="" class="optionLink" title="discover"><i class="fas fa-compass hov"></i></a>
            </div>
        </div>
    </nav>

    <div class="space">
    </div>
    <div class="cont">
        <div class="left">
            <div class="grcont">
                <h2>Menu Group</h2>
            </div>
            <li><i class="fas fa-users icongr"></i><a href="../disgroup.php" class="dis">Discover </a></li>
            <li><i class="fas fa-compass icongr"></i> <a href="../classes/groupe.php" class="dis">Home</a></li>
            <li><i class="fas fa-plus-circle icongr"></i> <a href="" class="dis">Creat </a></li>
            <div class="contline">
                <span class="line"></span>
            </div>
            <div class="grcont">
                <h2>Your Group</h2>
            </div>
            <div class="contugr">
                <img class="imgugr" src="../img/ashref.jpg" alt="">
                <h3>name group</h3>
            </div>
        </div>
        <aside class="right">
            <?php

            $user_id = $user_data['user_id'];
            //lina twilli fi couth publication where userposted = twili kif lbase li3andik yaani where idgroup = welle haja hika wil baki kima houma whawka mrigl
            $sql = "SELECT * FROM publication WHERE userposted=$user_id  ORDER BY date DESC ; ";
            $result = mysqli_query($con, $sql);
            if ($resultCheck = mysqli_num_rows($result)) {
                while ($row = mysqli_fetch_array($result)) {
            ?>


                    <article>
                        <div class="image">
                            <?php if ($row['image'] != '.') {
                                echo "<img class='imagePub' src='../uploads/image/" . $row['image'] . "'>";
                            }
                            if ($row['video'] != '.') {
                                echo "<video class='imagePub' controls> <source src='../uploads/video/" . $row['video'] . "'type=video/mp4></video>";
                            }
                            ?>
                        </div>
                        <div class="postHeader">
                            <div class="profilUser">
                                <div class="imageprofil">
                                    <?php
                                    $user_id = $row['userposted'];
                                    $sqluser = "SELECT * FROM users WHERE user_id=$user_id LIMIT 1 ; ";
                                    $resultuser = mysqli_query($con, $sqluser);
                                    $rowuser = mysqli_fetch_assoc($resultuser);
                                    echo "<img class='imgUser' src='../img/" . $rowuser['profile_img'] . "'>";
                                    ?>
                                </div>
                                <a href="" class="nameUser"><?php echo $rowuser['fullname'] ?></a>
                            </div>
                            <a href="" class="nameLocation">
                                <?php echo $row['location']; ?>
                            </a>
                        </div>
                        <div class="postEntry">
                            <p class="description">
                                <?php echo $row['description']; ?>
                            </p>
                            <a href="" class="readm"><span class="readmore">CONTINUE READING</span></a>
                        </div>
                        <div class="postMeta">
                            <div class="metaop">
                                <a href="">
                                    <div class="a-share"><i class="fas fa-comments sharetwitter"></i></div>
                                </a>
                                <a href="../classes/updatepost.php?id=<?php echo $row['id']; ?>">
                                    <div class="a-share"><i class="fas fa-edit sharetwitter"></i></div>
                                </a>
                                <a href="../classes/deletepost.php?id=<?php echo $row['id']; ?>">
                                    <div class="a-share"><i class="fas fa-trash-alt sharetwitter"></i></div>
                                </a>

                            </div>

                            <div class="metaShare">
                                <a href="">
                                    <div class="a-share"><i class="fab fa-facebook-f sharefacebook"></i></div>
                                </a>
                                <a href="">
                                    <div class="a-share"><i class="fab fa-twitter sharetwitter"></i></div>
                                </a>
                                <a href="">
                                    <div class="a-share"><i class="fab fa-instagram sharetwitter"></i></div>
                                </a>

                            </div>
                        </div>

                        <div class="postMeta">
                            <?php
                            $results = mysqli_query($con, "SELECT * FROM likes WHERE userid=$user_id AND postid=" . $row['id'] . "");

                            if (mysqli_num_rows($results) == 1) : ?>

                                <span class="unlike " data-id="<?php echo $row['id']; ?>"><i class="fas fa-heart size"></i></span>
                                <span class="like hide " data-id="<?php echo $row['id']; ?>"><i class="far fa-heart size"></i></span>
                            <?php else : ?>

                                <span class="like " data-id="<?php echo $row['id']; ?>"><i class="far fa-heart size"></i></span>
                                <span class="unlike hide" data-id="<?php echo $row['id']; ?>"><i class="fas fa-heart size"></i></span>
                            <?php endif ?>
                            <span class="metaInfo"></i><?php echo $row['likes']; ?> likes </span>
                            <span class="metaInfor"><?php echo $row['date']; ?></span>
                            <div class="contline">
                                <span class="line"></span>
                            </div>
                        </div>

                    </article>
            <?php
                }
            } else {
                echo    " <div class='image'>";
                echo "<img class='imagePub' src='../img/nop.jpeg'>";
                echo "</div>";
            }
            ?>


        </aside>
    </div>
    <script src="../app/likeprefolder.js"></script>
</body>

</html>