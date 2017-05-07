<?php 
error_reporting(E_ALL ^ E_NOTICE);
session_start();
$username = $_SESSION['username'];
$userid = $_SESSION['userid'];
$site = "http://www.ddrguy.16mb.com";
echo "<title>ddrguy - Contact_data</title>";
?>
		<?php
			
			require("connect.php");
			$query = mysqli_query($con, "SELECT * FROM users WHERE id='".$userid."'");
			$numrows= mysqli_num_rows($query);
			if ($numrows == 1){
				$row = mysqli_fetch_assoc($query);
				$firstname = $row['first_name'];
				$lastname = $row['last_name'];
				$email = $row['email'];
			
			}
			// Just display the form with no info added to the values.
		
			$fullname = $_POST['fullname'];
			$email = $_POST['email'];
			$message = $_POST['message'];
			
			if ($fullname || $email || $message){
				if($email){
					if($message){
			
				if ((strlen($email) >= 6) && strstr($email, "@") && strstr($email, ".")){
				
					$webmaster = "admin@ddrguy.16mb.com";
					$headers = "From: <$email>";
					$subject = "Message From $fullname";
					
					if(mail($webmaster, $subject, $message, $headers)){
						
					echo "Message sent";
					
					}
					else
						echo "Message was not sent due to an error. Please try again later.";
				}
				else
					echo "You did not enter a valid email address.";
					}
					else
						echo "Please enter your message.";
				}
				else
					echo "Please your email address.";
			}	
			else
				echo "You did not fill in the entire form.";
		
		
		?>