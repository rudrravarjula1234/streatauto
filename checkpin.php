<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <!-- CSS Files -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/css/light-bootstrap-dashboard.css?v=2.0.1" rel="stylesheet" />
    <link rel="stylesheet" href="main.css">
</head>

<?php
session_start();                             
if(!isset($_SESSION['user']) )
 {
 header('Location:index.php');
 }

	include 'db.php';
	$a = $_POST['authno'];
	$b = $_POST['pin'];
	$check = mysqli_query($con,"SELECT count(auth) FROM `auth` WHERE auth='$a' && athpin='$b'");
	$check = mysqli_fetch_array($check);
	$check = $check[0];
	if($check == 1){
		$_SESSION['change'] = $a;
?>
<body>
    <div class="wrapper">
        <div class="sidebar" >
            <div class="sidebar-wrapper">
                <div class="logo">
                    <a href="/" class="simple-text">
                        Arum group
                    </a>
                </div>

                <ul class="nav">

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="dashboard.php"  id="navbarDevices"  >
                            <i class="nc-icon nc-chart-pie-35"></i>
                            <p>My devices</p>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDevices">
                        </ul>
                    </li>
                    <li>
                        <a class="nav-link" href="createpage.php">
                            <i class="nc-icon nc-circle-09"></i>
                            <p>Create Device</p>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="addpage.php">
                            <i class="nc-icon nc-notes"></i>
                            <p>Add Device</p>
                        </a>
                    </li>
                    <li class="active">
                        <a class="nav-link" href="displaypage.php">
                            <i class="nc-icon nc-paper-2"></i>
                            <p>Device info</p>
                        </a>
                    </li>
                </ul>
            </div>	
        </div>
        <div class="main-panel">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg " color-on-scroll="500">
                <div class=" container-fluid  ">
                <a class="navbar-brand" href="#pablo"><?php echo $_SESSION['user']['pauth']." - ". $_SESSION['user']['pname']; ?> </a>    
                <button href="" class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-bar burger-lines"></span>
                        <span class="navbar-toggler-bar burger-lines"></span>
                        <span class="navbar-toggler-bar burger-lines"></span>
                    </button>
                    
                    <div class="collapse navbar-collapse justify-content-end" id="navigation">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="/">
                                    <span class="no-icon"><?php echo $_SESSION['user']['userna'] ?></span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/">
                                    <span class="no-icon"><?php echo $_SESSION['user']['status']?"Device Online":"Device is Ofline"; ?></span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#pablo">
                                    <span class="no-icon">Log out</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- End Navbar -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                    <div id="load_content">
						<?php
							$query = mysqli_query($con,"SELECT `bnames` FROM `auth` WHERE auth='$a'");
							$query = mysqli_fetch_array($query);
							$query = $query[0];
							$quese = unserialize($query);
						?>          
						<h3>Modify Names</h3>
						<h6 style="font-weight: 130; text-transform: capitalize;">Hear you can change names for bottons or variables </h6>          	
 						<form method="post" action="modify.php" >
 								<?php
 									foreach ($quese as $key => $value) {
								?>
									<div class="form-group">
										<label for="<?php echo $key;?>"></label>
										<input type="text" name="<?php echo $key;?>" id="<?php echo $key;?>" value="<?php echo $value;?>" class="form-control">
									</div>
								<?php 										
 									}
 								?>
 								<input type="submit" name="submit" class="btn btn-primary" >
 						</form>                       
                    </div>
                    </div>
                </div>
            </div>
            <footer class="footer">
                <div class="container">
                    <nav>
                        <p class="copyright text-center">
                            ©
                            <script>
                                document.write(new Date().getFullYear())
                            </script>
                            <a href="/">Aurm Group</a>, copy rights
                        </p>
                    </nav>
                </div>
            </footer>
        </div>
    </div>
 
</body>
<script src="assets/js/core/jquery.3.2.1.min.js" type="text/javascript"></script>
<script src="assets/js/core/popper.min.js" type="text/javascript"></script>
<script src="assets/js/core/bootstrap.min.js" type="text/javascript"></script>
<!--  Notifications Plugin    -->
<script src="assets/js/plugins/bootstrap-notify.js"></script>
<!-- Control Center for Light Bootstrap Dashboard: scripts for the example pages etc -->
<script src="assets/js/light-bootstrap-dashboard.js?v=2.0.1" type="text/javascript"></script>
<script type="text/javascript">
    $(document).on("click", ".open-homeEvents", function () {
     var authId = $(this).data('id');
     $('#authHolder').html(authId);
     document.getElementById("authno").value = authId;
});
</script>
</html>
<?php
	}
	else{
?>
    <script>alert("Wrong Pin");</script>
     <script>window.location.href = "displaypage.php";</script>   
<?php
	}
?>

<!--   Core JS Files   -->
