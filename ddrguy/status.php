<?php

if ($username){
	

	echo "<table>
	<tr>
		<td><a href='$site/profile?id=$userid'>$username</a></td>
		<td>-</td>
		<td><a href='$site/logout'>Logout</a></td>
	</tr>
	<tr>
		<td><a href='$site/edit_profile'>Edit Profile</a></td>
		<td><a href=''></a></td>
	</tr>
	</table>";
	
}
else
	echo "<div id='status_notification' style='color: white; font-size: 14px;'></div>
	<form id='frmstatus' action='$site/status_data' method='post'>
		<table>
		<tr>
			<td></td>
			<td><input id='stuser' type='text' placeholder='Username' name='username' tabindex='1' class='textbox' /></td>
			<td id='stuser_error' style='color: white'></td>
			<td><a href='$site/register' tabindex='4' >Register</a></td>
		</tr>
		<tr>
			<td></td>
			<td><input id='stpass' type='password' placeholder='Password' name='password' tabindex='2' class='textbox' /></td>
			<td id='stpass_error' style='color: white'></td>
			<td><button id='btnstatus' class='button'>Login</button></td>
		</tr>
		</table>
		<div style='font-size: 14px; margin-right: 70px;'><a href='$site/forgotpass'>Forgot Password?</a></div>
		</form>
		<script type='text/javascript' src='jQuery/status.js'></script>";

?>