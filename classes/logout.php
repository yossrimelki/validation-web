<?php
session_start();
if (isset ($_SESSION['mercury_user_id'])){

    $_SESSION['mercury_user_id'] = NULL;
    unset ($_SESSION['mercury_user_id']);
}

header ("Location: ../index.php");
die;

?>