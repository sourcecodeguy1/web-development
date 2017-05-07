<?php $title = "ddrguy - Add Videos";?>
    <?php require("./top.php");?>
	
		<div id="full">
		<?php
		
		if ($username){
		
		//$categories = "<option value='HTML and css'>HTML and css</option>";
		$categories = "<option value='DDR or ITG'>DDR or ITG</option>
					   <option value='PHP or Programming'>PHP or Programming</option>";
				
		
		$form = "<form action='$site/addvideos' method='post'>
		<table>
		<tr>
			<td>Title:</td>
			<td><input type='text' name='title' style='width: 450px;'></td>
		</tr>
		<tr>
			<td>Description:</td>
			<td><textarea name='description' style='width: 450px; height: 100px;'></textarea></td>
		</tr>
		<tr>
			<td>Keywords:</td>
			<td><input type='text' name='keywords' style='width: 450px;'></td>
		</tr>
		<tr>
			<td>Category:</td>
			<td><select name='category' style='width: 450px;'>
				<option value=''>Select One</option>
				$categories
			</select></td>
		</tr>
		<tr>
			<td><br />Video ID:</td>
			<td><input type='text' name='videoid' maxlength='20' style='width: 450px;'><br />
			not the entire URL just the video ID!!! Just the part in RED!!! <br />
			http://www.youtube.com/watch?v=<font color='red'>SokQz065aQU</font></td>
		</tr>
		<tr>
			<td></td>
			<td><input type='submit' name='addbtn' class='button' value='Add Video'></td>
		</tr>
		</table>
		<br />
		<b>Note:</b> Your videos will be removed if they do not contain relevant content to this website.
		If your content is not relevant or is copy righted, it may be removed from this site without warning.
		</form>";
		if ($_POST['addbtn']){
			$title = $_POST['title'];
			$description = fixtext($_POST['description']);
			$keywords = $_POST['keywords'];
			$category = $_POST['category'];
			$videoid = $_POST['videoid'];
			
			if ($title){
				if ($description){
					if ($keywords){
						if ($category){
							if ($videoid){
								if (strstr($categories, "$category")){
								
								
							require("connect.php");
							
							$query = mysqli_query($con, "SELECT * FROM videos WHERE videoid='".$videoid."'");
							$numrows = mysqli_num_rows($query);
							if ($numrows == 0){
								$date = date("F d, Y");
								mysqli_query($con, "INSERT INTO videos VALUES ('', '".$userid."', '".$username."', '".$title."', '".$description."', '".$keywords."', '".$category."', '".$videoid."', '0', '0', '".$date."')");
								$query = mysqli_query($con, "SELECT * FROM videos WHERE user_id='".$userid."' AND title='".$title."' AND videoid='".$videoid."'");
								$numrows = mysqli_num_rows($query);
								if ($numrows == 1){
									$row = mysqli_fetch_assoc($query);
									$id = $row['id'];
									
									echo "Your video has been added. Click here to view it.<a href='$site/videos?id=$id'></a>";
								}
								else
									echo "<font color='red'>Your video was not added.</font> $form";
							}
							else
								echo "You can not add a video that is already in the database. $form";
							
							mysqli_close($con);
								}
								else
									echo "You did not submit a valid catergory. $form <br />$category";
									
							
							}
							else
								echo "You did not submit a videoid. $form";
						}
						else
							echo "You did not select a category. $form";
					}
					else
						echo "You did not submit any keywords. $form";
				}
				else
					echo "You did not submit a description. $form";
			}
			else
				echo "You did not submit a title. $form";
		}
		else
			echo $form;
		}
		else
			echo "<h2><font color='red'>You must be logged in to add a video.</font></h2>";
		
		?>
		
		</div>
		
	
	<?php require("./bottom.php");?>