<?php 
$title = "DDR Guy - Music"; 
?>
<?php require("./top.php"); ?>
	<div id='full'>
	
	<?php
		$getid = $_GET['id'];
	
	if (!$getid)
		$getid = "1";
	
		require("connect.php");
		$query = mysqli_query($con, "SELECT * FROM tbl_music WHERE userid='".$getid."'")or die(mysqli_error($con)); // Query this for the table of the users instead of tbl_music :) !!
		$numrows = mysqli_num_rows($query);
		if($numrows > 0){
		while($row = mysqli_fetch_assoc($query)){
			$dbmusic = $row['music_name'];
			$dbmusic_name = $row['username'];
			echo "<div><b>$dbmusic</b></div><br />";
			
			echo "<audio controls>
				  <source src='users_music/$dbmusic' type='audio/mpeg'>
				  <source src='users_music/$dbmusic' type='audio/mpeg'>
				Your browser does not support the audio element.<hr />
				</audio>";
				echo "<hr />";
		} // End of while loop.
		
		}
		else
			if($userid == $getid){
			echo "<font color='white'> You haven't uploaded any music.</font> <a href='$site/addmusic'>Upload here</a>";
			}
			else
				echo "<font color='white'> This user hasn't uploaded any music.</font>";
	?>
	
	</div>
	
	<div class='clear'>
	
	<?php require("bottom.php");?>
	</div>