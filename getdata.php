<?php
    include 'db.php';
    session_start();                        
   
    $auth = $_GET['auth'];
$date1 = (new \DateTime())->format('Y-m-d H:i:s');
echo $date1;
$updateque = mysqli_query($con,"UPDATE `devices` SET `lastactive`='$date1' WHERE auth='$auth'") or die(mysql_error());

$getque = mysqli_query($con,"SELECT * FROM `devices` WHERE auth='$auth'");
$acount = mysqli_num_rows($getque);
$arows = mysqli_fetch_assoc($getque);
$bdata =$arows['butstatus'];
$vdata =$arows['watret'];
$data = intval($bdata);
echo $data;
// $date2 = (new \DateTime())->format('Y-m-d H:i:s');
// echo $date2;
//     $diffInSeconds = $date2 - $date1;

//     echo $diffInSeconds;
    ?>  