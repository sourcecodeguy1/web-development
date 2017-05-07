<?php 
session_start();
$username = $_SESSION['username'];
$userid = $_SESSION['userid'];
require("./functions.php");
$site = "http://localhost/ddrguy.16mb";
$from_id = $_GET['fromid'];
$msgid = $_GET['msgid'];
		 
			
		
					
				
				$reply_message = fixtext($_POST['replymsg']);
				if($reply_message){
                    date_default_timezone_set("America/Los_Angeles");
                    $time = date("h:i:sa");
					//Insert into the database.
					require("connect.php");
					///////////This is for the currently logged in user/////////////////
					$user_query = mysqli_query($con, "SELECT * FROM users WHERE id='".$userid."'");
					$user_row = mysqli_fetch_assoc($user_query);
					$dbuser_id = $user_row['id'];
					$dbuser_avatar = $user_row['avatar'];
					$dbuser_username = $user_row['username'];
					///////////This is for the user that we're replying to//////////////
					$user_query1 = mysqli_query($con, "SELECT * FROM users WHERE id='".$from_id."'");
					$user_row1 = mysqli_fetch_assoc($user_query1);
					$dbuser_id1 = $user_row1['id'];
					$dbuser_avatar1 = $user_row1['avatar'];
					$dbuser_username1 = $user_row1['username'];
					$date = date("F d, Y");
					mysqli_query($con, 'SET NAMES utf8');
					mysqli_query($con, "INSERT INTO tbl_private_message VALUES ('', '$msgid', '$dbuser_id1', '$dbuser_username1', '$dbuser_avatar1', '$dbuser_id', '$dbuser_username', '$dbuser_avatar', '$reply_message', '0', '0', '$date', '$time') ")or die(mysqli_error($con));
					
					//Check to see if the message was ineed inserted in the database.
					
					$query = mysqli_query($con, "SELECT * FROM tbl_private_message WHERE msg_id='".$msgid."' ORDER BY id ASC");
					$numrows = mysqli_num_rows($query);
					
					while($row = mysqli_fetch_assoc($query)){
					$dbid = $row['id'];
					$dbtouser = $row['to_user'];
					$dbmessage = nl2br($row['message']);
					$dbfrom_user = $row['from_user'];
					$dbfrom_id = $row['from_id'];
					$dbfrom_image = $row['from_image'];
					$dbread_unread = $row['read_unread'];
					$dbto_image = $row['image'];
					$dbto_id = $row['to_id'];
					$dbDate = $row['date'];
					$dbTime = $row['time'];
					
					
					
					echo "<div style='float:left;margin-top:50px;'>
				<a href='$site/profile?id=$dbfrom_id'><img style='border: 2px solid #E1E3E2; border-radius:64px;' src='avatars/$dbfrom_image' width='64px' height='64px'></img></a>
				</div>
				
				<div style='float:left;margin-top:40px;margin-left:30px;width:740px;height:99px;background-color:white;border:1px solid;overflow:auto;display:block'>
				<div style='margin-left:5px;margin-top:2px;font-family:Bradley Hand ITC,Helvetica,sans-serif;font-size:18px;'><b>$dbmessage</b><p><font color='blue'><b>$dbDate&nbsp$dbTime</b></font></p></div>
				</div>";
					} // end of while loop.
				}
				else
					echo "<center><div style='color:white;'>Please enter a message. From PHP.</div></center>";
			
				
	?>