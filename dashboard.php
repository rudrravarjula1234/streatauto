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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
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

                    <li class="nav-item dropdown active">
                        <a class="nav-link dropdown-toggle" href="#"  id="navbarDevices" data-toggle="dropdown" aria-expanded="false" >
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
                            <i class="nc-icon nc-settings-gear-64"></i>
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
                <a class="navbar-brand" href="#pablo" id="devname"><?php echo $_SESSION['user']['pauth']." - ". $_SESSION['user']['pname']; ?> </a>    
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
                                    <span class="no-icon" id="usr_status"></span>
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
                    <div id="load_content" style="width:100%;"></div>
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
<!--   Core JS Files   -->
<script src="assets/js/core/jquery.3.2.1.min.js" type="text/javascript"></script>
<script src="assets/js/core/popper.min.js" type="text/javascript"></script>
<script src="assets/js/core/bootstrap.min.js" type="text/javascript"></script>
<!--  Notifications Plugin    -->
<script src="assets/js/plugins/bootstrap-notify.js"></script>
<!-- Control Center for Light Bootstrap Dashboard: scripts for the example pages etc -->
<script src="assets/js/light-bootstrap-dashboard.js?v=2.0.1" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {
        load_latest();
    });
    var code,code2,status,status1;
	var x = setInterval(check_change,1000);
function check_change() {
		$.ajax({
			url: "update_buttons.php",
			success: function(calling) {
        			code = calling;
    			}
    		});
		if(code == code2) {
			
		}
		else {
			$("#load_content").html(code);
			code2 = code;
		}
	}
    var y = setInterval(check_online,6000);
function check_online() {
		$.ajax({
			url: "update_status.php",
			success: function(state) {
        			status = state;
    			}
    		});
		if(status == status1) {
			
		}
		else {
			$("#usr_status").html(status);
			status1 = status;
		}
	}
	function load_latest() {
		$.ajax({
			url: "update_buttons.php",
			success: function(result) {
        			$("#load_content").html(result);
				code2 = result;
    			}
    		});	}

	
function syncFun() {
  console.log("entered");    
  $.ajax({
        type: "POST",
        url: "sync.php",
        data: $("#syncdata").serialize(), // serializes the form's elements.
    
        success: function(data) {
            console.log(data);
        }
         });

}
    function getData() {
        // var formData = {
        //         'auth':document.getElementById("device").value; 
        //     };
        var a = document.getElementById("device").value;
        $.ajax({
        type: "POST",
        url: "change.php",
        data:{auth:a}, // serializes the form's elements.
    
        success: function(data) {
            console.log(data);
            
        }
         });
        // console.log(a);
    }
    

</script>

</html>