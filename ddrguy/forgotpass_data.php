<?php
//error_reporting(E_ALL ^ E_NOTICE);
session_start();
$username = $_SESSION['username'];
$userid = $_SESSION['userid'];
$site = "http://www.ddrguy.16mb.com";
echo "<title>ddrguy - Forgot Password Data</title>";
?>
<?php
    if (!$username && !$userid){
		
			$user = $_POST['user'];
			$email = $_POST['email'];
			
			if ($user){
				if ($email){
					if( (strlen($email) >= 7) && (strstr($email, "@")) && (strstr($email, ".")) ){
						
							require("connect.php");
						
						$query = mysqli_query($con, "SELECT * FROM users WHERE username='".$user."'");
						$numrows = mysqli_num_rows($query);
						if ($numrows == 1){
							$row = mysqli_fetch_assoc($query);
							
							$dbemail = $row['email'];
							
							if ($email == $dbemail){
								
								$password = substr(sha1(rand()),0,22);
                            
								$full_salt = substr(sha1(mt_rand()),0,22);
								$tmp_pass_hash = crypt($password, '$2a$10$'.$full_salt);
								
								mysqli_query($con, "UPDATE users SET password='".$tmp_pass_hash."' WHERE username='".$user."'");
								
								$query = mysqli_query($con, "SELECT * FROM users WHERE username='".$user."' AND password='".$tmp_pass_hash."'");
								$numrows = mysqli_num_rows($query);
								if ($numrows == 1){
									
								
								require 'PHPMailerAutoload.php';

								//PHPMailer Object
								$mail = new PHPMailer;

								//From email address and name
								$mail->From = "admin@ddrguy.16mb.com";
								$mail->FromName = "Admin";

								//To address and name
								//$mail->addAddress("juliothemanslayer@yahoo.com", "ddrguy user");
								$mail->addAddress($email); //Recipient name is optional

								//Provide file path and name of the attachments
								//$mail->addAttachment("file.txt", "File.txt");        
								//$mail->addAttachment("images/DDRGUY_LOGO.png"); //Filename is optional

								//Address to which recipient will reply
								//$mail->addReplyTo("reply@ddrguy.16mb.com", "Reply");

								//Send HTML or Plain Text email
								$mail->isHTML(true);

$mail->Subject = "Forgot Password Notification";
$mail->Body = '<!DOCTYPE html><html><head><meta charset="UTF-8"><title>ddrguy Password Changed</title></head><body style="margin:0px; font-family:Tahoma, Geneva, sans-serif;"><div style="padding:10px; background:#194F9E; font-size:24px; color:#CCC;"><a href="http://www.ddrguy.16mb.com/index"><img src="http://www.ddrguy.16mb.com/images/DDRGUY_LOGO.png" width="36" height="30" alt="ddrguy" style="border:none; float:left;"></a>Password Changed Notification</div><div style="padding:24px; font-size:17px;">Hello <b>'.$user.'</b>, you recently requested a forgot password.<br /><br />Your new password is below. Copy and paste it when you log in. It is urgent that
you change your password after logging in for security reasons.<br /><br /><b>New Password:&nbsp;</b><font color="red">'.$password.'</font><br /><br /><a href="http://www.ddrguy.16mb.com/login">Click here to login to your account now</a><br /><br /><font color="green">If you did not made this change, click the link below to contact the admin.<br /><br /></font>
<a href="http://www.ddrguy.16mb.com/contact?email='.$email.'">Contact Admin</a><br /><br /></div></body></html>';

$mail->AltBody = "This is the plain text version of the email content";

if(!$mail->send()) 
{
    echo "Mailer Error: " . $mail->ErrorInfo;
} 
else 
{
    echo "Message has been sent successfully";
}
									
								}
								else
									echo "An error has occurred and the password was not reset.";
							}
							else
								echo "You have entered the worng email address.";
						}
						else
							echo "That username was not found.";
						
						mysqli_close($con);
					}
					else
						echo "Please enter a valid email.";
				}
				else
					echo "Please enter your email.";
			}
			else
				echo "Please enter your username.";
		
		}
	else
		echo "Please logout to view this page.";
		?>