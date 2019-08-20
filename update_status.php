<?php
include 'db.php';
session_start();
$auth = $_SESSION['user']['pauth'];
$date = mysqli_query($con, "SELECT `lastactive`>(DATE_SUB(NOW(), INTERVAL 7 SECOND)) as `active` FROM `devices` WHERE auth='$auth'") or die(mysql_error());
$row = mysqli_fetch_assoc($date);
$status = $row['active'];
if($status == 1){
    echo "Device Online";
}
else{
    echo "Device Ofline";
}
// $date = mysqli_query($con, "SELECT `lastactive` FROM `devices` WHERE auth='$auth'") or die(mysql_error());
// $row2 = mysqli_fetch_assoc($date);
// $date1 = $row2['lastactive'];
// echo $date1;
// echo "<br>";

// $date2 = (new \DateTime())->format('Y-m-d H:i:s');
// $date3 = date_create(now());
// echo $date3;
// echo $date2;
//     $diffInSeconds = date_diff($date2,$date1);
//     echo $diffInSeconds;

?>