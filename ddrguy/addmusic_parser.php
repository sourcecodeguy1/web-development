<?php
error_reporting(0);
session_start();
$username = $_SESSION['username'];
$userid = $_SESSION['userid'];
echo "<title>ddrguy - Add Music</title>";
$site = "http://www.ddrguy.16mb.com";
require("functions.php");
?>
<?php
//$allowedext = array("mp3");
					
					$name = $_FILES['music']['name'];
					$fileType = $_FILES["music"]["type"];
					$size = $_FILES["music"]["size"];
					$tmpname = $_FILES['music']['tmp_name'];
					$fileErrorMsg = $_FILES["music"]["error"];
					$ext = substr($name, strrpos($name, '.'));
					//$new_file_name = $name.$ext; 
					 
					if($name){
						if ($fileType != 'audio/mpeg' && $fileType != 'audio/mpeg3' && $fileType != 'audio/mp3' && $fileType != 'audio/x-mpeg' && $fileType != 'audio/x-mp3' && $fileType != 'audio/x-mpeg3' && $fileType != 'audio/x-mpg' && $fileType != 'audio/x-mpegaudio' && $fileType != 'audio/x-mpeg-3') {
							echo "<font color='white'>Error! Your file is not an mp3 file.</font>";
						} else if ($size > '10485760') {
							echo "<font color='white'>File should not be more than 10mb</font>";
						} else {
							//$error = "Yay! <br />";
							
							$date = date("F d, Y");
							
							$music_dir = "users_music";
							
							if(is_dir($music_dir)==true){
								if(!file_exists("$music_dir/".$name)){
									
								move_uploaded_file($tmpname,"$music_dir/".$name);
								
								require("connect.php");
								mysqli_query($con, "INSERT INTO tbl_music VALUES ('', '$userid', '$username', '$name', '$date')");
								
								$query = mysqli_query($con, "SELECT * FROM tbl_music WHERE userid='".$userid."'");
								$numrows = mysqli_num_rows($query);
								if($numrows > 0){
									echo "<font color='white'>Success!</font>";
									
								}
								else
									echo "<font color='white'>An error has occurred. Your file was not uploaded.</font>";
								
								
							
								}
								else{
								echo "<font color='white'>This file already exist.</font>";
								}
							}
							else
								mkdir("$music_dir", 0700);
			}
							
					}
					else
						echo "<font color='white'>You didn't choose anything to upload.</font>";
?>