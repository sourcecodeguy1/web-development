	<?php 
	error_reporting(0);
	session_start();
	
	//$user_name = $_SESSION['username'];
	$title = "ddrguy - Logout";?>
	<?php require("./top.php");?>
		<div id="full">
		<?php
		
		$username = $_SESSION['username'];
		
		if ($username){
			session_destroy();
			/*echo "<body onload=\"setTimeout('logout();', 1);\">";*/
			echo "<b>$username</b> has been logged out.";
			echo "<html>
			<head>
			<meta http-equiv='refresh' content='3; url=$site/index'>
			</head>
			</html>";
			
		}
		else
			echo "You are not logged in. Login <a href='$site/login'>Here</a>.";
		
		?>
		</div>
		
		
	<div class='clear'>
	
	<?php require("bottom.php");?>
	</div>