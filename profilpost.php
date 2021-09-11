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

?>




<?php
include('classes/db.php');
include('app/like.php');
?>
<style>
    <?php
    include('style/styleindex.css');
    include('style/stylepublication.css');
    include('style/styleslikes.css');
    include('style/styleprofil2.css');
    ?>
</style>


<link rel="stylesheet" href="style/styleindex.css">
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $user_data['fullname']  ?> PROFILE</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
</head>

<body>
    <nav>
        <div class="topMenu">
            <div class="menuLink">
                <a class="linkLogo" href="home.php"><img class="linkImg" src="img/logo.png" alt=""></a>
                <a href="disgroup.php" class="linkKey">GROUP</a>
                <a href="profilpost.php" class="linkKey" style="color: #ef9d87;">PROFIL</a>
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
                <a href="creerpost.php" class="optionLink" title="creer"><i class="fas fa-plus-square hov"></i></a>
                <a href="notification.php" class="optionLink" title="notification"><i class="fa fa-heart hov"></i><span style="color: #ef9d87;"></span></a>
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
                <li><a href="profilpost.php" class="feed" style="color: #ef9d87;">POSTS</a></li>
                <li><a href="profilphoto.php" class="feed">PHOTOS</a></li>

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



            <?php
            $i = 0;
            $j = 0;
            $user_id = $user_data['user_id'];
            $sql = "SELECT * FROM publication WHERE userposted=$user_id  ORDER BY date DESC ; ";
            $result = mysqli_query($con, $sql);
            if ($resultCheck = mysqli_num_rows($result)) {
                while ($row = mysqli_fetch_array($result)) {





                    $i++;
            ?>



                    <article>
                        <div class="image">
                            <?php if ($row['image'] != '.') {
                                echo "<img class='imagePub' src='uploads/image/" . $row['image'] . "'>";
                            }
                            if ($row['video'] != '.') {
                                echo "<video class='imagePub' controls> <source src='uploads/video/" . $row['video'] . "'type=video/mp4></video>";
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
                                    echo "<img class='imgUser' src='img/" . $rowuser['profile_img'] . "'>";
                                    ?>
                                </div>
                                <a href="" class="nameUser"><?php echo $rowuser['fullname'] ?></a>
                            </div>
                            <a href="" class="nameLocation"><?php echo $row['location']; ?></a>
                        </div>
                        <div class="postEntry">
                            <p class="description"><?php echo $row['description']; ?></p>
                            <a href="" class="readm"><span class="readmore">CONTINUE READING</span></a>
                        </div>
                        <div class="postMeta">
                            <div class="metaop">

                                <button class="btnComment" onclick="hide_show(<?php echo $i ?>)"><i class="fas fa-comments sharetwitter"></i></button>
                                <a href="classes/updatepost.php?id=<?php echo $row['id']; ?>">
                                    <div class="a-share"><i class="fas fa-edit sharetwitter"></i></div>
                                </a>
                                <a href="classes/deletepost.php?id=<?php echo $row['id']; ?>">
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

                            $user_id = $user_data['user_id'];
                            $results = mysqli_query($con, "SELECT * FROM likes WHERE userid=$user_id AND postid=" . $row['id'] . "");

                            if (mysqli_num_rows($results) == 1) : ?>

                                <span class="unlike " data-id="<?php echo $row['id']; ?>"><i class="fas fa-heart size"></i></span>
                                <span class="like hide " data-id="<?php echo $row['id']; ?>"><i class="far fa-heart size"></i></span>
                            <?php else : ?>

                                <span class="like " data-id="<?php echo $row['id']; ?>"><i class="far fa-heart size"></i></span>
                                <span class="unlike hide" data-id="<?php echo $row['id']; ?>"><i class="fas fa-heart size"></i></span>
                            <?php endif ?>
                            <span class="metaInfo"></i><?php echo $row['likes']; ?> likes </span>
                            <span class="metacomment"></i><?php echo $row['comment']; ?> Comments</span>
                            <span class="metaInfor"><?php echo $row['date']; ?></span>
                        </div>
                        <div class="contcomments" id="<?php echo $i ?>">
                            <?php
                            $resultcomment = mysqli_query($con, "SELECT * FROM comment WHERE idpost=" . $row['id'] . "");
                            if (mysqli_num_rows($resultcomment) > 0) {
                                while ($rowcomment = mysqli_fetch_array($resultcomment)) {
                                    $j++;
                                    $useridcom = $rowcomment['iduser'];
                                    $resuserom = mysqli_query($con, "SELECT * FROM users WHERE user_id=$useridcom");
                                    $rowcommentus = mysqli_fetch_array($resuserom);
                            ?>
                                    <div class="commentcont">
                                        <?php echo "<img class='usercommentimgf' src='img/" . $rowcommentus['profile_img'] . "'>"; ?>
                                        <div class="contucom">
                                            <h3><?php echo $rowcommentus['fullname'] ?></h3>
                                            <b><?php echo $rowcomment['content'] ?></b>
                                            <span class="timecomment"><?php echo $rowcomment['date']; ?></span>
                                        </div>
                                        <div class="contoptioncomment">
                                            <?php
                                            if ($user_data['user_id'] == $rowcomment['iduser']) { ?>
                                                <button class="btnComment" onclick="hide_showt(<?php echo $j ?>)"><i class="fas fa-edit sharetwitter"></i></button>
                                                <a href="classes/deletecomment.php?id=<?php echo $rowcomment['id']; ?>">
                                                    <div class="a-share"><i class="fas fa-trash-alt sharetwitter"></i></div>
                                                </a>
                                            <?php } else { ?>
                                                <a href="">
                                                    <div class="a-share"><i class="fas fa-exclamation-circle sharetwitter"></i></div>
                                                </a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="commentconts" id="edit<?php echo $j ?>">
                                        <?php
                                        echo "<img class='usercommentimg' src='img/" . $user_data['profile_img'] . "'>"; ?>
                                        <form class="formcomment" action="classes/updatecomment.php?id=<?php echo $rowcomment['id']; ?>" method="POST" enctype="multipart/form-data">
                                            <input name="newcomment" class="inputcomment" type="text" value="<?= $rowcomment['content']; ?>">
                                            <button name="updatecomment" type="submit" class="sendbtn"><i class="fas fa-paper-plane sharetwitter"></i></button>
                                        </form>
                                    </div>
                            <?php }
                            } ?>

                            <div class="contin">
                                <?php echo "<img class='usercommentimg' src='img/" . $user_data['profile_img'] . "'>"; ?>
                                <form class="formcomment" action="classes/comment.php?id=<?php echo $row['id']; ?>" method="POST" enctype="multipart/form-data">
                                    <input name="comment" class="inputcomment" type="text" placeholder="add a comment...">
                                    <button name="commenter" type="submit" class="sendbtn"><i class="fas fa-paper-plane sharetwitter"></i></button>
                                </form>
                            </div>
                        </div>
                    </article>
            <?php
                }
            } else {
                echo    " <div class='image'>";
                echo "<img class='imagePub' src='img/nop.jpeg'>";
                echo "</div>";
            }
            ?>
        </aside>

    </div>



    <script src="app/like.js"></script>
    <script src="app/comment.js"></script>
</body>

</html>