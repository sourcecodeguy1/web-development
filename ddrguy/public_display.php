<?php
echo "<title>ddrguy - Public Display</title>";
require("./top.php");
$site = "http://localhost/ddrguy.16mb";
?>
    	<?php
		if ($username){
		require("connect.php");
		$query2 = mysqli_query($con, "SELECT * FROM users WHERE public_display='1' AND id='".$userid."'");
		$numrows2 = mysqli_num_rows($query2);
		if($numrows2 == 1){
			echo "<div id='right' style='color:white;'>
						Your gallery pictures are currently set to <b><span style='color:red;'>private.</span></b>
				</div>";
		}
		else
			echo "<div id='right' style='color:white;'>
				Your gallery pictures are currently set to <b><span style='color:red;'>public.</span></b>
			</div>";
			
		$categories = "<option value='1'>Sure, why not.</option>
		<option value='0'>No way!</option>";
		
			$form = "<form action='$site/public_display' method='post'>
			<table>
			<tr>
				<td></td>
			</tr>
			<tr>
				<td><span style='color:white;'>Set pictures privately?</span></td>
				
				<td><select name='category'>
				<option value=''>Select One</option>
				$categories
			</select></td>
			</tr>
			<tr>
				<td><input type='submit' name='btnsubmit' class='button' value='Set' /></td>
			</tr>
			</table>
			</form>";
			
			if($_POST['btnsubmit']){
				$category = $_POST['category'];
				
				if (strstr($categories, "$category")){
					//echo $category;
					require("connect.php");
					
					mysqli_query($con, "UPDATE users SET public_display='".$category."' WHERE id='".$userid."'");
					
					$query = mysqli_query($con, "SELECT * FROM users WHERE public_display='".$category."' AND id='".$userid."'");
					$numrows = mysqli_num_rows($query);
					if($numrows == 1){
					$row = mysqli_fetch_assoc($query);
					$dbcategory = $row['public_display'];
						if($dbcategory == 1){
							//$msg = "<div style='color:white;'>Your gallery pictures are currently set to <b><span style='color:red;'>private<span></b></div>";
							echo "<meta http-equiv='refresh' content='0;URL=$site/public_display' />";
						}
						else if($dbcategory == 0){
						
						//$msg = "<div style='color:white'>Your gallery pictures are currently set to <b><span style='color:red;'>public</span></b></div>";
						echo "<meta http-equiv='refresh' content='0;URL=$site/public_display' />";
						
						}
							
					}
					else
						//echo "An error has occurred.";
						die(mysqli_error());
					
					mysqli_close($con);
					
				}
				else
					$msg = "Please select an option.";
			}
			
			echo $form;
			echo $msg;
			}
			else
				echo "You must be logged in.";
		?>
		<div id='clear'>
<?php require("./bottom.php");?>
		</div>