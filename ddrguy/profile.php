<?php $title = "DDR Guy - Profile"; ?>
<?php require("./top.php"); ?>

    <div id='full'>
    <?php
    
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
			
			if ($locked == 0){
				if($username){
				if($userid != $getid){
				echo "<div id='profile'>
				<div id='left'>
				<img src='avatars/$avatar' width='250px' height='250px'></img><br />
				
				<br /><div><a href='$site/gallery?id=$getid'><img src='avatars/photo_gallery.png'></img></a></div><br />
				<div><a href='$site/music?id=$getid'>Music</a> 
				<span style='margin-left:30px;'><a href='private_message?id=$getid'>Send Private Message</a></span></div>
				
				</div>
				
				
									
				
				<div id='right'>
				<div>
				  <b class='corners'>
				  <b class='corners1'><b></b></b>
				  <b class='corners2'><b></b></b>
				  <b class='corners3'></b>
				  <b class='corners4'></b>
				  <b class='corners5'></b></b>
				 
				  <div class='cornersfg'>
					<div class='top'>$user's Profile</div>
					
					</div>
					
					<div class='bottom'>
					<b>Joined</b> - $date<br />
					<b><br />Last Login</b> - $lastlogin<br />";
				  
				
				if ($website)
				echo "<br /><b><u>Website:</u></b/><br /> <a href='http://$website'>$website</a><br />";
				
				if ($youtube)
				echo "<br /><b><u>Youtube Channel:</u></b><br /> <a href='http://www.youtube.com/$youtube'>$youtube</a><br />";
				
				if ($bio)
				echo "<br /><b>Bio:</b> $bio";
				
				echo "</div>

				  <b class='corners'>
				  <b class='corners5'></b>
				  <b class='corners4'></b>
				  <b class='corners3'></b>
				  <b class='corners2'><b></b></b>
				  <b class='corners1'><b></b></b></b>
				</div>";
					/*
					if ($youtube)
					
						echo "<script src=http://www.gmodules.com/ig/ifr?url=></script>";
						http://www.youtube.com/watch?v=v8HoVdenZFM phpacademy get data from mysqldatabase
					*/
					
					echo "<a name='comments'></a><div style='margin-top: 15px;'>
				  <b class='corners'>
				  <b class='corners1'><b></b></b>
				  <b class='corners2'><b></b></b>
				  <b class='corners3'></b>
				  <b class='corners4'></b>
				  <b class='corners5'></b></b>

				  <div class='cornersfg'>
					<div name='posterror' class='top'>$user's Profile Comments</div>
					
					</div>
					
					<div class='bottom' style='padding-bottom: 20px;'>";
					
					// Comment button action
					
					if ($_POST['commentbtn']){
						$comment = fixtext($_POST['comment']);
						
						if ($comment){
							if ($userid != $getid){
							$query = mysqli_query($con, "SELECT * FROM profile_comments WHERE profile_id='".$getid."' AND user_id='".$userid."' AND comment='".$comment."'");
							$numrows = mysqli_num_rows($query);
							if ($numrows == 0){
							
							
							$commdate = date("F d, Y");
							mysqli_query($con, "INSERT INTO profile_comments VALUES('', '".$getid."', '".$user."', '".$userid."', '".$username."', '".$comment."', '".$commdate."')");
							
							// Send email here to the user for email notification.
							
							$msg = "Your comment has been added and is shown above.";
								}
								else
									$msg = "You can not submit the same comment twice.";
							}
							else
								$msg = "You can not comment on your own profile.";
						}
						else
							$msg = "You did not post a comment.";
							
					}
					// Add friend button click function.
					
					if($_POST['addfriendbtn']){
						  // Send the email to the user.
						  
								/*$to = $email;
								$subject = "Friend Request Notification";
								$message = "<center><img src='$site/images/DDRGUY_LOGO.png' alt='Home Page Logo' /></center><br />
								<center>Dear <b>$user</b>, you have a friend request by <b>$username</b> Login by clicking the link below.</center><br />
								<center><a href='$site/login'>Login</a></center>";
								
								$headers  = 'MIME-Version: 1.0' . "\r\n";
								$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
								$headers .= "From: admin@ddrguy.com";
								
								$to = $email;
								$subject = "Friend Request Notification";
								$message = '<!DOCTYPE html><html><head><meta charset="UTF-8"><title>ddrguy Message</title></head><body style="margin:0px; font-family:Tahoma, Geneva, sans-serif;"><div style="padding:10px; background:#194F9E; font-size:24px; color:#CCC;"><a href="http://www.ddrguy.16mb.com/index"><img src="http://www.ddrguy.16mb.com/images/DDRGUY_LOGO.png" width="36" height="30" alt="ddrguy" style="border:none; float:left;"></a>Friend Request Notification</div><div style="padding:24px; font-size:17px;">Hello '.$user.',<br /><br /><b>'.$username.'</b> friend requested you.<br /><br />Click the link below to login to your account.<br /><br /><a href="http://www.ddrguy.16mb.com/login">Click here to login to your account now</a><br /><br /></div></body></html>';
								
								$headers  = 'MIME-Version: 1.0' . "\r\n";
								$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
								$headers .= "From: admin@ddrguy.16mb.com";
								
								/*$message = "<center><img src='$site/images/DDRGUY_LOGO.png' alt='Home Page Logo' /></center><br />
								<center>Dear <b>$user</b>, you have a friend request by <b>$username</b> Login by clicking the link below.</center><br />
								<center><a href='$site/login'>Login</a></center>";
								
								if(mail($to, $subject, $message, $headers)){
								echo "Friend request sent!"."<br />";
                                echo "<font color='white'>$to</font>";
								mysqli_query($con, "INSERT INTO friend_request VALUES('', '$userid', '$getid')");
								}
								else
									echo "Your email was not sent!";*/
							
								mysqli_query($con, "INSERT INTO friend_request VALUES('', '$userid', '$getid')");
							
						}
						if($_POST['cancelbtn']){
						
							mysqli_query($con, "DELETE FROM friend_request WHERE from_user='$userid' AND to_user='$getid'");
								
							
						}
						if($_POST['acceptbtn']){
						
							mysqli_query($con, "DELETE FROM friend_request WHERE from_user='$getid' AND to_user='$userid'");
							
							mysqli_query($con, "INSERT INTO friends_list VALUES('', '$getid', '$userid')");
								
							
						}
						if($_POST['unfriendbtn']){
						
							mysqli_query($con, "DELETE FROM friends_list WHERE (user_one='$userid' AND user_two='$getid') OR (user_one='$getid' AND user_two='$userid')");
							
								
							
						}
							
					
					
					// Display comments
					
					$perpage = 5;
					$start   = $_GET['s'];
					
					if (!$start)
						$start = 0;
					
					$query = mysqli_query($con, "SELECT * FROM profile_comments WHERE profile_id='".$getid."' ORDER BY id DESC LIMIT $start, $perpage");
					$numrows = mysqli_num_rows($query);
					if ($numrows > 0){
						
						$next = $start + $perpage;
						$prev = $start - $perpage;
						
						
					
						while($row = mysqli_fetch_assoc($query)){
							$user_id = $row['user_id'];
							$user_name = $row['user_name'];
							$comment = nl2br($row['comment']);
							$date = $row['date'];
							
							echo "<b>Posted by: <a href='$site/profile?id=$user_id'>$user_name</a> on $date</b><br />";
							echo "<div style='margin-left: 10px;'><b><font color='red'>$comment</b></font></div><hr />";
						
						}
						
						
					}
					else
						$msg = "This user has no profile comments.";
						
						
					
					// end display comment area
					
					echo "<div style='float: right; padding-right: 7px;'>";
						
						if (!($start <=0))
							echo "<a href='$site/profile?id=$getid&s=$prev#comments'>Previous</a>";
							
							if (!($start > $numrows - $perpage))
								echo "<a href='$site/profile?id=$getid&s=$next#comments'>Next</a>";
							
							echo "</div>";
					
					if ($username){
						if($userid != $getid){
						$check_friend_query = mysqli_query($con, "SELECT id FROM friends_list WHERE (user_one='$userid' AND user_two='$getid') OR (user_one='$getid' AND user_two='$userid')");
						if(mysqli_num_rows($check_friend_query) == 1){
							$msg2 = "<a>Already Friends</a>";
							if ($msg)
						echo "<b>$msg</b> <br />";
					echo "<form action='$site/profile?id=$getid' method='post'>
					
					<table style='padding-top: 10px;'>
					<tr>
						<td><textarea id='comment' name='comment' placeholder='Post a comment...' style='width: 400px; height: 75px;'></textarea></td>
					</tr>
					<tr>
						<td><input type='submit' name='commentbtn' class='button' value='Post Comment'>
						<input type='submit' name='unfriendbtn' class='button' value='UnFriend $user' /></td>
					</tr>
					<tr>
						<td style='text-align:right;'>$msg2</td>
					</tr>
					</table>
					</form>";
						} else {
						$from_query = mysqli_query($con, "SELECT `id` FROM `friend_request` WHERE `from_user`='$userid' AND `to_user`='$getid' ");
						$to_query = mysqli_query($con, "SELECT `id` FROM `friend_request` WHERE `from_user`='$getid' AND `to_user`='$userid' ");
						if(mysqli_num_rows($to_query) == 1){
							//echo "<a href='#'>Igonre</a> | <a href='#'>Accept</a>";
							echo "<form action='$site/profile?id=$getid' method='post'>
									<table>
									<tr>
									<td><b>$user</b> has requested you to be friends</td>
									</tr>
									<tr>
									<td><input type='submit' class='button' name='ignorebtn' value='Igonre' />
									<input type='submit' class='button' name='acceptbtn' value='Accept' /></td>
									</tr>
									</table>
								  </form>";
						} else if(mysqli_num_rows($from_query) == 1){
							//echo "<a href='#'>Cancel Request</a>";
							echo "<form action='$site/profile?id=$getid' method='post'>
									<table>
									<tr>
									<td><input type='submit' class='button' name='cancelbtn' value='Cancel Request' /></td>
									</tr>
									</table>
								  </form>";
						} else {
							echo "<form action='$site/profile?id=$getid' method='post'>
									<table>
									<tr>
									<td><input type='submit' class='button' name='addfriendbtn' value='Add Friend' /></td>
									</tr>
									</table>
								  </form>";
								
						}
						
						}
						
					}
					}
					
					echo "</div></div>

				  <b class='corners'>
				  <b class='corners5'></b>
				  <b class='corners4'></b>
				  <b class='corners3'></b>
				  <b class='corners2'><b></b></b>
				  <b class='corners1'><b></b></b></b>
				</div>";
				
					
					// End of right column.
					echo "</div>";
				}	/**********************************Display user account if the session id and the getid match****************************************************************************/
				else if($userid == $getid){
					
					echo "<div id='profile'>
				<div id='left'>
				<img src='avatars/$avatar' width='250px' height='250px'></img><br />
				
				<br /><div><a href='$site/gallery?id=$getid'><img src='avatars/photo_gallery.png'></img></a></div><br />
				<div><a href='$site/music?id=$getid'>Music</a></div>
				
				</div>
				
				
									
				
				<div id='right'>
				<div>
				  <b class='corners'>
				  <b class='corners1'><b></b></b>
				  <b class='corners2'><b></b></b>
				  <b class='corners3'></b>
				  <b class='corners4'></b>
				  <b class='corners5'></b></b>
				 
				  <div class='cornersfg'>
					<div class='top'>$user's Profile</div>
					
					</div>
					
					<div class='bottom'>
					<b>Joined</b> - $date<br />
					<b><br />Last Login</b> - $lastlogin<br />";
				  
				
				if ($website)
				echo "<br /><b><u>Website:</u></b/><br /> <a href='http://$website'>$website</a><br />";
				
				if ($youtube)
				echo "<br /><b><u>Youtube Channel:</u></b><br /> <a href='http://www.youtube.com/$youtube'>$youtube</a><br />";
				
				if ($bio)
				echo "<br /><b>Bio:</b> $bio";
				
				echo "</div>

				  <b class='corners'>
				  <b class='corners5'></b>
				  <b class='corners4'></b>
				  <b class='corners3'></b>
				  <b class='corners2'><b></b></b>
				  <b class='corners1'><b></b></b></b>
				</div>";
					/*
					if ($youtube)
					
						echo "<script src=http://www.gmodules.com/ig/ifr?url=></script>";
						http://www.youtube.com/watch?v=v8HoVdenZFM phpacademy get data from mysqldatabase
					*/
					
					echo "<a name='comments'></a><div style='margin-top: 15px;'>
				  <b class='corners'>
				  <b class='corners1'><b></b></b>
				  <b class='corners2'><b></b></b>
				  <b class='corners3'></b>
				  <b class='corners4'></b>
				  <b class='corners5'></b></b>

				  <div class='cornersfg'>
					<div name='posterror' class='top'>$user's Profile Comments</div>
					
					</div>
					
					<div class='bottom' style='padding-bottom: 20px;'>";
					
                    // Display comments
    				
					$perpage = 5;
					$start   = $_GET['s'];
					
					if (!$start)
						$start = 0;
					
					$query = mysqli_query($con, "SELECT * FROM profile_comments WHERE profile_id='".$getid."' ORDER BY id DESC LIMIT $start, $perpage");
					$numrows = mysqli_num_rows($query);
					if ($numrows > 0){
						
						$next = $start + $perpage;
						$prev = $start - $perpage;
						
						
					
						while($row = mysqli_fetch_assoc($query)){
							$user_id = $row['user_id'];
							$user_name = $row['user_name'];
							$comment = nl2br($row['comment']);
							$date = $row['date'];
							
							echo "<b>Posted by: <a href='$site/profile?id=$user_id'>$user_name</a> on $date</b><br />";
							echo "<div style='margin-left: 10px;'><b><font color='red'>$comment</b></font></div><hr />";
						
						}
						
						
					}
					else
						echo "You have no profile comments.";
						
						
					
					// end display comment area
                    
					echo "</div></div>

				  <b class='corners'>
				  <b class='corners5'></b>
				  <b class='corners4'></b>
				  <b class='corners3'></b>
				  <b class='corners2'><b></b></b>
				  <b class='corners1'><b></b></b></b>
				</div>";
				
					    
                    
                    
					// End of right column.
					echo "</div>";
					
				}
					
				
				
				}//End check if username is logged in.
				else if(!$username){
												/************************************For users that are not logged in*******************************************************/
					echo "<div id='profile'>
				<div id='left'>
				<img src='avatars/$avatar' width='250px' height='250px'></img><br />
				
				<br /><div><a href='$site/gallery?id=$getid'><img src='avatars/photo_gallery.png'></img></a></div><br />
				<div><a href='$site/music?id=$getid'>Music</a></div>
				
				</div>
				
				
									
				
				<div id='right'>
				<div>
				  <b class='corners'>
				  <b class='corners1'><b></b></b>
				  <b class='corners2'><b></b></b>
				  <b class='corners3'></b>
				  <b class='corners4'></b>
				  <b class='corners5'></b></b>
				 
				  <div class='cornersfg'>
					<div class='top'>$user's Profile</div>
					
					</div>
					
					<div class='bottom'>
					<b>Joined</b> - $date<br />
					<b><br />Last Login</b> - $lastlogin<br />";
				  
				
				if ($website)
				echo "<br /><b><u>Website:</u></b/><br /> <a href='http://$website'>$website</a><br />";
				
				if ($youtube)
				echo "<br /><b><u>Youtube Channel:</u></b><br /> <a href='http://www.youtube.com/$youtube'>$youtube</a><br />";
				
				if ($bio)
				echo "<br /><b>Bio:</b> $bio";
				
				echo "</div>

				  <b class='corners'>
				  <b class='corners5'></b>
				  <b class='corners4'></b>
				  <b class='corners3'></b>
				  <b class='corners2'><b></b></b>
				  <b class='corners1'><b></b></b></b>
				</div>";
					/*
					if ($youtube)
					
						echo "<script src=http://www.gmodules.com/ig/ifr?url=></script>";
						http://www.youtube.com/watch?v=v8HoVdenZFM phpacademy get data from mysqldatabase
					*/
					
					echo "<a name='comments'></a><div style='margin-top: 15px;'>
				  <b class='corners'>
				  <b class='corners1'><b></b></b>
				  <b class='corners2'><b></b></b>
				  <b class='corners3'></b>
				  <b class='corners4'></b>
				  <b class='corners5'></b></b>

				  <div class='cornersfg'>
					<div name='posterror' class='top'>$user's Profile Comments</div>
					
					</div>
					
					<div class='bottom' style='padding-bottom: 20px;'>";
					
                    // Display comments
    				
					$perpage = 5;
					$start   = $_GET['s'];
					
					if (!$start)
						$start = 0;
					
					$query = mysqli_query($con, "SELECT * FROM profile_comments WHERE profile_id='".$getid."' ORDER BY id DESC LIMIT $start, $perpage");
					$numrows = mysqli_num_rows($query);
					if ($numrows > 0){
						
						$next = $start + $perpage;
						$prev = $start - $perpage;
						
						
					
						while($row = mysqli_fetch_assoc($query)){
							$user_id = $row['user_id'];
							$user_name = $row['user_name'];
							$comment = nl2br($row['comment']);
							$date = $row['date'];
							
							echo "<b>Posted by: <a href='$site/profile?id=$user_id'>$user_name</a> on $date</b><br />";
							echo "<div style='margin-left: 10px;'><b><font color='red'>$comment</b></font></div><hr />";
						
						}
						
						
					}
					else
						echo "This user has no profile comments.";
						
						
					
					// end display comment area
                    
					echo "</div></div>

				  <b class='corners'>
				  <b class='corners5'></b>
				  <b class='corners4'></b>
				  <b class='corners3'></b>
				  <b class='corners2'><b></b></b>
				  <b class='corners1'><b></b></b></b>
				</div>";
				
					    
                    
                    
					// End of right column.
					echo "</div>";
					
				
				
				}
				
					
			}
			else
				echo "That account is locked.";
		
		}
		else
			echo "No user was found.";
	?>
	</div>
	
	<div class='clear'>
	
	<?php require("bottom.php");?>
	</div>