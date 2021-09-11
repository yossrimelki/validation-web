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
                <a href="disgroup.php" class="linkKey">GROUP</a>
                <a href="profilpost.php" class="linkKey">PROFIL</a>
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
            <form action="uploadstory.php" method="POST" enctype="multipart/form-data">

                <div class="loca">
                    <a class="del" href="../home.php"><i class="fas fa-times iclose"></i></a>
                    <h2>Story</h2>
                    <button class="sendbtn" type="submit" name="submit"><i class="fas fa-share iclose"></i></button>
                </div>
                <div class="contuploadstory">
                    <input type="file" name="file" id="file" class="inputfile" data-multiple-caption="{count} files selected" multiple />
                    <label for="file" class="labelforstory"> <i class="fas fa-cloud-upload-alt iupload"></i>Upload Story</label>
                </div>
                <div class="fil">
                    <a href="../creerpost.php" class="labelforfile"><i class="fas fa-image iimage"></i>Post</a>
                    <a href="cameraupload.php" class="labelforfile"><i class="fas fa-camera iimage"></i> Camera</a>

                </div>
            </form>
        </div>
    </div>

</body>

</html>