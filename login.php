 <?php
include 'db.php';
session_start();

//Getting Input value

  $username=mysqli_real_escape_string($con,$_POST['email']);
  $password=mysqli_real_escape_string($con,$_POST['pass']);
  if(empty($username)&&empty($password)){           

  }else{
 //Checking Login Detail
 $result=mysqli_query($con,"SELECT * FROM `users` WHERE uname='$username' AND pass='$password'") or die(mysql_error());
 $row=mysqli_fetch_assoc($result);
 $count=mysqli_num_rows($result);
 $usid = $row['uid'];
 echo $usid;
 $authno_query = mysqli_query($con, "SELECT `devices`, `devicename` FROM `projects` WHERE uid='$usid'") or die(mysql_error());
  $row2 = mysqli_fetch_assoc($authno_query);
  $pauth = $row2['devices'];
  $pname = $row2['devicename'];
  $uspauth = unserialize($pauth);
  $uspname = unserialize($pname);
 if($count==1){
      $_SESSION['user']=array(
   'username'=>$row['uname'],
   'userna' => $row['name'],
   'password'=>$row['pass'],
   'uid' =>$row['uid'],
   'pauth' => $uspauth[0],
   'pname' => $uspname[0],
    'status' => 0
   );
   ?>
   <script>alert("Login Sussfull");</script>
    <script>window.location.href = "dashboard.php";</script>   
   <?php
 
 }else{
    ?>
    <script>alert("Invalid login");</script>
     <script>window.location.href = "index.php";</script>   
    <?php
   }
}
?>
