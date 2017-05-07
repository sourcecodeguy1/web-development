<?php
error_reporting(0);
session_start();
$username = $_SESSION['username'];
$userid = $_SESSION['userid'];
echo "<title>ddrguy - Status_data</title>";
$site = "http://localhost/ddrguy.16mb";
?>
<?php
	if($username && $userid){
		 echo "<script type='text/javascript'>
							 $('#logform').fadeOut(1000);
								
							</script>";
		echo "You are already logged in as <span style='color: blue'><b>$username</b></span>";
	}
	else{
		
			$username = strip_tags($_POST['username']);
			$password = strip_tags($_POST['password']);
			//<input type='submit' name='loginbtn' tabindex='3' value='Login' class='button' />
			if ($username || $password){
				if($username){
					if($password){

				require("connect.php");
				
				
				$query = mysqli_query($con, "SELECT * FROM users WHERE username='".$username."'");
				$numrows = mysqli_num_rows($query);
				
				if ($numrows == 1){
				
				$row = mysqli_fetch_assoc($query);
				
				$dbid = $row['id'];
				$dbuser = $row['username'];
				$dbpass = $row['password'];
				$dbactive = $row['active'];
				$dblocked = $row['locked'];
				$dbfirst_login = $row['first_login'];
				
                $full_salt = substr($dbpass, 0, 29);
        		$new_hash = crypt($password, $full_salt);
				
				if ($dbpass == $new_hash){
					if ($dbactive == 1){
						if ($dblocked == 0){
							if($dbfirst_login == 0){
							
							$date = date("F d, Y");
							mysqli_query($con, "UPDATE users SET last_login='".$date."' WHERE id='".$dbid."'");
							
							$_SESSION['username'] = $dbuser;
							$_SESSION['userid'] = $dbid;
					
							// jQuery code goes here...
				
							 echo "<script type='text/javascript'>
							 $('#frmstatus').fadeOut(1000);
								window.location.href = '$site/profile?id=$dbid'
								
							</script>";
							
							//echo "You have been logged in as <b>$dbuser</b>.";
							//header("location: $site/profile?id=$dbid");
							}
							else if($dbfirst_login == 1){
								$date = date("F d, Y");
								mysqli_query($con, "UPDATE users SET last_login='".$date."' WHERE id='".$dbid."'");
							
							$_SESSION['username'] = $dbuser;
							$_SESSION['userid'] = $dbid;
							
							 echo "<script type='text/javascript'>
							 $('#frmstatus').fadeOut(1000);
								window.location.href = '$site/upload_picture'
								
							</script>";
							}
						}
						else
							echo "<center><font color='red'>This account has been locked by the administrator.</font></center> ";
					}
					else
						echo "<center><font color='red'>You must activate your account to login. </font></center>
						<span><a href='$site/activate'>Activate Here</a></span>";
				}
				else
					echo "<center><font color='red'>You did not enter the correct password. </font></center>";
					
					
				}
				else
					echo "<center><font color='red'>Invalid username and password. </font></center>";
				
				mysqli_close($con);
					}
					else
						echo "<font color='red'><center>You must enter your password.</font></center>";
						
				}
				else
					echo "<font color='red'><center>You must enter your username.</font></center>";
			}
			else 
				echo "<font color='red'><center>You did not filled in the entire form.</font></center>";
				
		}
		
?>