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
?>
<style>
    <?php
    include('../style/styleindex.css');
    include('../style/stylepromotions.css');
    ?>
</style>



<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
</head>

<body>
    <nav>
        <div class="topMenu">
            <div class="menuLink">
                <a class="linkLogo" href="../home.php"><img class="linkImg" src="../img/logo.png" alt=""></a>
                <a href="" class="linkKey">WATCH</a>
                <a href="../profilpost.php" class="linkKey" style="color: #ef9d87;">PROFIL</a>
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

    <!--khidmit 7ammma lina tnajem tbaddal lit7ib -->
    <div class="cont">
        <div class="wrapper">
            <div class="card">
                <!--lina 7ot tasswira ta3 promotion-->
                <img src="../img/homeimg.jpg" alt="">
                <div class="info">
                    <h1>issim lpromotion ili t7ib t7otha</h1>
                    <p>lina iktib pragraphe 3araf bil promotion </p>
                    <a href="" class="btn">lahna lbutton ta3 lachat</a>
                </div>
            </div>
        </div>
        <div class="wrapper">
            <div class="card">
                <!--lina 7ot tasswira ta3 promotion-->
                <img src="../img/images (1).jpg" alt="">
                <div class="info">
                    <h1>issim lpromotion ili t7ib t7otha</h1>
                    <p>lina iktib pragraphe 3araf bil promotion </p>
                    <a href="" class="btn">lahna lbutton ta3 lachat</a>
                </div>
            </div>
        </div>
        <div class="wrapper">
            <div class="card">
                <!--lina 7ot tasswira ta3 promotion-->
                <img src="../img/images (5).jpg" alt="">
                <div class="info">
                    <h1>issim lpromotion ili t7ib t7otha</h1>
                    <p>lina iktib pragraphe 3araf bil promotion </p>
                    <a href="" class="btn">lahna lbutton ta3 lachat</a>
                </div>
            </div>
        </div>
</body>

</html>