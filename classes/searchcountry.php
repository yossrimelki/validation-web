<?php
include('db.php');


if (isset($_POST['query'])) {
    $inptext = $_POST['query'];
    $query = "SELECT * FROM country WHERE namecountry LIKE '%$inptext%' ORDER BY nbfoissearch DESC   ";
    $result = mysqli_query($con, $query);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "   
             <div class='list-group' >
            <p  class='list-group-item '>" . $row['namecountry'] . "</p>
             </div>";
            $nbfoissearch = $row['nbfoissearch'];
            $nbfoissearch++;
            $id=$row['id'];
            mysqli_query($con,"UPDATE country SET nbfoissearch='$nbfoissearch' WHERE id='$id'");
        }
    } else {
        echo "<div class='list-group' >
        <a href='#' class='list-group-item '><i class='fas fa-plus-circle iimage'></i> " . $inptext . "</a>
         </div";
    }
}

if (isset($_POST['addcountry'])) {
    $newcountry = $_POST['addcountry'];
    if ($newcountry != "") {
        $nbfoissearch = 1;
        $queryaddcountry = "INSERT INTO country (namecountry,nbfoissearch) VALUES('$newcountry','$nbfoissearch')";
        $resultaddcountry = mysqli_query($con, $queryaddcountry);
    } else {
        header("location: ../creerpost.php?can't_insert_this_location");
    }
  
}
