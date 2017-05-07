<?php
session_start();
$username = $_SESSION['username'];
$userid = $_SESSION['userid'];
echo "<title>ddrguy - Activate Data</title>";
$site = "http://www.ddrguy.16mb.com";
ini_set('display_startup_errors',1); 
ini_set('display_errors',1);
error_reporting(-1);
?>
    <?php
    	
	
		$code = $_POST['code'];
		$user = $_POST['username'];
		$pwd = $_POST['password'];
		
		if($code || $user || $pwd){
			if($code){
				if($user){
					if($pwd){
						
						require("connect.php");
						
						$query = mysqli_query($con, "SELECT * FROM users WHERE username='".$user."'")or die(mysqli_error($con));
						$numrows = mysqli_num_rows($query);
						if($numrows == 1){
							
							$row = mysqli_fetch_assoc($query);
							
							$dbpass = $row['password'];
							$dbcode = $row['code'];
							$dbactive = $row['active'];
							
							$full_salt = substr($dbpass, 0, 29); // Salt the password.
							$new_hash = crypt($pwd, $full_salt); // Hash the salted password.
							
							if($dbactive == 0){
								if($dbcode == $code){
									if($dbpass == $new_hash){
										mysqli_query($con, "UPDATE users SET active='1' WHERE username='".$user."'");
										
										$query = mysqli_query($con, "SELECT * FROM users WHERE username='".$user."' AND active='1'")or die(mysqli_error($con));
										$numrows = mysqli_num_rows($query);
										if($numrows == 1){
											echo "<font color='red'><center>You have been activated. Please login to go to your account.</font></center><br />";
											echo "<a href='$site/login'>Login here</a>";
										}
										else
											echo "<font color='red'><center>An error has occurred!</font></center>";
									}
									else
										echo "<font color='red'><center>Your password is incorrect.</font></center>";
								}
								else
									echo "<font color='red'><center>Your code is incorrect.</font></center>";
							}
							else
								echo "<font color='red'><center>This account is already active.</font></center>";
							
						}
						else
							echo "<font color='red'><center>That user was not found.</font></center>";
						mysqli_close($con);
					}
					else
						echo "<font color='red'><center>You must enter your password.</font></center>";
				}
				else
					echo "<font color='red'><center>You must enter your username.</font></center>";
			}
			else
				echo "<font color='red'><center>You must enter your code.</font></center>";
		}
		else
			echo "<font color='red'><center>You did not filled in the entire form.</font></center>";
		?>
       
