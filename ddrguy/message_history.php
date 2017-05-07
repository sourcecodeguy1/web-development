<?php 
$title = "DDR Guy - Profile";
require("./top.php");
?>

    <div id='full'>
    <?php
	
	$getid = $_GET['id'];
	
	if (!$getid)
		$getid = "1";
		
		
		require("connect.php");
		
			
			
			
				echo "<div id='profile'>
				
				
				
				
				<div id='right2'>
				
					
					
					<a name='comments'></a><div>
				  <b class='corners'>
				  <b class='corners1'><b></b></b>
				  <b class='corners2'><b></b></b>
				  <b class='corners3'></b>
				  <b class='corners4'></b>
				  <b class='corners5'></b></b>

				  <div class='cornersfg'>
				    <center><div name='' style='color: white; font-size: 22px;'><u>Received Messages</u></div></center>
					<div name='posterror' style='color: white; padding-bottom: 5px; font-family: Impact, Charcoal, sans-serif; font-size: 22px;' class='top'><u>$username's Profile Comments</u></div>
					
					
					
					
					<div class='bottom' style='padding-bottom: 20px;'>";
					
					// Comment button action
					
						
					
					// Display comments
					
					
					
					$query = mysqli_query($con, "SELECT * FROM profile_comments WHERE profile_id='".$userid."' ORDER BY id DESC");
					$numrows = mysqli_num_rows($query);
					if ($numrows > 0){
						while($row = mysqli_fetch_assoc($query)){
							
							$user_id = $row['user_id'];
							$user_name = $row['user_name'];
							$comment = nl2br($row['comment']);
							$date = $row['date'];
							
							echo "<b>Posted by: <a href='$site/profile?id=$user_id'>$user_name</a> on $date</b><br />";
							echo "<div style='margin-left: 10px;'><b><font color='white'>$comment</b></font></div><hr />";
						
						}
							
					}
					//else
						//echo "This user has no profile comments.";
					
					////////////////////////************Sent Messages********************//////////////////
							
						echo "<center><div style='color: white; font-size: 22px;'><u style='margin-right: 50px;'>Sent Messages</u></div></center><br />";
						$query2 = mysqli_query($con, "SELECT * FROM profile_comments WHERE user_id='".$userid."' ORDER BY id DESC");
						$numrows2 = mysqli_num_rows($query2);
						if ($numrows2 > 0){
							while($row2 = mysqli_fetch_assoc($query2)){
							$profile_id2 = $row2['profile_id'];
							$profile_user2 = $row2['profile_user'];
							$user_id2 = $row2['user_id'];
							$user_name2 = $row2['user_name'];
							$comment2 = nl2br($row2['comment']);
							$date2 = $row2['date'];
							echo "<b>Posted for: <a href='$site/profile?id=$profile_id2'>$user_name2</a> on $date2</b><br />";
							echo "<div style='margin-left: 10px;'><b><font color='yellow'>$comment2</b></font></div><hr />";
							
							}
						}
						//else
							//echo "Huh?";
					
					// end display comment area
					
					
					
					
					
					echo "</div></div></div>

				  <b class='corners'>
				  <b class='corners5'></b>
				  <b class='corners4'></b>
				  <b class='corners3'></b>
				  <b class='corners2'><b></b></b>
				  <b class='corners1'><b></b></b></b>
				</div>";
				
					
					// End of right column.
					echo "</div>";
					
			

	?>
	</div>
	
	<div class='clear'>
	<?php require("bottom.php");?>
	</div>
	
	