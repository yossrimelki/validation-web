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



<style>
    <?php
    include('style/stylenotification.css');
    include('style/styleindex.css');
    ?>
</style>

<?php
include('classes/db.php');
?>



<link rel="stylesheet" href="style/styleindex.css">
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MERCURY</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style/styleslikes.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>



    <!--charts js -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Post nb', 'Likes', 'Comments'],
                <?php 
                $userid = $user_data['user_id'];
                $sqlfind = "SELECT * FROM publication WHERE userposted=$userid ORDER BY date ASC LIMIT 20 ";
                $resultfind = mysqli_query($con, $sqlfind);
                $nbpost=0;
                while($rowfind=mysqli_fetch_array($resultfind)){
                 $nbpost++;
                ?>
                
                ['post <?php echo $nbpost ?>' , <?php echo $rowfind['likes']   ?>, <?php echo $rowfind['comment'] ?>],
                <?php }?>
            ]);

            var options = {
                title: 'Posts Activity',
                curveType: 'function',
                legend: {
                    position: 'bottom'
                }
            };

            var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

            chart.draw(data, options);
        }
    </script>
</head>

<body>

    <nav>
        <div class="topMenu">
            <div class="menuLink">
                <a class="linkLogo" href="home.php" style="color: #ef9d87;"><img class="linkImg" src="img/logo.png" alt=""></a>
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
                <a href="creerpost.php" class="optionLink" title="creer"><i class="fas fa-plus-square hov"></i></a>
                <a href="notification.php" class="optionLink" title="notification"><i class="fa fa-heart hov " style="color: #ef9d87;"></i></a>
                <a href="" class="optionLink" title="discover"><i class="fas fa-compass hov"></i></a>
            </div>
        </div>
    </nav>


    <div class="cont">
        <div class="left">
            <div id="curve_chart" style=" height: 500px"></div>
        </div>

        <aside class="right">

            <div class="title">
                <h2 class="soustitle">Activity</h2>
            </div>
            <?php
            $sqlLike = "SELECT * FROM notification ORDER BY date DESC;";
            $resultLike = mysqli_query($con, $sqlLike);
            $resultCheckLike = mysqli_num_rows($resultLike);
            if ($resultCheckLike > 0) {
                while ($rowLike = mysqli_fetch_assoc($resultLike)) {
                    $idLike = $rowLike['id'];
                    $idUser = $rowLike['userid'];
                    $idPost = $rowLike['postid'];
                    $userposted = $user_data['user_id'];
                    $sqlPosts = "SELECT * FROM publication WHERE id=$idPost AND userposted=$userposted";
                    $resultPosts = mysqli_query($con, $sqlPosts);
                    $resultCheckPosts = mysqli_num_rows($resultPosts);
                    if ($resultCheckPosts > 0) {
                        while ($rowPosts = mysqli_fetch_assoc($resultPosts)) {
                            $sqlUsers = "SELECT * FROM users WHERE user_id=$idUser;";
                            $resultUsers = mysqli_query($con, $sqlUsers);
                            $resultCheckUsers = mysqli_num_rows($resultUsers);
                            if ($resultCheckUsers > 0) {
                                while ($rowUsers = mysqli_fetch_array($resultUsers)) {
                                    echo " <div class='contnotif'>";
                                    echo "<img class='imnotifuser' src='img/" . $rowUsers['profile_img'] . "'>";
                                    echo "   <h3 class='personnotif'>" . $rowUsers['fullname'] . "</h3>";
                                    if ($rowPosts['image'] != '.') {
                                        if ($rowLike['likes'] == 1 && $rowLike['comment'] == 0) {
                                            echo "<p class='descnotif'>liked your photo</p>";
                                        }
                                        if ($rowLike['comment'] == 1 && $rowLike['likes'] == 0) {
                                            echo "<p class='descnotif'>commented your photo</p>";
                                        }
                                        echo "<img class='imnotifpost' src='uploads/image/" . $rowPosts['image'] . "'>";
                                    }
                                    if ($rowPosts['video'] != '.') {
                                        if ($rowLike['likes'] == 1   && $rowLike['comment'] == 0) {
                                            echo "<p class='descnotif'>liked your video</p>";
                                        }
                                        if ($rowLike['comment'] == 1 && $rowLike['likes'] == 0) {
                                            echo "<p class='descnotif'>commented your video</p>";
                                        }
                                        echo "<video class='imnotifpost' controls> <source src='uploads/video/" . $rowPosts['video'] . "'type=video/mp4></video>";
                                    }
                                    echo " </div>";
                                }
                            }
                        }
                    }
                }
            }


            ?>


        </aside>
    </div>
</body>

</html>