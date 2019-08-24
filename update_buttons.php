<?php
include 'db.php';
error_reporting(0);
session_start();
$uid= $_SESSION['user']['uid'];

$ndevices = mysqli_query($con,"SELECT * FROM `projects` WHERE uid='$uid'");
$ncount = mysqli_num_rows($ndevices);
$nrows = mysqli_fetch_assoc($ndevices);
$devices =$nrows['devices'];
$devicenames = $nrows['devicename'];
$usdevices = unserialize($devices);
$usdevicenames = unserialize($devicenames);


// $aserch = mysqli_query($con,"SELECT * from `auth` where auth='$a'") or die("Error");
// $acount = mysqli_num_rows($aserch);
// $arows = mysqli_fetch_assoc($aserch);
// $dvname =$arows['dvname'];
// $nodevi = $arows['nodevices'];
// $watas = $arows['watage'];
// $infoo = $arows['info'];

// $dserch = mysqli_query($con,"SELECT * from `devices` where auth='$a'");
// $dcount = mysqli_num_rows($dserch);
// $drows = mysqli_fetch_assoc($dserch);
// $butval =$drows['buttons'];
// $varval= $drows['variables'];
// $btype = intval($drows['type']);
// $usbutval = unserialize($butval);
// $usvarval = unserialize($varval);
?>
<!DOCTYPE html>
<html>
<head>
    <style>
        .projectdet{
            display:flex;
            flex-direction:column;
            border:1px solid black;
            width:100%;
            height:230px;
            border-radius:10px;
            padding-bottom:15px;
            margin:15px;
            justify-content:space-between;
            box-shadow: 5px 5px 15px 2px #7F7F7F ;
        }
        .projectdet:hover{    
            box-shadow: 5px 5px 15px 10px #7F7F7F;
        }
        .maindiv{
            display:flex;
            flex-direction:row;
        }
        h2{
            margin-top:8px;
        }
    </style>
</head>
<body>
    <div class="container">
    <div class="row">
    
    <?php
        foreach ($usdevices as $key => $value) {
            $aserch = mysqli_query($con,"SELECT * from `auth` where auth='$value'") or die("Error");
            $acount = mysqli_num_rows($aserch);
            $arows = mysqli_fetch_assoc($aserch);
            $dvname =$arows['dvname'];
            $nodevi = $arows['nodevices'];
            $watas = $arows['watage'];
            $infoo = $arows['info'];
            
            $totwat = $nodevi * $watas;
            
            $dserch = mysqli_query($con,"SELECT * from `devices` where auth='$value'");
            $dcount = mysqli_num_rows($dserch);
            $drows = mysqli_fetch_assoc($dserch);
            $butval =$drows['butstatus'];
            $varval= $drows['watsret'];
            
            $nobulbsactive = $nodevi - (($totwat - $varval)/$watas);
    ?>
        <div class="projectdet col-sm-4 col-md-3 col-lg-3 col-xs-6" data-toggle="tooltip" data-placement="top" title="<?php echo $infoo; ?>">
            <div>
                <h2><?php echo $dvname; ?></h2>
            </div>
            <div>
            <form method="POST" id="syncdata">
            <div>
                <?php
                    $c = $butval?"checked":"not";
                ?>
                <label class="switch">
                    <input type="hidden" name="authnumber" value="<?php echo $value;?>">
                    <input type="checkbox" <?php echo $c ?> onchange="syncFun()" name="<?php echo $value;?>" value="0">
                    <span class="slider round"><span class="on">ON</span><span class="off">OFF</span></span>
                </label>
            </div>
            </form>
            </div>
            <div>
                <span>No.of active Devices</span>
                <span><?php  echo $nobulbsactive; ?></span>
            </div>
            <div>
                <span>Watage</span>
                <span><?php echo $varval;?></span>
            </div>
        </div>
    <?php
        }
    ?>
    </div>
    </div>

    <script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip({delay:1000,animation: true}); 
});
</script>
</body>
</html>
