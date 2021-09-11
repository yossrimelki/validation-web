<?php
session_start();
include("classes/connect.php");
include("classes/login.php");
include("classes/user.php");
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


$userid=$user_data['user_id'];

?>








<?php
include('classes/db.php');
include('app/like.php');
?>
<style>
    <?php
    include('style/styleindex.css');
  
    include('style/styleprofil2.css');
    ?>
</style>

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $user_data['fullname']  ?> PROFILE</title>
    <link rel="stylesheet" href="style/styleprofil2.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
</head>

<body>
    <nav>
        <div class="topMenu">
            <div class="menuLink">
                <a class="linkLogo" href="index.php"><img class="linkImg" src="img/logo.png" alt=""></a>
                <a href="" class="linkKey">WATCH</a>
                <a href="profil.html" class="linkKey" style="color: #ef9d87;">PROFIL</a>
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
                <a href="creer.php" class="optionLink" title="creer"><i class="fas fa-plus-square hov"></i></a>
                <a href="notification.php" class="optionLink" title="notification"><i class="fa fa-heart hov"></i></a>
                <a href="" class="optionLink" title="discover"><i class="fas fa-compass hov"></i></a>
            </div>
        </div>
    </nav>
    <div class="space">

    </div>
    <div class="cont">
    <aside class="left">
            <div class="contimageuser">
                <div class="contimgprofil">
                <?php echo "<img class='imguser' src='" . $user_data['profile_img'] . "'>"; ?>
                </div>
            </div>
            <div class="contnameuser">
                <h2 class="nameuser"><?php echo $user_data['fullname']  ?></h2>
            </div>
            <div class="contlinelefttop">
                <span class="line"></span>
            </div>
            <div class="contfolo">
                <h4 class="folo"><?php echo $user_data['followers']  ?></h4>
                <h4 class="folo"><?php echo $user_data['following']  ?></h4>
                <?php
                $userid = $user_data['user_id'];
                $sqlfind = "SELECT * FROM publication WHERE userposted=$userid ";
                $resultfind = mysqli_query($con, $sqlfind);
                $nbpost = 0;
                $nblikes = 0;
                while ($rowfind = mysqli_fetch_array($resultfind)) {
                    $nbpost++;
                    $nblikes = $nblikes + $rowfind['likes'];
                }
                ?>
                <h4 class="folo"><?php echo $nblikes ?> / <?php echo $nbpost ?></h4>
            </div>
            <div class="contfolo">
                <a class="fol" href="">Followers</a>
                <a class="fol" href="">Following</a>
                <a class="fol" href="">Hearts/Posts</a>
            </div>
            <div class="contbot">
                <button class="butfoll">follow</button>
                <a href="classes/promotions.php"><button class="butfoll">promotions</button></a>
            </div>
            <div class="contlineleftbottom">
                <span class="line"></span>
            </div>
            <div class="para">
                <p class="par"><?php echo $user_data['bio']  ?></p>
            </div>
            <div class="contline">
                <span class="line"></span>
            </div>
            <div class="more">
                <h3 class="mor">Feed</h3>
                <li><a href="profilpost.php" class="feed" >POSTS</a></li>
                <li><a href="profilphoto.php" class="feed" style="color: #ef9d87;">PHOTOS</a></li>

            </div>
            <div class="more">
                <h3 class="mor">Favorite Tags</h3>
                <p class="par"><?php echo $user_data['Tags']  ?></p>
            </div>
            <div class="more">
                <h3 class="mor">Activity</h3>
                <p class="par"><?php echo $user_data['activity']  ?></p>
            </div>
            <div class="more">
                <h3 class="mor">Location</h3>
                <p class="par"><?php echo $user_data['location']  ?></p>
            </div>
            <div class="more">
                <h3 class="mor">Favorite Profiles</h3>
            </div>
            <div class="contsetting">
                <div class="setting">
                    <a href="settings.php"><i class="fas fa-cog st"></i></a>
                </div>
                <div class="setting">
                    <a href="classes/logout.php"> <i class="fas fa-sign-out-alt st"></i></a>
                </div>
            </div>
        </aside>
        <aside class="right">
            <div class="stories">
                <div class="header">
                    <h3 class="headstory">Featured Stories</h3>
                </div>
                <div class="contstories">
                <?php
                    $sqlstory = "SELECT * FROM story   WHERE userid=$userid; ";
                    $resultstory = mysqli_query($con, $sqlstory);
                    $resultCheckstory = mysqli_num_rows($resultstory);

                    if ($resultCheckstory > 0) {
                        while ($rowstory = mysqli_fetch_array($resultstory)) {
                    ?>

                            <div class="story">
                                <?php if ($rowstory['image'] != '.') {
                                    echo "<img class='story' src='uploads/image/" . $rowstory['image'] . "'>";
                                }
                                if ($rowstory['video'] != '.') {
                                    echo "<video class='story'  src='uploads/video/" . $rowstory['video'] . "'>";
                                }
                                ?>
                            </div>

                    <?php  }
                    } ?>
                </div>
            </div>
            <div class="contline">
                <span class="line"></span>
            </div>
            <article class="article">
                <div class="header">
                    <h3 class="headstory">Photo Feed</h3>
                </div>
                <div class="contphoto">
                    <div class="photo">
                        <img class="photo" src="img/place-des-victoires-paris_5780553.jpg" alt="">
                    </div>
                    <div class="photo">
                        <img class="photo" src="img/1522031856519.jpg" alt="">
                    </div>
                    <div class="photo">
                        <img class="photo" src="img/download (1).jpg" alt="">
                    </div>

                </div>
                <div class="contphoto">
                    <div class="photo">
                        <img class="photo" src="img/download (2).jpg" alt="">
                    </div>
                    <div class="photo">
                        <img class="photo" src="img/download (3).jpg" alt="">
                    </div>
                    <div class="photo">
                        <img class="photo" src="img/download.jpg" alt="">
                    </div>

                </div>
                <div class="contphoto">
                    <div class="photo">
                        <img class="photo" src="img/images (10).jpg" alt="">
                    </div>
                    <div class="photo">
                        <img class="photo" src="img/images (4).jpg" alt="">
                    </div>
                    <div class="photo">
                        <img class="photo" src="img/images (5).jpg" alt="">
                    </div>

                </div>
            </article>
        </aside>

    </div>
</body>

</html>