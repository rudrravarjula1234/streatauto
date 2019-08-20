<?php
include 'db.php';
    $name= $_POST['name'] ;
    $email=$_POST['email'];
    $pass=$_POST['pass'];
    $cnfpass=$_POST['cnfpass'];
    //logic for userid
    do{
        $id=rand(10000,99999);
        $endid="usr".$id;
        $gencode="SELECT `uid` FROM `users` WHERE uid='$endid'";
        $result = mysqli_query($con, $gencode);
        $count = mysqli_num_rows($result);
        }while($count==1);    

        if($pass==$cnfpass){
        $req = "INSERT INTO `users` (`name`,`uname`,`pass`,`uid`) VALUES ('$name', '$email', '$pass', '$endid')";
        $reqque = mysqli_query($con, $req) or die("error1");
        if($reqque){
            echo "<script>window.alert('Registered sucessfully');</script>";
            header("Location:index.php");
        }
        
        }
        
        else{
            echo "<script>window.alert('error');</script>";
            header("Location:index.php");
        }
?>