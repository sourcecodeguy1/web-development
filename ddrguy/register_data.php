<?php
//error_reporting(0);
require("./functions.php");
echo "<title>ddrguy - Register_data</title>";
$site = "http://www.ddrguy.16mb.com";
?>
		<?php
		
		//<input type='submit' name='submitbtn' value='Register' class='button' />
			$firstname = fixtext($_POST['firstname']);
			$lastname = fixtext($_POST['lastname']);
			$username = fixtext($_POST['username']);
			$email = fixtext($_POST['email']);
			$password = fixtext($_POST['password']);
			$repassword = fixtext($_POST['repassword']);
			$website = fixtext($_POST['website']);
			$youtube = fixtext($_POST['youtube']);
			$bio = fixtext($_POST['bio']);
			
			/*$name = $_FILES['avatar']['name'];
			$type = $_FILES['avatar']['type'];
			$size = $_FILES['avatar']['size'];
			$tmpname = $_FILES['avatar']['tmp_name'];
			$ext = substr($name, strrpos($name, '.'));*/
			
			if ($firstname || $lastname || $username  || $email  || $password || $repassword){
				if($firstname){
					if($lastname){
						if($username){
							if((strlen($username) >= 5)){
								if($email){
									if($password){
										if((strlen($password) >= 8)){
											if($repassword){
												if ($password === $repassword){
													if ((strlen($email) >= 6) && strstr($email, "@") && strstr($email, ".")){
						
													require("connect.php");
													
													$query = mysqli_query($con, "SELECT * FROM users WHERE username='".$username."'")or die(mysqli_error($con));
													$numrows = mysqli_num_rows($query);
													if ($numrows == 0) {
										
														$query = mysqli_query($con, "SELECT * FROM users WHERE email='".$email."'")or die(mysqli_error($con));
														$numrows = mysqli_num_rows($query);
														if ($numrows == 0) {
														
												    $full_salt = substr(sha1(mt_rand()),0,22);
    												    $pass_hash = crypt($password, '$2a$10$'.$full_salt);
												$date = date("F d, Y");
								
													/*if (strstr($type, "image")){
														$avatarname = $username.$ext;
														move_uploaded_file($tmpname, "avatars/$avatarname");
														$avatar = $username.$ext;	
													}
													else*/
									$avatar = "defavatar.png";
									
									$code = substr(md5(rand(111111111111111, 9999999999999999999999)), 2, 25);
								
								mysqli_query($con, "INSERT INTO users VALUES ('', '$firstname', '$lastname', '$username', '$email', '$pass_hash', '$avatar', '$bio', '$website', '$youtube', '', '0', '$code', '0', '$date', '0', '1')")or die(mysqli_error($con));
								
										$query = mysqli_query($con, "SELECT * FROM users WHERE username='".$username."'");
										$numrows = mysqli_num_rows($query);
										if($numrows == 1){
											
											/*$from = "From: admin@ddrguy.com";
											$to = $email;
											$subject = "Activate Your Account";
											//$message = "Content-Type: text/html";
											$message = "Dear <b>$firstname</b>. Welcome to DDRGUY.com below is a link
											for you to activate your account on DDRGUY.com\r\n\ Click Here to Activate Your Account:
											$site/activate?code=$code";
											//$headers = $from;
											$headers  = 'MIME-Version: 1.0' . "\r\n";
											$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";*/
											// multiple recipients
											$to  = $email;

											// subject
											$subject = 'Activate Your Account';

											// message
											$message = "<center><img src='$site/images/DDRGUY_LOGO.png' alt='Home Page Logo' /></center><br />
											<center>Dear <b>$firstname</b>, <font color='red'>Welcome to DDRGUY.com below is a link
											for you to activate your account on DDRGUY.com<br /> Click Here to Activate Your Account:</font>
											<a href='$site/activate?code=$code'><b>Activate your account</b></a>
											</center>";

											// To send HTML mail, the Content-type header must be set
											$headers  = 'MIME-Version: 1.0' . "\r\n";
											$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

											// Additional headers
											$headers .= 'From: admin@ddrguy.16mb.com';
											
											
											
											
											if(mail($to, $subject, $message, $headers)){
											
											/*require_once "Mail.php"; 
											$from = "Admin <postmaster@celinejulio.com>";   //IMPORTANT: This must be same as your smtp authentication address.
											$to = $email; 
											$subject = "Activate Your Account"; 
											$body = "Dear <b>$firstname</b>. Welcome to DDRGUY.com below is a link
											for you to activate you account on DDRGUY.com<br /><br /> Click Here to Activate Your Account:
											$site/activate?code=$code"; 
											$host = ""; 
											$username = "";  //IMPORtANT: This email MUST be same as your FROM address.
											$password = "";

											
											$headers = array ('From' => $from, 
											  'To' => $to, 
											  'Subject' => $subject,
											  'Content-Type: text/html' => $body); 
											$smtp = Mail::factory('smtp', 
											  array ('host' => $host, 
											  'auth' => true, 
											  'username' => $username, 
											  'password' => $password)); 
											$mail = $smtp->send($to, $headers, $body);*/
											
											 echo "<script type='text/javascript'>
												 $('#regform').fadeOut();
													/*window.location.href = '$site/profile?id=$dbid'*/
													</script>";
													
											echo "Thank you for registering. You must now activate your account through the email sent to <b>$email</b>. <br />";
											echo "<a href='$site/login.php'>Log in here</a>";
											}
											else
												echo "Your email was not sent!";
							
										}
										else
											echo "An error has occurred. Your account was not created.";
						}
						else
							echo "That email is already taken.";
						}
						else
							echo "That username is already taken.";
							mysqli_close($con);
						
					}
					else
						echo "You did not enter a valid email.";
				}
				else
					echo "Your passwords did not match.";
					
					}
					else
						echo "Please enter your confirm password.";
						}
						else
							echo "Your password must be at least 8 characters long.";
					}
					else
						echo "Please enter your password.";
					
					}
					else
						echo "Please enter your email address.";
					
					}
					else
						echo "Your username must be at least 5 characters.";
						
						}
						else
							echo "Plese enter your username.";
					}
					else
						echo "Please enter your last name.";
				}
				else
					echo "Please enter your first name.";
			}
			else
				echo "You did not filled in all the required fields.";
	
		?>	