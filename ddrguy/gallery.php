<?php 
$title = "DDR Guy - Gallery"; 
?>
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
				$dbid = $row['id'];
				$db_username = $row['username'];
				$db_public = $row['public_display'];
				 
				 if($db_public == 0 || $db_public == 1){
						$check_friend_query = mysqli_query($con, "SELECT id FROM friends_list WHERE (user_one='$userid' AND user_two='$getid') OR (user_one='$getid' AND user_two='$userid')");
						if(mysqli_num_rows($check_friend_query) == 1){
							$gallery_query = mysqli_query($con, "SELECT * FROM gallery WHERE user_id='".$getid."'");
							$gallery_numrows = mysqli_num_rows($gallery_query);
							if($gallery_numrows > 0){	
							while($gallery_rows = mysqli_fetch_assoc($gallery_query)){
							$gallery_picture = $gallery_rows['picture'];
							$gallery_pictureID = $gallery_rows['pic_id'];
								echo "<div class='img'>
					
									<img src='users_gallery/$gallery_picture' width='128px' height='128px'></img><br />
									<a href='$site/delete_picture?pic_id=$gallery_pictureID'>View</a>
									</div>";
							
							}
							}
							else
								echo "<font color='white'><b>$db_username</b> hasn't uploaded any gallery pictures.</font>";
						}
						elseif($db_public == 1){
						$query3 = mysqli_query($con, "SELECT * FROM gallery WHERE user_id='".$getid."'");
						$numrows3 = mysqli_num_rows($query3);
						if($numrows3 == 0 ){
							if($userid == $getid){
							echo "<font color='white'>You haven't uploaded any pictures to your gallery.</font>";
							
							}
							else
								echo "<font color='white'><b>$db_username</b> hasn't uploaded any gallery pictures.</font>";
						}// If you are currently on private or public and logged in, still display your gallery pictures.
						elseif($userid == $getid){
						
						$query99 = mysqli_query($con, "SELECT * FROM gallery WHERE user_id='".$userid."'");
						$numrows99 = mysqli_num_rows($query99);
						if($numrows99 > 0){
						while($row99 = mysqli_fetch_assoc($query99)){
						$db4Pic99 = $row99['picture'];
						$db4PicID99 = $row99['pic_id'];
						echo "<div class='img'>
					
							<img src='users_gallery/$db4Pic99' width='128px' height='128px'></img><br />
							<a href='$site/delete_picture?pic_id=$db4PicID99'>View</a>
							
							</div>";
						}
						}
						else
							echo "<font color='white'>User was not found!</font>";
						
						
						}
						else{
						echo "<font color='white'>The gallery pictures that belong to <b>$db_username</b> are in private. Add <b>$db_username</b> as your friend to see the galleries.</font>";
						}
						}
						elseif($db_public == 0){
							
						$query2 = mysqli_query($con, "SELECT * FROM gallery WHERE user_id='".$getid."'");
						$numrows = mysqli_num_rows($query2);
						if($numrows == 0 ){
							if($userid == $getid){
							echo "<font color='white'>You haven't uploaded any pictures to your gallery.</font>";
							
							}
							else
								echo "<font color='white'><b>$db_username</b> hasn't uploaded any gallery pictures.</font>";
						}
						elseif($numrows > 0){
						if($userid == $getid){
						$query2 = mysqli_query($con, "SELECT * FROM gallery WHERE user_id='".$getid."'");
						while($row4 = mysqli_fetch_assoc($query2)){
						$db4Pic = $row4['picture'];
						$db4PicID = $row4['pic_id'];
							echo "<div class='img'>
					
							<img src='users_gallery/$db4Pic' width='128px' height='128px'></img><br />
							<a href='$site/delete_picture?pic_id=$db4PicID'>View</a>
							
							</div>";
						}
						
						}
						elseif($userid != $getid){
							$notuser_query = mysqli_query($con, "SELECT * FROM gallery WHERE user_id='".$getid."'");
							$notuser_numrows = mysqli_num_rows($notuser_query);
							if($notuser_numrows > 0){
							while($notuser_rows = mysqli_fetch_assoc($notuser_query)){
							$dbnotuser_Pic = $notuser_rows['picture'];
							$dbnotuser_PicID = $notuser_rows['pic_id'];
							echo "<div class='img'>
					
							<img src='users_gallery/$dbnotuser_Pic' width='128px' height='128px'></img><br />
							
							
							</div>";
							}
							
							}
							else
								echo "<font color='white'>NO USER FOUND!</font>";
						}
							
						}
						}
						
						
					
					
						// Create query to see if the user has a picture in the database.
						
						
						
			
				 }
				
					
				
				}
				else
					echo "That user wasn't found!!!";
					
		
	?>
	</div>
	
	<div class='clear'>
	
	<?php require("bottom.php");?>
	</div>