<?php 

    include 'db.php';
    error_reporting(0);

    $auth = $_GET['auth'];
    $stat = $_GET['stat'];
    $ret = $_GET['wat'];

    $query = mysqli_query($con,"UPDATE `devices` SET `butstatus`='$stat',`watsret`='$ret' WHERE auth = '$auth'");
?>