<?php 
$title = "DDR Guy - View Picture"; 
?>
<?php require("./top.php"); ?>

    <div id='full'>
	<?php
		require("connect.php");
		$getid = $_GET['id'];
		$dbpic_id = $_GET['pic_id'];
		 
		 
		
		$query = mysqli_query($con, "SELECT * FROM gallery WHERE pic_id='".$dbpic_id."'");
		$numrows = mysqli_num_rows($query);
		if($numrows == 1){
		$row = mysqli_fetch_assoc($query);
		$dbuserid = $row['user_id'];
		$dbusername = $row['user_name'];
		
		$check_friend_query = mysqli_query($con, "SELECT id FROM friends_list WHERE (user_one='$userid' AND user_two='$dbuserid') OR (user_one='$dbuserid' AND user_two='$userid')");
		if(mysqli_num_rows($check_friend_query) == 1){
			$gallery_query = mysqli_query($con, "SELECT * FROM gallery WHERE pic_id='".$dbpic_id."'");
			$gallery_numrows = mysqli_num_rows($gallery_query);
			if($gallery_numrows == 1){
				
			$gallery_rows = mysqli_fetch_assoc($gallery_query);
			$gallery_picture = $gallery_rows['picture'];
			$gallery_pictureID = $gallery_rows['pic_id'];
			
				
			
				echo "<img src='users_gallery/$gallery_picture' style='margin-left: 230px; border:1px solid #ffffff;' width='300px' height='300px'><a href='$site/gallery?id=$dbuserid' style='float: right;'>Back</a></img><br /><br />";
				
				echo "<b class='corners'>
				  <b class='corners1'><b></b></b>
				  <b class='corners2'><b></b></b>
				  <b class='corners3'></b>
				  <b class='corners4'></b>
				  <b class='corners5'></b></b>

				  <div class='cornersfg'>
					<center><div name='posterror' class='top' style='color: white;'>$dbusername's Comments</div></center>
					
					</div>
					
					<div class='bottom' style='border:5px solid #414141;'>
					
					 <b></b> <br />";
					 
					$form = "<center><form action='$site/delete_picture?pic_id=$gallery_pictureID&s=#comments' method='post'>
					
					<table style=''>
					<tr>
						<td><textarea id='comment_picture' style='color: red; font-weight: bold;' name='comment' placeholder='Post a comment...' style='width: 400px; height: 75px;'></textarea></td>
					</tr>
					<tr>
						<td><input type='submit' name='commentbtn' class='button' value='Post Comment'></td>
					</tr>
					</table>
					</form></center>
					
				  </div>";
				  
				  	if($userid != $dbuserid){
					if($_POST['commentbtn']){
					$comment = fixtext($_POST['comment']);
						
						if ($comment){
						$query = mysqli_query($con, "SELECT * FROM gallery_comments WHERE profile_id='".$dbuserid."' AND user_id='".$userid."' AND comment='".$comment."'");
							$numrows = mysqli_num_rows($query);
							if ($numrows == 0){
							
							
							$commdate = date("F d, Y");
							mysqli_query($con, "INSERT INTO gallery_comments VALUES('', '".$dbuserid."', '".$dbusername."', '".$dbpic_id."', '".$userid."', '".$username."', '".$comment."', '".$commdate."')");
							
							// Send email here to the user for email notification.
							
							$sent = "<center><b><font color='white'>Your comment has been added and is shown above.</font></b></center>";
								}
								else
									$sent = "<center><b><font color='white'>You can not submit the same comment twice.</font></b></center>";
						
						}
						else
							$sent = "<center><b><font color='white'>You did not post a comment.</font></b></center>";
					}
					
					$perpage = 5;
					$start   = $_GET['s'];
					
					if (!$start)
						$start = 0;
					
					$query = mysqli_query($con, "SELECT * FROM gallery_comments WHERE profile_id='".$dbuserid."' AND pic_id='".$dbpic_id."' ORDER BY id DESC LIMIT $start, $perpage");
					$numrows = mysqli_num_rows($query);
					if ($numrows > 0){
					
						$gallery = mysqli_query($con, "SELECT * FROM gallery WHERE pic_id='".$dbpic_id."'");
						$gallery_numrows = mysqli_num_rows($gallery);
						if($gallery_numrows == 1){
						$next = $start + $perpage;
						$prev = $start - $perpage;
						
						
					
						while($row = mysqli_fetch_assoc($query)){
							$user_id = $row['user_id'];
							$user_name = $row['user_name'];
							$comment = nl2br($row['comment']);
							$date = $row['date'];
							
							echo "<b>Posted by: <a href='$site/profile?id=$user_id'>$user_name</a> on $date</b><br />";
							echo "<b><font color='white'>$comment</b></font><hr />";
						
						}
						
						}
						else
							$sent = "<center><b><font color='white'>This user was not found!</font></b></center>";
						
					}
					else
						$sent = "<center><font color='white'><b>$dbusername has no comments.</b></font></center>";
						
						
						echo "<div style='float: right; padding-right: 7px;'>";
						
						if (!($start <=0))
							echo "<a href='$site/delete_picture?pic_id=$dbpic_id&s=$prev#comments'>Previous</a>";
							
							if (!($start > $numrows - $perpage))
								echo "<a href='$site/delete_picture?pic_id=$dbpic_id&s=$next#comments'>Next</a>";
							
							echo "</div>";
				  echo "<a name='comments'></a>";
				  echo $sent;
				echo $form;
					
				}
				
			}
			else
				echo "<font color='white'>An error has occurred!</font>";
		}
		else if($userid == $dbuserid){
			
			$query = mysqli_query($con, "SELECT * FROM gallery WHERE pic_id='".$dbpic_id."'");
			$numrows = mysqli_num_rows($query);
			if($numrows == 1){
			$row = mysqli_fetch_assoc($query);
			$loggedInUserID = $row['user_id'];
			$loggedInUserName = $row['user_name'];
			$picture = $row['picture'];
						
						if ($_POST['deletebtn']){
							
			
			mysqli_query($con, "DELETE FROM gallery WHERE pic_id='$dbpic_id'");
			$query = mysqli_query($con, "SELECT * FROM gallery WHERE pic_id='$dbpic_id'");
			$numrows = mysqli_num_rows($query);
			if($numrows == 0){
				mysqli_query($con, "DELETE FROM gallery_comments WHERE pic_id='$dbpic_id'");
			//echo "Picture was deleted.";
			$filename = "users_gallery/$picture";
			unlink($filename);
			//header("location: $site/gallery?id=$userid");
			echo "<b>Redirecting...</b>";
			 require("bottom.php");
			echo "<script type='text/javascript'>
				window.location.replace('$site/gallery?id=$userid');
			  </script>";
			}
			else
				echo "<font color='white'>An error has occurred.</font>";
				
			
		}
			echo "<img src='users_gallery/$picture' style='margin-left: 230px; border:1px solid #ffffff;' width='300px' height='300px'><a href='$site/gallery?id=$userid' style='float: right;'>Back</a></img><br /><br />";
			$form2 = "<form action='' method='post'>
							
							<div class='delete'>
							<input type='submit' style='' name='deletebtn' class='button' value='Delete' />
							</div>
						
						</form>";
						echo $form2;
					
			echo "<b class='corners'>
				  <b class='corners1'><b></b></b>
				  <b class='corners2'><b></b></b>
				  <b class='corners3'></b>
				  <b class='corners4'></b>
				  <b class='corners5'></b></b>

				  <div class='cornersfg'>
					<center><div name='posterror' class='top' style='color: white;'>Your Comments</div></center>
					
					</div>
					
					<div class='bottom' style='border:5px solid #414141; padding: 17px;'>";
						
						$div = "<div>
						
								</div>
					 
				  </div>";
					
						$perpage = 5;
					$start   = $_GET['s'];
					
					if (!$start)
						$start = 0;
					
					$query = mysqli_query($con, "SELECT * FROM gallery_comments WHERE profile_id='".$dbuserid."' AND pic_id='".$dbpic_id."' ORDER BY id DESC LIMIT $start, $perpage");
						$numrows = mysqli_num_rows($query);
						if($numrows > 0){
						$gallery = mysqli_query($con, "SELECT * FROM gallery WHERE pic_id='".$dbpic_id."'");
						$gallery_numrows = mysqli_num_rows($gallery);
						if($gallery_numrows == 1){
						$next = $start + $perpage;
						$prev = $start - $perpage;
						
						
					
						while($row = mysqli_fetch_assoc($query)){
							$user_id = $row['user_id'];
							$user_name = $row['user_name'];
							$comment = nl2br($row['comment']);
							$date = $row['date'];
							
							echo "<center><b>Posted by: <a href='$site/profile?id=$user_id'>$user_name</a> on $date</b></center><br />";
							echo "<center><b><font color='white'>$comment</b></font></center><hr />";
							
						
						}
						
						}
						else
							$sent = "<center><font color='white'><b>This user was not found!</b></font></center>";
						}
						else
							echo "<center><font color='white'><b>You have no comments.</b></font></center>";
							
								echo "<div style='float: right; padding-right: 7px;'>";
						
						if (!($start <=0))
							echo "<a href='$site/delete_picture?pic_id=$dbpic_id&s=$prev#comments'>Previous</a>";
							
							if (!($start > $numrows - $perpage))
								echo "<a href='$site/delete_picture?pic_id=$dbpic_id&s=$next#comments'>Next</a>";
							
							$end_next_tag = "</div>";
				  echo "<a name='comments'></a>";
							
					echo $sent;
					echo $div;
					
						echo "<br />";
			
			
			}
			else
				echo "<font color='white'>The current logged in user was not found!</font>";
		}
		elseif($userid != $dbuserid){
			//echo "You are not allowed to view this page.";
			//header("location: $site/404");
			echo "<script type='text/javascript'>
					window.location.replace('$site/404');
				  </script>";
		}
		else
		{
			echo "<font color='white'>The gallery pictures that belong to <b>$dbusername</b> are in private. Add <b>$dbusername</b> as your friend to see the galleries.</font>";
		}
		
		}
		else
			echo "<font color='white'>No picture found!</font>";
	?>
	</div>
	
	<div class='clear'>
	
	<?php require("bottom.php");?>
	</div>