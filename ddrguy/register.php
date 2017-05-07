	<?php
	//error_reporting(0);
	?>
	<?php $title = "ddrguy - Register";?>
	<?php require("./top.php");?>
		<div id="full">
		<div id='frmform'>Registration Form</div><br />
		<center><div id='ack' style='color: red' hidden></div></center>
		<?php
		
		$form = "<form id='regform' name='regform' action='$site/register_data' method='post' enctype='multipart/form-data'>
		<table cellspacing='10px'>
			
		<tr>
			<td>First Name:</td>
			<td><input id='fname' type='text' name='firstname' class='textbox' size='35' /></td>
			<td id='error_fname' style='color: red'></td>
		</tr>
		<tr>
			<td>Last Name:</td>
			<td><input id='lname' type='text' name='lastname' class='textbox' size='35' /></td>
			<td id='error_lname' style='color: red'></td>
		</tr>
		<tr>
			<td>Username:</td>
			<td><input id='username' type='text' name='username' class='textbox' size='35' /></td>
			<td id='error_username' style='color: red'></td>
		</tr>
		<tr>
			<td>email:</td>
			<td><input id='email' type='text' name='email' class='textbox' size='35' /></td>
			<td id='error_email' style='color: red'></td>
		</tr>
		<tr>
			<td>Password:</td>
			<td><input id='pass1' type='password' name='password' class='textbox' size='35' /></td>
			<td id='error_password' style='color: red'></td>
		</tr>
		<tr>
			<td>Confirm Password:</td>
			<td><input id='pass2' type='password' name='repassword' class='textbox' size='35' /></td>
			<td id='error_confirmpass' style='color: red'></td>
		</tr>
		<tr>
			<td>Website Address:</td>
			<td><input type='text' name='website' class='textbox' size='35' /></td>
		</tr>
		<tr>
			<td>Youtube Username:</td>
			<td><input type='text' name='youtube' class='textbox' size='35' /></td>
		</tr>
		<tr>
			<td>Bio/About:</td>
			<td><textarea name='bio' cols='35' rows='5' class='textbox'></textarea></td>
		</tr>
		
		<tr>
			<td></td>
			<td><button id='btnregister' class='button'>Register</button></td>
		</tr>
		</table>
		</form>
		<div id='result'></div>
		
        <script type='text/javascript' src='jQuery/register.js'></script>";
		
			echo $form;
		?>
		</div>
		<?php require("./bottom.php");?>