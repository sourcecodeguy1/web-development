	<?php $title = "DDR Guy - Home";
	?>
	<?php require("top.php");?>
		<?php //<div id="full">Content here.</div> ?>
		
		<div id="left">
			<div class='box'>
			<div class='top'>Welcome to DDRGUY</div>
			<div class='bottom'>

			<h3 style="color: white;">Join the Dance Dance Revolution and In The Groove community. Upload pictures, videos, and chat with other DDR or ITG players.</h3>
             
			
			</div></div>
		
		</div>
		
		<div id="right">
			
		<?php
			require("connect.php");
			
			$query = mysqli_query($con, "SELECT * FROM users WHERE locked='0' AND active='1' ORDER BY id DESC LIMIT 5");
			$numrows = mysqli_num_rows($query);
			if ($numrows > 0){
				echo "<div class='box'>
					  <div class='top'>Latest Registerd Users. </div>
					  <div class='bottom'>";
				while($row = mysqli_fetch_assoc($query)){
					$id = $row['id'];
					$user = $row['username'];
					$avatar = $row['avatar'];
					
					
					//$avatarname = $user.$ext;
					// Display the latest users
					echo "<a href='$site/profile?id=$id'>$user</a><br />";
					//echo "<a href='$site/profile.php?id=$id'><img src='avatars/$avatar' width='64px' height='64px'></img></a><br />";
				}
				echo "</div></div>";
			}
			else
				echo "No users were found.";
			
			mysqli_close($con);
		?>
		</div>
	
	<div class='clear'>
	
	<?php require("bottom.php");?>
	</div>