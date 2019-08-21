 <?php
include 'db.php';


error_reporting(0);
session_start();
$name = $_POST['authnumber'];
$stat = $_POST[''.$name.''];
    if($stat == "0"){
        $stat = intval(1);
    }
    else{
        $stat = intval(0);
    }
// $aserch = mysqli_query($con,"SELECT * from `auth` where auth='$a'") or die("Error");
// $acount = mysqli_num_rows($aserch);
// $arows = mysqli_fetch_assoc($aserch);
// $bnames = $arows['bnames'];
// $usbnames = unserialize($bnames);
// echo "p is".$p."<br>";
// $bdata = array();
// $vdata = array();        
// for($i=0;$i<$p;$i++){
//     echo $usbnames[$i];
//     $pda = $_POST[''.$usbnames[$i].''];
//     if($pda == "0"){
//         $pda = intval(1);
//     }
//     else{
//         $pda = intval(0);
//     }
//     array_push($bdata,$pda);
// }
// for($i=$p;$i<$p+$q;$i++){
//     $pda = $_POST[''.$usbnames[$i].''];
//     array_push($vdata,intval($pda));
// }
// $sbdata=serialize($bdata);
// $svdata=serialize($vdata);
// echo $sbdata;
// echo $svdata;                
$updateque = mysqli_query($con,"UPDATE `devices` SET `butstatus`='$stat' WHERE auth='$name'");

if($updateque){
    echo "done";
}
?>