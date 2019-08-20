<?php
include 'db.php';
session_start();          
  $uid= $_SESSION['user']['uid'];
$prname = $_POST['pname'];
$prpin = $_POST['pwd'];

$aserch = mysqli_query($con,"SELECT * from `auth` where (auth = '$prname' OR dvname = '$prname') AND athpin = '$prpin'");
$arows = mysqli_num_rows($aserch);
$afetch = mysqli_fetch_assoc($aserch);
$name = $afetch['dvname'];
$atth = $afetch['auth'];
echo $atth;

if($arows == 1){
    $afetch = mysqli_fetch_assoc($aserch);
    $pserch = mysqli_query($con,"SELECT * from `projects` where uid='$uid'");
    $pcou = mysqli_num_rows($pserch);
    if($pcou == 0){
        $projects = array();
        array_push($projects,$atth);
        $stproj=serialize($projects);
        $pnames = array();
        array_push($pnames,$name);
        $stpname=serialize($pnames);
        $endid=1;
        $req = "INSERT INTO `projects` (`uid`,`devices`,`devicename`,`devicecount`) VALUES ('$uid', '$stproj', '$stpname', '$endid')";
        $reqque = mysqli_query($con, $req) or die("error1");
    }
    else{
    $pfetch=mysqli_fetch_assoc($pserch);
        $devices = $pfetch['devices'];
        $dvname = $pfetch['devicename'];
        $dcount = $pfetch['devicecount'];
        $usdevices = unserialize($devices);
        $usdvname = unserialize($dvname);
        $match = 0;
        for($i=0;$i<$dcount;$i++){
            if($usdevices[$i] == $atth){
                ++$match;
            }
        }
        if($match>0){
            echo "alredy exists";
        }
        else{
        array_push($usdevices,$atth);
        array_push($usdvname,$name);
        $dcount = $dcount+1;
        $sdevices=serialize($usdevices);
        $sdvname=serialize($usdvname);
        $update=mysqli_query($con,"UPDATE `projects` SET `devices` = '$sdevices', `devicename` = '$sdvname',`devicecount` = '$dcount' WHERE  uid= '$uid'") or die(mysql_error());
        }
    
    } 
    ?>
    <script>alert("added sucessfully");</script>
     <script>window.location.href = "dashboard.php";</script>   
    <?php           
}
else{
    echo "enter crt device details";
}
?>