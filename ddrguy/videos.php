<?php 
error_reporting(0);
$getid = $_GET['id'];
if($getid){
require("connect.php");
    $query = mysqli_query($con, "SELECT * FROM videos WHERE id='".$getid."'");
	$numrows = mysqli_num_rows($query);
			if ($numrows == 1){
				$row = mysqli_fetch_assoc($query);
				
				$title = $row['title'];
				$user_name = $row['user_name'];
				$title = "$title by $user_name - ddrguy Videos";
			}
			else
				$title = "ddrguy - Videos";
				mysqli_close($con);
}
else
	
$title = "ddrguy - Videos";?>
	<?php require("./top.php");?>
	
		
		<?php
		if($username){
		require("connect.php");
		
		if ($getid){
			
			echo "<div id='full'>";
			echo "<div id='video'>";
			
			$query = mysqli_query($con, "SELECT * FROM videos WHERE id='".$getid."'");
			$numrows = mysqli_num_rows($query);
			if ($numrows == 1){
				$row = mysqli_fetch_assoc($query);
					$id = $row['id'];
					$user_id = $row['user_id'];
					$user_name = $row['user_name'];
					$title = $row['title'];
					$description = $row['description'];
					$keywords = $row['keywords'];
					$category = $row['category'];
					$videoid = $row['videoid'];
					$views = $row['views'];
					$comments = $row['comments'];
					$date = $row['date'];
					
					$description = fixtext($description);
					// Start right column
					//echo "<div id='right'>";
					
					/*echo "<script type='text/javascript'><!--
					google_ad_client = 'pub-0894981729172843';
					
					google_ad_slot = '8233928651';
					google_ad_width = 160;
					google_ad_height= 600;
					//-->
					</script type='text/javascript'>
					<script src='http://pagead2.googlesyndication.com/pagead/show_ads.js'>
					</script>";
					*/
					// End right column
					//echo "</div>";
					
					// Start left column
					echo "<div id='left'>";
					
					// Update the video views
					$views = $views + 1;
					mysqli_query($con, "UPDATE videos SET views='".$views."' WHERE id='".$id."'");
					
					// Display title
						echo "<h2><a href='$site/videos?id=$id'>$title</a></h2>";
					
									
					// Display video
					echo "
					<object width='640' height='505'>
					<param name='movie' value='http://www.youtube.com/v/".$videoid."&autoplay=0&amp;h1=en_US&amp;fs=1&rel=0'></param>
					<param name='allowFullScreen' value='true'></param>
					<param name='allowscriptaccess' value='always'></param>
					<embed src='http://www.youtube.com/v/".$videoid."&autoplay=0&amp;h1=en_US&amp;fs=1&rel=0' type='application/x-shockwave-flash' allowscriptaccess='always' allowFullscreen='true' width='640' height='505'></embed>
					</object>";
					
					//echo '<iframe width="560" height="315" src="https://www.youtube.com/embed/qQVZ0ezMpzQ?rel=0" frameborder="0" allowfullscreen></iframe>';
					
					//echo "<iframe width='560' height='315' src='https://www.youtube.com/v/".$videoid."&rel=0' frameborder='0' allowfullscreen></iframe>";
					
					// Display information
					echo "<b style='float: right;'>$views views</b>";
					echo "<b><a href='$site/profile?id=$user_id'>$user_name</a> on $date <br /><br /> $category</b><br /><br />";
					
					echo "$description<br /><br />$keywords";
					
					// Comment section
					
					echo "<a name='comments'></a><div style='margin-top: 15px;'>
				  <b class='corners'>
				  <b class='corners1'><b></b></b>
				  <b class='corners2'><b></b></b>
				  <b class='corners3'></b>
				  <b class='corners4'></b>
				  <b class='corners5'></b></b>

				  <div class='cornersfg'>
					<div name='posterror' class='top'>$title Comments</div>
					
					</div>
					
					<div class='bottom' style='padding-bottom: 20px;'>";
					
					// Comment button action
					
					if ($_POST['commentbtn']){
						$comment = fixtext($_POST['comment']);
						
						if ($comment){
							if ($userid != $getid){
							$query = mysqli_query($con, "SELECT * FROM video_comments WHERE video_id='".$getid."' AND user_id='".$userid."' AND comment='".$comment."'");
							$numrows = mysqli_num_rows($query);
							if ($numrows == 0){
							
							
							$commdate = date("F d, Y");
							mysqli_query($con, "INSERT INTO video_comments VALUES('', '".$getid."', '".$userid."', '".$username."', '".$comment."', '".$commdate."')");
							
							// Send email here to the user for email notification.
							$email_query = mysqli_query($con, "SELECT * FROM users WHERE id='".$user_id."'");
							$email_row = mysqli_fetch_assoc($email_query);
							$dbemail = $email_row['email'];
							
								$to = $dbemail;
								$subject = "Video Comment Notification";
								$message = '<!DOCTYPE html><html><head><meta charset="UTF-8"><title>ddrguy Message</title></head><body style="margin:0px; font-family:Tahoma, Geneva, sans-serif;"><div style="padding:10px; background:#194F9E; font-size:24px; color:#CCC;"><a href="http://www.ddrguy.16mb.com/index"><img src="http://www.ddrguy.16mb.com/images/DDRGUY_LOGO.png" width="36" height="30" alt="ddrguy" style="border:none; float:left;"></a>Video Comment Notification</div><div style="padding:24px; font-size:17px;">Hey '.$user_name.',<br /><br /><b>'.$username.'</b> commented on your video.<br /><br />Click the link below to see the posted comment.<br /><br /><a href="http://www.ddrguy.16mb.com/videos?id='.$getid.'">Click here to see the posted comment now</a><br /><br /></div></body></html>';
								
								$headers  = 'MIME-Version: 1.0' . "\r\n";
								$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
								$headers .= "From: admin@ddrguy.16mb.com";
								
								if(mail($to, $subject, $message, $headers)){
									
									
									$msg = "Your comment has been added and is shown above.";
								}
								else
									$msg = "An error has occurred. Could not send the email to $to.";
							
							
								}
								else
									$msg = "You can not submit the same comment twice.";
							}
							else
								$msg = "You can not comment on your own video.";
						}
						else
							$msg = "You did not post a comment.";
							
					}
					
					
					// Display comments
					
					$perpage = 5;
					$start   = $_GET['s'];
					
					if (!$start)
						$start = 0;
					
					$query = mysqli_query($con, "SELECT * FROM video_comments WHERE video_id='".$getid."' ORDER BY id DESC LIMIT $start, $perpage");
					$numrows = mysqli_num_rows($query);
					if ($numrows > 0){
						
						$next = $start + $perpage;
						$prev = $start - $perpage;
						
						
					
						while($row = mysqli_fetch_assoc($query)){
							$user_id2 = $row['user_id'];
							$user_name = $row['user_name'];
							$comment = nl2br($row['comment']);
							$date = $row['date'];
							
							echo "<b>Posted by: <a href='$site/profile?id=$user_id2'>$user_name</a> on $date</b><br />";
							echo "<div style='margin-left: 10px;'><b><font color='red'>$comment</b></font></div><hr />";
						
						}
					}
					else
						$msg = "This video has no comments.<br />";
					
					// end display comment area
					
					echo "<div style='float: right; padding-right: 7px;'>";
						
						if (!($start <=0))
							echo "<a href='$site/videos?id=$getid&s=$prev#comments'>Previous</a>";
							
							if (!($start > $numrows - $perpage))
								echo "<a href='$site/videos?id=$getid&s=$next#comments'>Next</a>";
							
							echo "</div>";
					
					if ($username){
						if($userid != $user_id){
					// Display comment form
					if ($msg)
						echo "<b>$msg</b> <br />";
					echo "<form action='$site/videos?id=$getid' method='post'>
					
					<table style='padding-top: 10px;'>
					<tr>
						<td><textarea name='comment' placeholder='Post a comment...' style='width: 400px; height: 75px;'></textarea></td>
					</tr>
					<tr>
						<td><input type='submit' name='commentbtn' class='button' value='Post Comment'></td>
					</tr>
					</table>
					</form>";
					}
					
					}
					
					// End comment box
					echo "</div>

				  <b class='corners'>
				  <b class='corners5'></b>
				  <b class='corners4'></b>
				  <b class='corners3'></b>
				  <b class='corners2'><b></b></b>
				  <b class='corners1'><b></b></b></b>
				</div>";
					
					// End comment section
					
					// End left column
					echo "</div>";
			}
			else
				echo "The video you were looking for was not found.";
			// end full and video
			echo "</div>";
			echo "</div>";
		}
		else{
			echo "<div id='left'>";
		$perpage = 5;
		$start = $_GET['s'];
		
		if (!$start)
			$start = 0;
			
			$next = $start + $perpage;
			$prev = $start - $perpage;
						
			$query = mysqli_query($con, "SELECT * FROM videos ORDER BY id DESC");
			$numrows = mysqli_num_rows($query);
			if ($numrows > 0){
				$query = mysqli_query($con, "SELECT * FROM videos ORDER BY id DESC LIMIT $start, $perpage");
				
				echo "<center><div class='pagination'>";
						
						if (!($start <=0))
							echo "<a href='$site/videos?s=$prev'>Previous</a>";
							/*
							$x = 1;
							for ($i = 0; $i < $numrows; $i += $perpage){
								if ($start != $i)
									echo "<a href='$site/videos?s=$i'>$x</a>";
								else
									echo "<a href='$site/videos?s=$i'><b><u>$x</u></b></a>";
									$x++;
							}
							*/
							if (!($start > $numrows - $perpage))
								echo "<a href='$site/videos?s=$next'>Next</a>";
							
							echo "</div></center><br />";
				
				while($row = mysqli_fetch_assoc($query)){
					$id = $row['id'];
					$user_id = $row['user_id'];
					$user_name = $row['user_name'];
					$title = $row['title'];
					$description = $row['description'];
					$keywords = $row['keywords'];
					$category = $row['category'];
					$videoid = $row['videoid'];
					$views = $row['views'];
					$comments = $row['comments'];
					$date = $row['date'];
					
					
					
					if (strlen($description) >= 100)
						$description = substr($description, 0, 100) ."...";
						
					echo "<div class='video'>
						<div class='image' style='border: 1px solid white;'><a href='$site/videos?id=$id'><img src='http://i1.ytimg.com/vi/$videoid/default.jpg'></img></a></div>
						<div class='info'>
						<div class='title'><a href='$site/videos?id=$id'>$title</a></div>
						<div class='description'>
							$description
							<br /><br />
							
							<div style='float: left; font-size: 16px;'><a href='$site/profile?id=$user_id'>$user_name</a></div>
							<div style='float: right; font-size: 16px;'>$category</div>
							<center>$views views</center>
						</div>
						</div>
					</div>";
					
					
				}
				echo "<div class='clear'></div>";
				echo "<center><div class='pagination'>";
						
						if (!($start <=0))
							echo "<a href='$site/videos?s=$prev'>Previous</a> ";
							
							if (!($start > $numrows - $perpage))
								echo "<a href='$site/videos?s=$next'>Next</a>";
							
							echo "</div></center>";
			}
			else
				echo "There currently are no videos.";
				
				echo "</div>";
				
				echo "<div id='right'></div>";
		}
		
		mysqli_close($con);
		}else{
			echo "<center><div>You must login to view this page.</div></center>";
		}
		?>
		
		
		<div class='clear'>
		
	<?php require("./bottom.php");?>
		</div>
