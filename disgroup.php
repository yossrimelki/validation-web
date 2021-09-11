<style>
    <?php
    include('style/styleindex.css');
    include('style/stylegroup.css');
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
                <a class="linkLogo" href="home.php" style="color: #ef9d87;"><img class="linkImg" src="img/logo.png" alt=""></a>
                <a href="disgroup.php" class="linkKey" style="color: #ef9d87;">GROUP</a>
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
                <a href="creerpost.php" class="optionLink" title="creer"><i class="fas fa-plus-square hov"></i></a>
                <a href="notification.php" class="optionLink" title="notification"><i class="fa fa-heart hov"></i><span style="color: #ef9d87;"></span></a>
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
            <li><i class="fas fa-users icongr"></i><a href="disgroup.php" class="dis">Discover </a></li>
            <li><i class="fas fa-compass icongr"></i> <a href="classes/groupe.php" class="dis">Home </a></li>
            <li><i class="fas fa-plus-circle icongr"></i> <a href="" class="dis">Creat  </a></li>
            <div class="contline">
                <span class="line"></span>
            </div>
            <div class="grcont">
                <h2>Your Group</h2>
            </div>
            <div class="contugr">
                <img class="imgugr" src="img/ashref.jpg" alt="">
                <h3>name group</h3>
            </div>
        </div>
        <aside class="right">
            <div class="contgroup">
                <img class="groupimg" src="img/download (2).jpg" alt="">
                <div class="namegr">
                    <h3>name group</h3>
                </div>
                <div class="namegr">
                    <p>8k Members *</P>
                    <P>* 100 Posts</p>
                </div>
                <div class="contjoin">
                    <button class="butfoll">join</button>
                </div>
            </div>
        </aside>
    </div>

</body>

</html>