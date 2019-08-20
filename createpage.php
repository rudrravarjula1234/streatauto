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
                    <form method="post" action="newproj.php">
                <div class="form-group">
                    <label for="pname">Project Name:</label>
                    <input type="text" class="form-control" id="pname" placeholder="Enter Project Name" name="pname" required>
                </div>
                <div class="form-group">
                    <label for="pwd">PIN:</label>
                    <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd" onchange='check_pass();' required>
                </div>
                <div class="form-group">
                    <label for="cnfpwd">Confirm PIN:</label>
                    <input type="password" class="form-control" id="cnfpwd" placeholder="Confirm password" name="cnfpwd" onchange='check_pass();'  required>
                    <span id='message'></span>
                </div>        
                <div class="form-group">
                    <label for="nodev">No Of Devices</label>
                    <input type="number" class="form-control" id="nodev" placeholder="No of Devices" name="nodev" required>
                    
                </div>
                <div class="form-group">
                    <label for="wats">Watage of each device in Wats</label>
                    <input type="number" class="form-control" id="wats" placeholder="Enter Watage" name="wats"  required>
                </div>
                <div>
                    <label for="infobox">Info About The project</label>
                    <textarea name="infobox" id="infobox" cols="30" rows="20" class="form-control" required></textarea>
                </div>
                <br>         
                <button type="submit" class="btn btn-default" id="submit" name="newproj" disabled>Submit</button>
                 </form>
                    </div>
                    </div>
                            
                        
                    </div>
                </div>
            </div>
            <footer class="footer">
                <div class="container">
                    <nav>
                        <ul class="footer-menu">
                            <li>
                                <a href="#">
                                    Home
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    Company
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    Portfolio
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    Blog
                                </a>
                            </li>
                        </ul>
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
<!--   Core JS Files   -->
<script src="assets/js/core/jquery.3.2.1.min.js" type="text/javascript"></script>
<script src="assets/js/core/popper.min.js" type="text/javascript"></script>
<script src="assets/js/core/bootstrap.min.js" type="text/javascript"></script>
<!--  Notifications Plugin    -->
<script src="assets/js/plugins/bootstrap-notify.js"></script>
<!-- Control Center for Light Bootstrap Dashboard: scripts for the example pages etc -->
<script src="assets/js/light-bootstrap-dashboard.js?v=2.0.1" type="text/javascript"></script>
<script>
    $("input[type='radio'][name='ports']").change(function(){

var selected = $("input[type='radio'][name='ports']:checked").val();

if(selected == 4) var opts = [
    {name:"Please Select", val:""},
    {name:"0", val:"0"},
    {name:"1", val:"1"},
    {name:"2", val:"2"}
];
if(selected == 8) var opts = [
    {name:"Please Select", val:""},
    {name:"0", val:"0"},
    {name:"1", val:"1"},
    {name:"2", val:"2"},
    {name:"3", val:"3"},
    {name:"4", val:"4"}
];
if(selected == 3) var opts = [
    {name:"- - - - - - - - - - - - - - ", val:"2"},
    
];
if(selected == 2) var opts = [
    {name:"- - - - - - - - - - - - - - ", val:"0"},
    
];

$("#vars").empty();

$.each(opts, function(k,v){

    $("#vars").append("<option value='"+v.val+"'>"+v.name+"</option>");

});
});
function check_pass() {
    if (document.getElementById('pwd').value ==
            document.getElementById('cnfpwd').value) {
        document.getElementById('submit').disabled = false;
        $('#message').html('Matching').css('color', 'green');
    } else {
        document.getElementById('submit').disabled = true;
        $('#message').html('Not Matching').css('color', 'red');
    }
}
</script>

</html>