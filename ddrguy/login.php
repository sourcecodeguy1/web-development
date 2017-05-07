	<?php 
	//error_reporting(0);
	//session_start();
	$title = "ddrguy - Login";?>
	<?php require("top.php");?>
	
		<div id="full">
		<center><div id='ack' style='color: red;' hidden></div></center>
			<?php
                        if($username && $userid){
			echo "<center>You are already logged in as <span style='color: blue'><b>$username</b></span></center>";
	}else{
	
		$form = "<form id='logform' action='$site/login_data' method='post'>
		<center><table>
		<tr>
			<td>Username:</td>
			<td><input id='Lusername' type='text' name='username' tabindex='1' class='textbox' size='35'  /></td>
			<td id='error_user' style='color: red'></td>
			<td><a href='$site/register' tabindex='4'>Register</a></td>
		</tr>
		<tr>
			<td>Password:</td>
			<td><input id='Lpassword' type='password' name='password' tabindex='2' class='textbox' size='35' /></td>
			<td id='error_pass' style='color: red'></td>
			<td><button id='btnlogin' class='button'>Login</button></td>
		</tr>
		</table><a href='$site/forgotpass'>Forgot your password?</a></center>
		</form>";
		echo $form;
		}
		?>
		 <script type="text/javascript" src="jquery-1.3.2.js"></script>
         <script type="text/javascript" src="jQuery/login.js"></script>
		
		
		</div>
		<div class='clear'>
		
	<?php require("./bottom.php");?>