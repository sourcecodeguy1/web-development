    <?php $title = "ddrguy - Edit Profile";?>
	<?php require("top.php");?>
		<?php //<div id="full">Content here.</div> ?>
		
		<div id="left">
		
		<?php
		
		if ($username){
		
				require("connect.php");
			
			if($_POST['savebtn']){
			
				$firstname = $_POST['firstname'];
				$lastname = fixtext($_POST['lastname']);
				$email = fixtext($_POST['email']);
				$website = fixtext($_POST['website']);
				$youtube = fixtext($_POST['youtube']);
				$bio = fixtext($_POST['bio']);
			
				
					if ($firstname && $lastname && $email){
                        if ((strlen($email) >= 6) && strstr($email, "@") && strstr($email, ".")){
						
								
						    $query = mysqli_query($con, "SELECT * FROM users WHERE id='".$userid."'");
    							$numrows = mysqli_num_rows($query);
								if ($numrows == 1) {
							
								
										// Set firstname
									mysqli_query($con, "UPDATE users SET firstname='".$firstname."' WHERE id='".$userid."'");
									// Set lastname
									mysqli_query($con, "UPDATE users SET lastname='".$lastname."' WHERE id='".$userid."'");
									// Set email
									mysqli_query($con, "UPDATE users SET email='".$email."' WHERE id='".$userid."'");
									// Set website
									mysqli_query($con, "UPDATE users SET website='".$website."' WHERE id='".$userid."'");
									// Set youtube
									mysqli_query($con, "UPDATE users SET youtube='".$youtube."' WHERE id='".$userid."'");
									// Set bio
									mysqli_query($con, "UPDATE users SET bio='".$bio."' WHERE id='".$userid."'");
									
                                    echo "Information updated.";
								}
                                else
                                echo "An error has occurred";
                        }
                        else
                            echo "You did not enter a valid email.";
						
					}
					else
						echo "You did not provide the required information.";
					
			}
			
			
			
			
			$query = mysqli_query($con, "SELECT * FROM users WHERE id='".$userid."'");
			$numrows = mysqli_num_rows($query);
			if ($numrows == 1){
			
				$row = mysqli_fetch_assoc($query);
				$id = $row['id'];
				$firstname = $row['firstname'];
				$lastname = $row['lastname'];
				$email = $row['email'];
				$avatar = $row['avatar'];
				$bio = $row['bio'];
				$website = $row['website'];
				$youtube = $row['youtube'];
				$lastlogin = $row['last_login'];
				$active = $row['active'];
				$locked = $row['locked'];
				$date = $row['date'];
			
			
			}
			else
				echo "An error occurred while connecting the database.";
			
			
		$infoform = "<form action='$site/edit_profile' method='post' enctype='multipart/form-data'>
		<table cellspacing='10px'>
		<tr>
			<td></td>
			<td><font color='white'>Fields with</font> [<font color='red'>*</font>] <font color='white'>are required</font></td>
		</tr>
		<tr>
			<td><font color='white'>First Name:</font></td>
			<td><input type='text' name='firstname' class='textbox' size='35' value='$firstname' /><font color='red'>*</font></td>
		</tr>
		<tr>
			<td><font color='white'>Last Name:</font></td>
			<td><input type='text' name='lastname' class='textbox' size='35' value='$lastname' /><font color='red'>*</font></td>
		</tr>
		<tr>
			<td><font color='white'>email:</font></td>
			<td><input type='text' name='email' class='textbox' size='35' value='$email' /><font color='red'>*</font></td>
		</tr>
		<tr>
			<td><font color='white'>Website Address:</font></td>
			<td><input type='text' name='website' class='textbox' size='35' value='$website' /></td>
		</tr>
		<tr>
			<td><font color='white'>Youtube Username:</font></td>
			<td><input type='text' name='youtube' class='textbox' size='35' value='$youtube' /></td>
		</tr>
		<tr>
			<td><font color='white'>Bio/About:</font></td>
			<td><textarea name='bio' cols='35' rows='5' class='textbox'>$bio</textarea></td>
		</tr>
		
		
		<tr>
			<td></td>
			<td><input type='submit' name='savebtn' value='Save Changes' class='button' /></td>
		</tr>
		</table>
		</form>";
				echo $infoform;
				
				///////////////////////////////////////////////////////////////////////////
				//////////////////////////////E/d/i/t//P/a/s/s/w/o/r/d/////////////////////////////////
				///////////////////////////////////////////////////////////////////////////
				
				echo "<br /><hr />";
				
				if ($_POST['passbtn']){
				
					$oldpass = fixtext($_POST['oldpass']);
					$newpass = fixtext($_POST['newpass']);
					$confirmpass = fixtext($_POST['confirmpass']);
					
					if ($oldpass && $newpass && $confirmpass){
						if ($newpass === $confirmpass){
							$current_hash_pass = $oldpass;
							$query = mysqli_query($con, "SELECT * FROM users WHERE id='".$userid."'");
							
							$row = mysqli_fetch_assoc($query);
							$dbfname = $row['first_name'];
							$dbuser = $row['username'];
							$dbemail = $row['email'];
							$dbpass = $row['password'];
							
							$full_salt = substr($dbpass, 0, 29);
							$new_hash = crypt($current_hash_pass, $full_salt);
							
							if($dbpass == $new_hash){
							
                            $new_hash_full_salt = substr(sha1(mt_rand()),0,22);
							$new_hash_pass = crypt($newpass, '$2a$10$'.$new_hash_full_salt);
							
							mysqli_query($con, "UPDATE users SET password='".$new_hash_pass."' WHERE id='".$userid."'");
							
							$query = mysqli_query($con, "SELECT * FROM users WHERE id='".$userid."' AND password='".$new_hash_pass."'");
							$numrows = mysqli_num_rows($query);
							if ($numrows == 1) {
											/*$to  = $dbemail;

											// subject
											$subject = 'Password Reset';

											// message
											$message = "<center><img src='$site/images/header.png' alt='Home Page Logo' /></center><br />
											<body style='font-family:Tahoma, Geneva, sans-serif;'>Hello <b>$dbfname</b>, you have recently made a change on your password. If you haven't made this request, please
											contact the administrator as soon as possible. The link is below this message.</body><br />
											<center><a href='#'>Contact Administrator</a></center>";

											// To send HTML mail, the Content-type header must be set
											$headers  = 'MIME-Version: 1.0' . "\r\n";
											$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

											// Additional headers
											$headers .= 'From: noreply@friendsbook.netau.net';
											
											
											
											
											if(mail($to, $subject, $message, $headers)){
											
											echo "<script type='text/javascript'>
												 $('#frm_account_options').fadeOut();
													</script>";
													
											echo "Your password has been reset.";
											}
											else
												echo "Your email was not sent!";*/
											echo "<font color='white'>Your new password has been reset.</font>";
							
							}
							else
								echo "<font color='white'>An error has occurred and your password was not reset.</font>";
								
								}
								else
									echo "<font color='white'>Your password is incorrect.</font>";
								
								mysqli_close($con);
						}
						else
							echo "<font color='white'>Your new passwords did not match.</font>";
					}
					
					else
						echo "<font color='white'>You did not fill in the entire form.</font>";
				}
				echo "<center><font color='white'>Change Password</font></center>";
				$passform = "<form action='$site/edit_profile' method='post'>
				<table cellspacing='10px'>
				<tr>
					<td><font color='white'>Current Password:</font></td>
					<td><input type='text' name='oldpass' class='textbox' size='35' /></td>
				</tr>
				<tr>
					<td><font color='white'>New Password:</font></td>
					<td><input type='password' name='newpass' class='textbox' size='35' /></td>
				</tr>
				<tr>
					<td><font color='white'>Confirm Password:</font></td>
					<td><input type='password' name='confirmpass' class='textbox' size='35' /></td>
				</tr>
				<tr>
					<td></td>
					<td><input type='submit' name='passbtn' class='button' size='35' value='Change Password' /></td>
				</tr>
				</table>
				</form>";
				
				echo $passform;
				
				echo "<hr />";
				echo "<a href='$site/message_history'>View your message history</a><br />";
				echo "<a href='$site/addvideos'>Add Videos</a><br />";
				echo "<a href='$site/public_display'>Gallery Pictures Security Option</a>";
		}
		else
			echo "<font color='red'><center><h1>You must be logged in to view this page.</h1></center></font>";
		
		?>
		
		</div>
		<div id="right">right side</div>
	
	<?php require("./bottom.php");?>