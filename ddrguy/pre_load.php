<?php
session_start();
$username = $_SESSION['username'];
$userid = $_SESSION['userid'];
$site = "http://localhost/ddrguy.16mb";
//$from_id = $_GET['fromid'];
$msgid = $_GET['msgid'];	// javascript variable.
							// this is the variable I created in pre_load.js
?>

<?php
	require_once("./connect.php");
			// Check the database to see if there is a read message to be updated.
			$update_query = mysqli_query($con, "SELECT * FROM tbl_private_message WHERE to_id='".$userid."' AND msg_id='".$msgid."' AND read_unread='0' ORDER BY id DESC")or die(mysqli_error($con)); 
			$update_numrows = mysqli_num_rows($update_query);
			if($update_numrows > 0){
				$update_row = mysqli_fetch_assoc($update_query);
				$dbupdateID = $update_row['id'];
				// Update the database message as read.
					//mysqli_query($con, "UPDATE messages SET open='1' WHERE receiver_id='".$userid."' AND msg_id='".$getmsgid."'")or die(mysqli_error($con));
					mysqli_query($con, "UPDATE tbl_private_message SET read_unread='1' WHERE msg_id='".$msgid."'");
					/*echo "<script>
							window.location.href = '$site/read_msg?msgid=$msgid&fromid=$from_id'
						  </script>";*/
				// end of updating the read message table.
			}
?>

<?php
		require("connect.php");
		$query = mysqli_query($con, "SELECT * FROM tbl_private_message WHERE msg_id='".$msgid."' ORDER BY id ASC");
					$numrows = mysqli_num_rows($query);
					if($numrows > 0){
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
					echo "<center><div style='color:white;'>No reply messages were found.</div></center>";
?>