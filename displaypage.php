<!DOCTYPE html>
<html lang="en">
<?php
session_start();                             
if(!isset($_SESSION['user']) )
 {
 header('Location:index.php');
 }
?>
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
                            <?php
                            include 'db.php';                       
                            $uid= $_SESSION['user']['uid'];
                            $auct="SELECT * FROM `projects` WHERE uid='$uid'";
                            $result = mysqli_query($con, $auct);
                            $count = mysqli_num_rows($result);
                            $row = mysqli_fetch_assoc($result);
                            $auctno = $row['devices'];
                            $auctname = $row['devicename'];
                            $auctcount = $row['devicecount'];
                            $usdevices = unserialize($auctno);
                            $usdvname = unserialize($auctname);
                            ?>
                          
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
                    <li>
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
                        <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th>Sno</th>
                                <th>Device Name</th>
                                <th>Authentication Number</th>
                                <th>No of Buttons</th>
                                <th>No of Variables</th>
                                <th>Modify names</th>
                              </tr>
                            </thead>
                            <tbody>
                        <?php
                            $k =1;
                            for($i=0;$i<$auctcount;$i++){
                            $devices = mysqli_query($con,"SELECT * FROM `auth` WHERE `auth`='$usdevices[$i]'");
                            $row = mysqli_fetch_assoc($devices);
                        ?>
                            <tr>
                                <td><?php echo $k++; ?></td>
                                <td><?php echo $row['dvname']; ?></td>
                                <td><?php echo $row['auth']; ?></td>
                                <td><?php echo $row['butcount'] ?></td>
                                <td><?php echo $row['varcount'] ?></td>
                                <td><button class="open-homeEvents btn btn-primary" data-id="<?php echo $row['auth'] ?>" data-toggle="modal" data-target="#chnames">Modify</button></td>
                                
                            </tr>

                        <?php
                            }
                        ?>
                        </tbody>
                    </table>
                    </div>
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
 
 <div id="chnames" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="height:50px;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form method="post" action="checkpin.php">
                    <input type="hidden" name="authno" id="authno" value=""/>    
                <div class="form-group">
                <label for="pin">Enter Pin</label>     
                <input id="pin" type="text" class="form-control" name="pin" name="enterpin" placeholder="Enter Pin">
                </div>
                
            </div>
            <div class="modal-footer">
              <input type="submit" class="btn btn-primary" name="submit">
                </from>
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

</body>
<!--   Core JS Files   -->
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