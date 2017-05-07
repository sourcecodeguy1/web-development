	<?php $title = "ddrguy - Contact";?>
	<?php require("top.php");?>
		
		<div id="full">
		<center><div id='ack' style='color: white;' hidden></div></center>
		<?php
			
			$email = $_GET['email'];
		
			require("connect.php");
			$query = mysqli_query($con, "SELECT * FROM users WHERE id='".$userid."'");
			$numrows= mysqli_num_rows($query);
			if ($numrows == 1){
				$row = mysqli_fetch_assoc($query);
				$firstname = $row['first_name'];
				$lastname = $row['last_name'];
				$email = $row['email'];
			
			}
			
		$form = "<form id='frmContact' action='$site/contact_data' method='post'>
		<table>
		<tr>
			<td><font color='white'>Name:</font></td>
			<td><input id='fname' type='text' name='fullname' value='".$firstname."' class='textbox' size='39'</td>
			<td id='error_cName' style='color: white;'></td>
		</tr>
		<tr>
			<td><font color='white'>Your Email:</font></td>
			<td><input id='email' type='text' name='email' class='textbox' value='$email' size='39'</td>
			<td id='error_cEmail' style='color: white;'></td>
		</tr>
		<tr>
			<td><font color='white'>Message:</font></td>
			<td><textarea id='message' type='text' name='message' class='textbox'></textarea></td>
			<td id='error_cMessage' style='color: white;'></td>
		</tr>
		<tr>
			<td></td>
			<td><button id='btncontact' class='button'>Send</button></td>
		</tr>
		</table>
		</form>
		<script type='text/javascript' src='jQuery/contact.js'></script>";
		
		echo $form;
		
		?>
		
		</div>
		<div class="clear">
	<?php require("./bottom.php");?>
	</div>