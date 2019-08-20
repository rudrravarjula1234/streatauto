<?php
error_reporting(0);
include 'db.php';
session_start();
//Checking User Logged or Not
//Restrict User or Moderator to Access Admin.php page
if($_SESSION['user']['username'] && $_SESSION['user']['password']){
 header('location:dashboard.php');
}
if(empty($_SESSION['user'])){
       
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</head>
<body>
        <!-- Modal Header -->
        
            <ul class="nav nav-tabs modal-header">
            
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#login">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#signup">Signup</a>
                </li>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </ul>    
        <!-- Modal body -->
        
                <div class="tab-content">
                    <div id="login" class="container tab-pane active"><br>
                        <form id="logininto" method="post" action="login.php">
                            <div class="form-group">
                                <label for="email">Email address:</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="pwd">Password:</label>
                                <input type="password" class="form-control" id="pwd" name="pass" required>
                            </div>
                            
                            <button type="submit" class="btn btn-primary" name="login">Login</button>
                        </form>
                    </div>
                    <div id="signup" class="container tab-pane fade"><br>
                        <form action="register.php" method="post">
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email Address:</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="psw">Password:</label>
                                <input type="password" class="form-control" id="psw" name="pass" required>
                            </div>
                            <div class="form-group">
                                <label for="rpsw">Confirm Password:</label>
                                <input type="password" class="form-control" id="rpsw" name="cnfpass" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                    <div id="menu2" class="container tab-pane fade"><br></div>
                </div>
          
</body>

</html>
<?php
}
?>  