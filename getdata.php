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
$bdata =$arows['buttons'];
$vdata =$arows['variables'];
$usbdata = unserialize($bdata);
$usvdata = unserialize($vdata);
$couque = mysqli_query($con,"SELECT `butcount`,`varcount` FROM `auth` WHERE auth='$auth'");
$couarows = mysqli_fetch_assoc($couque);
$bcount =$couarows['butcount'];
$vcount =$couarows['varcount'];
if($usbdata[0] == 0){
    $usbdata[0] = '5';
}
if($usbdata[0] == 1){
    $usbdata[0] = '95';
}
$data = $usbdata[0];
for($i=1;$i<$bcount;$i++){
    if($usbdata[$i] == 0)
        $usbdata[$i] = '5';
    if($usbdata[$i] == 1)
        $usbdata[$i] = '95';
    $data = $data.','.$usbdata[$i];
}
for($i=0;$i<$vcount;$i++){
    $usvdata[$i] = intval($usvdata[$i]*(95/100));
    $data = $data.','.$usvdata[$i];
}
echo $data;
// $date2 = (new \DateTime())->format('Y-m-d H:i:s');
// echo $date2;
//     $diffInSeconds = $date2 - $date1;

//     echo $diffInSeconds;
    ?>  