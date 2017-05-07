<?php 
$title = "DDR Guy - Add Music"; 
?>
<?php require("./top.php"); ?>
	<div id='full'>
	
	<?php
		$form = "<form id='upload_form' method='post' enctype='multipart/form-data'>
				 <table>
				 <tr>
					<td><b>Add Music:</b></td>
					<td><input type='file' name='music' id='music' /></td>
				 </tr>
				 <tr>
					<td></td>
					<td><input type='button' name='button' value='Upload' onclick='uploadFile()' /></td>
				 </tr>
				 </table>
				 <div id='progress_div'><div id='progress_bar'></div></div>
				 </form>";
				 
				 echo "<script type='text/javascript' src='jQuery/progressbar.js'></script>";
				 echo "<div id='progress_status'></div>";
				 echo $form;
				 echo "<a href='$site/music?id=$userid'>Music</a>";
									
	?>
	
	</div>
	
	<div class='clear'>
	
	<?php require("bottom.php");?>
	</div>