<?php
error_reporting(E_ALL ^ E_NOTICE);
$title = "ddrguy - Forgot Password";
?>
<?php require("./top.php");?>
	<div id="full">
	<center><div id='ack' style='color: white'></div></center>
	<?php
		$form = "<center><form id='frmforgotpass' action='$site/forgotpass_data' method='post'>
		<table>
		<tr>
			<td></td>
			<td><font color='white'>$errormsg</font></td>
		</tr>
		<tr>
			<td>Username:</td>
			<td><input id='fusername' type='text' name='user' /></td>
			<td id='fusername_error' style='color: white'></td>
		</tr>
		<tr>
			<td>Email:</td>
			<td><input id='femail' type='text' name='email' /></td>
			<td id='femail_error' style='color: white'></td>
		</tr>
		<tr>
			<td></td>
			<td><button id='btnsubmitforgotpass' class='button'>Reset Password</button></td>
		</tr>
		</table>
		</form></center>";
		echo $form;
		//echo "<input id='btnsubmitforgotpass' type='submit' name='resetbtn' class='button' value='Reset Password' />";
	?>
	 <script type="text/javascript" src="jquery-1.3.2.js"></script>
     <script type="text/javascript" src="jQuery/forgotpass.js"></script>
	</div>
		<div class='clear'>
		
	<?php require("./bottom.php");?>