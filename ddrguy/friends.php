    <?php $title = "DDR Guy - Friends List";?>
	<?php require("top.php");?>
		<?php //<div id="full">Content here.</div> ?>
		
		<div id="right"></div>
		
		
		
		<div id="left">
			
		<?php
			
			if($username){
				require("connect.php");
				$query = mysqli_query($con, "SELECT user_one, user_two FROM friends_list WHERE user_one='$userid' OR user_two='$userid'");
				$numrows = mysqli_num_rows($query);
				if($numrows > 0){
				echo "<center><h2 style='text-shadow: 5px 5px 5px #FF0000; font-family:Bradley Hand ITC; color:black;'><b>Your Friends</b></h2><hr /></center>";
				while($row = mysqli_fetch_assoc($query)){
					$user_one = $row['user_one'];
					$user_two = $row['user_two'];
					if($user_one == $userid){
						$user = $user_two;
					} else {
						$user = $user_one;
					}
					$user_query = mysqli_query($con, "SELECT * FROM users WHERE id='$user'");
					$numrows = mysqli_num_rows($user_query);
					if($numrows == 1){
					$users_row = mysqli_fetch_assoc($user_query);
					$friends = $users_row['username'];
					
					echo "<center><a href='$site/profile?id=$user' style='font-size: 22px; font-family:Bradley Hand ITC; color: black'><div style='margin-top: 10px;'><b>$friends</b></a></div></center>";
					
					}
					else
						echo "No user found.";
				}
				
				}
				else
					echo "<center><h2 style='text-shadow: 5px 5px 5px #FF0000; font-family:Bradley Hand ITC;'>Your Friends</h2><hr /></center><br />
					<center><b>You currently have no friends</b></center>";
					
			}
			else
				echo "You must be logged in.";
		?>
		</div>
	
	<div class='clear'>
	
	<?php require("bottom.php");?>
	</div>