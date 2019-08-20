<?php
session_start();
include 'db.php';
    $auth = $_POST['auth'];
    
    $_SESSION['user']['pauth'] = $auth ;
    
    $usid = $_SESSION['user']['uid'];
    
    $authno_query = mysqli_query($con, "SELECT `devices`, `devicename` FROM `projects` WHERE uid='$usid'") or die(mysql_error());
    $row2 = mysqli_fetch_assoc($authno_query);
    $pauth = $row2['devices'];
    $pname = $row2['devicename'];
    $uspauth = unserialize($pauth);
    $uspname = unserialize($pname);
    $k=0;

    foreach($uspauth as $key => $item){
        if($item == $auth){
    
            $k=$key;
        }
    }
    $pname = $uspname[$k];
    $_SESSION['user']['pname'] = $pname;
    echo $_SESSION['user']['pauth']." - ". $_SESSION['user']['pname']; 
?>