 <?php
    $title = "ddrguy - Activate You Account";
    require("./top.php");
		  
	?>
		<div id="full">
        <center><div id='ack' style='color: red;' hidden></div></center>
		<?php
		
		$getcode = $_GET['code'];
    	
		$form = "<form id='frmactivate' action='$site/activate_data' method='post'>
		<table>
		<tr>
			<td>Activate Code:</td>
			<td><input id='txtcode' type='text' name='code' value='$getcode' size='30' /></td>
            <td id='error_code' /></td>
		</tr>
		
		<tr>
			<td>Username:</td>
			<td><input id='txtuser' type='text' name='username' value='' /></td>
            <td id='error_user' /></td>
		</tr>
		<tr>
			<td>Password:</td>
			<td><input id='txtpass' type='password' name='password' value='' /></td>
            <td id='error_pass' /></td>
		</tr>
		<tr>
			<td></td>
			<td><button id='submitbtn' class='button'>Activate</button></td>
		</tr>
		</table>
		</form>";
		echo $form;
		?>
         <script type="text/javascript" src="jquery-1.3.2.js"></script>
         <script type="text/javascript" src="jQuery/activate.js"></script>
       
		</div>
	<?php require("./bottom.php");?>