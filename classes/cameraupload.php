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
    <script type="text/javascript" src="https://unpkg.com/webcam-easy/dist/webcam-easy.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
</head>

<body>
    <nav>
        <div class="topMenu">
            <div class="menuLink">
                <a class="linkLogo" href="../home.php"><img class="linkImg" src="../img/logo.png"></a>
                <a href="../disgroup.php" class="linkKey">GROUP</a>
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
                <a href="../creerpost.php" class="optionLink" title="creer"><i class="fas fa-plus-square hov" style="color: #ef9d87;"></i></a>
                <a href="../notification.php" class="optionLink" title="notification"><i class="fa fa-heart hov"></i></a>
                <a href="" class="optionLink" title="discover"><i class="fas fa-compass hov"></i></a>
            </div>
        </div>
    </nav>



    <div class="cont">
        <div class="foup">
            <div class="loca">
                <a class="del" href="../creerpost.php"><i class="fas fa-times iclose"></i></a>
            </div>
            <div class="locadescription">
                <video id="video" width="100%" height="100%" autoplay></video>
                <div class="conttake">    <button class="takephoto" id="snap"><i class="fas fa-circle-notch itake"></i></button></div>
                <canvas id="canvas" width="800" height="600px"></canvas>
            </div>
        </div>
    </div>
    <script src="../app/webcam.js"></script>
</body>

</html>