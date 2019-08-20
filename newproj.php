<?php
    include 'db.php';
    session_start();
    $uid= $_SESSION['user']['uid'];
//Getting Input value
    
  $pname=$_POST['pname'];
  $passw=$_POST['pwd'];
  $cpass=$_POST['cnfpwd'];
  $nodev = $_POST['nodev'];
  $wats = $_POST['wats'];
  $infobox = $_POST['infobox'];
  
  do{
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 10; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    } 
    $h=implode($pass);
    $rand="SELECT `auth` FROM `auth` WHERE auth='$h'";
    $result = mysqli_query($con, $rand);
    $count = mysqli_num_rows($result);
}while($count==1);

$user="SELECT * FROM `projects` WHERE uid='$uid'";
    $ures = mysqli_query($con, $user);
    $ucount = mysqli_num_rows($ures);
    $row=mysqli_fetch_assoc($ures);
    if($ucount==1){
        $devices = $row['devices'];
        $dvname = $row['devicename'];
        $dcount = $row['devicecount'];
        $dcount = $dcount+1;
        $usdevices = unserialize($devices);
        $usdvname = unserialize($dvname);
        array_push($usdevices,$h);
        array_push($usdvname,$pname);
        $sdevices=serialize($usdevices);
        $sdvname=serialize($usdvname);
        $update=mysqli_query($con,"UPDATE `projects` SET `devices` = '$sdevices', `devicename` = '$sdvname',`devicecount` = '$dcount' WHERE  uid= '$uid'") or die(mysql_error());
        
    }
    else{
        $projects = array();
        array_push($projects,$h);
        $stproj=serialize($projects);
        $pnames = array();
        array_push($pnames,$pname);
        $stpname=serialize($pnames);
        $endid=1;
        $req = "INSERT INTO `projects` (`uid`,`devices`,`devicename`,`devicecount`) VALUES ('$uid', '$stproj', '$stpname', '$endid')";
        $reqque = mysqli_query($con, $req) or die("error1");
    }
    $stat = '0';
    $watageret = '0';
    $req2 = "INSERT INTO `auth` (`auth`, `athpin`,`dvname`, `nodevices`, `watage`, `info`) VALUES ('$h', '$passw', '$pname','$nodev','$wats','$infobox')";
    $qreq2 = mysqli_query($con, $req2) or die("error2");
    $req3 ="INSERT INTO `devices` (`auth`,`butstatus`,`watsret`) VALUES ('$h', '$stat', '$watageret')";
    $qreq3 = mysqli_query($con, $req3) or die("error3");
    
    if ($qreq3){
        header("Location:dashboard.php");
    }
?>