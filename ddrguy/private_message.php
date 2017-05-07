<?php 
$title = "DDR Guy - Private Message"; 
?>
<?php require("./top.php"); ?>
    <div id='full'>
	
	<?php
		if($username){
		$getid = $_GET['id'];
	
	if (!$getid)
		$getid = "1";
	
		require("connect.php");
		$query = mysqli_query($con, "SELECT * FROM users WHERE id='".$getid."'");
		$numrows = mysqli_num_rows($query);
		
		if ($numrows == 1){
			$row = mysqli_fetch_assoc($query);
			$id = $row['id'];
			$firstname = $row['first_name'];
			$lastname = $row['last_name'];
			$user = $row['username'];
			$email = $row['email'];
			$avatar = $row['avatar'];
			$bio = nl2br($row['bio']);
			$website = $row['website'];
			$youtube = $row['youtube'];
			$lastlogin = $row['last_login'];
			$active = $row['active'];
			$locked = $row['locked'];
			$date = $row['date'];
			
			$current_query = mysqli_query($con, "SELECT * FROM users WHERE id='".$userid."'");
				 $current_numrows = mysqli_num_rows($current_query);
				 if($current_numrows == 1){
					$current_row = mysqli_fetch_assoc($current_query);
					$current_user_image = $current_row['avatar'];
					
			if($userid != $getid){
			echo "<center><img src='avatars/$avatar' width='250px' height='250px'></img><br /><br />";
		$form = "<form action='$site/private_message?id=$getid' method='post'>
				 <table>
				 <tr>
					<td><textarea id='comment' name='message' placeholder='Post a private message...' style='width: 400px; height: 75px;'></textarea></td>
					<td id='comment_error' style='color: red'></td>
				 </tr>
				 <tr>
					<td><input id='btnsubmit' type='submit' name='btnsubmit' value='Send' class='button' /></td>
					<td></td>
				 </tr>
				 </table>
				 </form></center>";
				 
					
				 if($_POST['btnsubmit']){
					$private_message = fixtext($_POST['message']);
					
					if($private_message){
					require("connect.php");
                    date_default_timezone_set("America/Los_Angeles");
                    $time = date("h:i:sa");
					$date = date("F d, Y");
					$hash = rand();
					mysqli_query($con, 'SET NAMES utf8');
					mysqli_query($con, "INSERT INTO tbl_private_message VALUES ('', '$hash', '$getid', '$user', '$avatar', '$userid', '$username', '$current_user_image', '$private_message', '0', '0', '$date', '$time') ");
					$query = mysqli_query($con, "SELECT * FROM tbl_private_message WHERE msg_id='".$hash."'");
					$numrows = mysqli_num_rows($query);
					if($numrows == 1){
					$row2 = mysqli_fetch_assoc($query);
					$dbid = $row2['id'];
						////////////////////////////////////////////
						// Send email notification to receipient. //
						//////////////////////////////////////////
						/*$to = $email;
						$subject = "Private Message Notification";
						$message = '<!DOCTYPE html><html><head><meta charset="UTF-8"><title>ddrguy Private Message</title></head><body style="margin:0px; font-family:Tahoma, Geneva, sans-serif;"><div style="padding:10px; background:#194F9E; font-size:24px; color:#CCC;"><a href="http://www.ddrguy.16mb.com/index"><img src="http://www.ddrguy.16mb.com/images/DDRGUY_LOGO.png" width="36" height="30" alt="ddrguy" style="border:none; float:left;"></a>Private Message Notification</div><div style="padding:24px; font-size:17px;">Hello '.$user.',<br /><br /><b>'.$username.'</b> sent you a private message.<br /><br />Click the link below to login to your account.<br /><br /><a href="http://www.ddrguy.16mb.com/login">Click here to login to your account now</a><br /><br /></div></body></html>';
						
						$headers  = 'MIME-Version: 1.0' . "\r\n";
						$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
						$headers .= "From: admin@ddrguy.16mb.com";
						
						if(mail($to, $subject, $message, $headers)){*/
							
							echo "<script type='text/javascript'>
						
								$('#sent').fadeIn('slow');
								
								  </script>
								  
								<div id='sent'>Sent!</div>";
							
						/*}else{
							echo "An error occurred while sending the email.";
						}*/
				
						
						////////////////////////////
						// End email notification //
						//////////////////////////
					}
					else
						echo "An error has occurred. Please try again later.";
					}
					else
						echo "Please enter a message.";
				 }
				 //echo $user;
				 
				 
				 
		echo $form;
			
		}
		else
			echo "You cannot private message yourself.";
		}
		else
			echo "That user was not found.";
	}
	else
		echo "No user found!";
	}
	else
		echo "You must be logged in.";
	?>
	
	</div>
	
	<div class='clear'>
	
	<?php require("bottom.php");?>
	</div>