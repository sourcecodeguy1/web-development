<?php $title = "DDR Guy - Add Gallery Pictures"; ?>
<?php require("./top.php"); ?>

    <div id='full'>
	<?php
		if ($username){
		$getid = $_GET['id'];
		if (!$getid)
			$getid = "1";
			
		if ($_POST['submitbtn']){
			require("connect.php");
			
			foreach($_FILES['gallery']['tmp_name'] as $key => $tmpname ){
	
			$name = $key.$_FILES['gallery']['name'][$key];
			$size =$_FILES['gallery']['size'][$key];
			$tmpname =$_FILES['gallery']['tmp_name'][$key];
			$type=$_FILES['gallery']['type'][$key];
			$ext = substr($name, strrpos($name, '.'));
			if ($name){
				if (strstr($type, "image")){
					
					//$name = $username.$ext;
					
					
					
					$date = date("F d, Y");
					
					$limit_per_pic = 3;
					
						
						
					// Set user's avatar in the database
					$query = "INSERT INTO gallery (`user_id`,`user_name`,`picture`,`date`) VALUES ('$userid', '$username', '$name', '$date');";
					
					$desired_dir = "users_gallery";
					
					 if(is_dir($desired_dir)==false){
						mkdir("$desired_dir", 0700);		// Create directory if it does not exist
						}
						if(is_dir("$desired_dir/".$name)==false){
							move_uploaded_file($tmpname,"$desired_dir/".$name);
							
						}else{									// rename the file if another one exist
							$new_dir="$desired_dir/".$name.time();
							 rename($tmpname,$new_dir);	
							 
							}
							mysqli_query($con, $query);
					
					
					        mysqli_close($con);
						
						//echo "Your picture was successfully uploaded! <br />";
						//echo dirname( __FILE__ );
						//echo "<img src='$desired_dir/$name' style='padding-left: 50px;' height='128' width='128'></img>";
						//header("location: $site/gallery?id=$userid");
						echo "<b>Redirecting...</b>";
						 require("bottom.php");
						echo "<script type='text/javascript'>
								window.location.replace('$site/gallery?id=$userid');
							  </script>";
					
						
				}
				else
					echo "The item you have selected is not an image.";
			}
			else
				echo "You didn't upload anything.";
				
			}	
				
		}
	
		
		$form = "<form action='$site/add_gallery' method='post' enctype='multipart/form-data'>
		<table>
		<tr>
			<td>Picture:</td>
			<td><input type='file' name='gallery[]' multiple /></td>
		</tr>
		<tr>
			<td></td>
			<td><input type='submit' name='submitbtn' value='Upload!' /></td>
		</tr>
		</table>
		</form>";
		
		echo $form;
		
		}
		else
			echo "You must be logged in.";
	?>
	</div>
	
	<div class='clear'>
	
	<?php require("bottom.php");?>
	</div>