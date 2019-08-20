<?php
	include 'db.php';
	session_start();

	$a = $_SESSION['change'];
	$count = mysqli_query($con,"SELECT * FROM `auth` WHERE auth = '$a'");
	$count = mysqli_fetch_assoc($count);
	$count = $count['butcount'] + $count['varcount'];
	$bnames = array();	 
	for($i=0;$i<$count;$i++){
		$c = $_POST[$i];
		array_push($bnames,$c);
	}
	$sbnames = serialize($bnames);
	echo $sbnames;
	echo $a;
	$updateque = mysqli_query($con,"UPDATE `auth` SET `bnames`='$sbnames' WHERE auth='$a'");
	if($updateque){
?>
	<script>alert("Buttons Modified");</script>
    <script>window.location.href = "displaypage.php";</script>   

<?php
	}
?>