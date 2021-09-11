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


<style>
    <?php
    include('../style/styleindex.css');
    include('../style/stylecreer.css');
    ?>
</style>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MERCURY</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
    <?php
    include('db.php');
    $id = $_GET['id'];
    $user_id = $user_data['user_id'];
    $select = mysqli_query($con, "SELECT * FROM publication WHERE id='$id' AND userposted=$user_id");


    if (!$row = mysqli_fetch_assoc($select)) {
    ?>
        <script>
            window.location.href = '../home.php?you_can_not_update_this_post';
        </script>
    <?php
    }
    $old_image = $row['image'];
    $old_video = $row['video'];
    ?>
</head>

<body>

    <nav>
        <div class="topMenu">
            <div class="menuLink">
                <a class="linkLogo" href="../home.php"><img class="linkImg" src="../img/logo.png"></a>
                <a href="" class="linkKey">WATCH</a>
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
                <a href="../notification.php" class="optionLink" title="notification"><i class="fa fa-heart hov"></i></a>
                <a href="" class="optionLink" title="discover"><i class="fas fa-compass hov"></i></a>
            </div>
        </div>
    </nav>


    <div class="cont">
        <div class="foup">



            <form action="" method="POST" enctype="multipart/form-data">


                <div class="loca">
                    <a class="del" href="../home.php"><i class="fas fa-times iclose"></i></a>
                    <h2>Update Post</h2>
                    <button class="sendbtn" type="submit" name="update"><i class="fas fa-share iclose"></i></button>

                </div>
                <div class="inputlocation">
                    <i class="fas fa-map-marker-alt imap"></i>
                    <input class="location" type="text" name="location" id="search" value="<?= $row['location']; ?>">
                </div>
                <div class="col-md" id="show-list">
                </div>
                <div class="locadescription">
                    <input class="description" type="text" name="description" value="<?= $row['description']; ?>">
                    <br><br><br><br><br><br>
                    <div class="image">
                        <?php if ($row['image'] != '.') {
                            echo "<img class='imagePub' src='../uploads/image/" . $row['image'] . "'>";
                        }
                        if ($row['video'] != '.') {
                            echo "<video class='imagePub' controls> <source src='../uploads/video/" . $row['video'] . "'type=video/mp4></video>";
                        }
                        ?>
                    </div>
                </div>
                <div class="fil">

                    <label for="" class="labelforfile"><i class="fas fa-history iimage"></i>Story</label>
                    <label for="" class="labelforfile"><i class="fas fa-camera iimage"></i> Camera</label>

                    <input type="file" name="file" id="file" class="inputfile" data-multiple-caption="{count} files selected" multiple />
                    <label for="file" class="labelforfile"> <i class="fas fa-images iimage"></i> Photo/Video </label>
                </div>
            </form>
        </div>
    </div>

    <?php

    if (isset($_POST['update'])) {


        $description = $_POST['description'];
        $location = $_POST['location'];


        if ($description === "" || $location === "") {
            echo "update failed! : empty form";
        } else {
            $date = date('Y-m-d H:i:s');


            if (isset($_FILES['file']['name']) && ($_FILES['file']['name'] != "")) {
                $fileName = $_FILES['file']['name'];
                $fileTmpName = $_FILES['file']['tmp_name'];
                $fileSize = $_FILES['file']['size'];
                $fileError = $_FILES['file']['error'];
                $fileType = $_FILES['file']['type'];

                $fileExt = explode('.', $fileName);
                $fileActualExt = strtolower(end($fileExt));

                $allowed = array('jpg', 'jpeg', 'png', 'pdf');
                $allowedV = array('mp4', 'm4v');

                if (in_array($fileActualExt, $allowed)) {
                    if ($fileError === 0) {
                        if ($fileSize < 1000000) {
                            $fileNameNew = uniqid('', true) . "." . $fileActualExt;
                            $fileDestination = '../uploads/image/' . $fileNameNew;



                            move_uploaded_file($fileTmpName, $fileDestination);


                            unlink("../uploads/image/$old_image");

                            unlink("../uploads/video/$old_video");


                            $fileNameNewV = '.';

                            header("Location: ../home.php?uploadsuccess");
                        } else {
                            echo "your file is too big!";
                        }
                    } else {
                        echo "there was an error uploading your file!";
                    }
                } else if (in_array($fileActualExt, $allowedV)) {
                    if ($fileError === 0) {
                        if ($fileSize < 100000000) {
                            $fileNameNewV = uniqid('', true) . "." . $fileActualExt;
                            $fileDestinationV = '../uploads/video/' . $fileNameNewV;



                            move_uploaded_file($fileTmpName, $fileDestinationV);

                            unlink("../uploads/image/$old_image");

                            unlink("../uploads/video/$old_video");


                            $fileNameNew = '.';

                            header("Location: ../home.php?uploadsuccess");
                        } else {
                            echo "your file is too big!";
                        }
                    } else {
                        echo "there was an error uploading your file!";
                    }
                } else {
                    echo "you cannot uplload files of this type!";
                }
            } else {
                $fileNameNewV = $old_video;
                $fileNameNew = $old_image;
            }


            $update = mysqli_query($con, "UPDATE publication SET image='$fileNameNew' , video='$fileNameNewV' , description='$description' , location='$location', date='$date' WHERE id='$id'");

            if ($update) {

    ?>
                <script>
                    window.location.href = '../home.php?data_update_seccessfully';
                </script>
    <?php
            } else {
                echo "update failed";
            }
        }
    }

    ?>
    <script src="../app/searchcountry.js"></script>
</body>

</html>