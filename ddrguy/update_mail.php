<?php
error_reporting(0);
session_start();
$username = $_SESSION['username'];
$userid = $_SESSION['userid'];
$site = "http://localhost/ddrguy.16mb";
?>
<?php
if($username){
require("connect.php");
	$mail_query = mysqli_query($con, "SELECT m1.* FROM tbl_private_message m1 INNER JOIN (SELECT max(Id) as lastmsgId FROM tbl_private_message WHERE to_id='".$userid."' GROUP BY msg_id) m2 ON m1.Id=m2.lastmsgId ORDER BY id DESC");
	$mail_numrows = mysqli_num_rows($mail_query);
	
	if($mail_numrows > 0){
		while($row = mysqli_fetch_assoc($mail_query)){
		$dbid2 = $row['id'];
		$dbmessage2 = $row['message'];
		$dbfrom_user2 = $row['from_user'];
		$dbfrom_id2 = $row['from_id'];
		$dbfrom_image2 = $row['from_image'];
		$dbread_unread2 = $row['read_unread'];
		$dbmsg_id2 = $row['msg_id'];
		
		
		if($dbread_unread2 == 0){
			if (strlen($dbmessage2) >= 50)
			$dbmessage2 = substr($dbmessage2, 0, 50) ."...";
			echo "<ul style='background-color: white; width:700px; height:70px;' >
			<a href='$site/profile?id=$dbfrom_id2'><img style='border: 2px solid #E1E3E2; border-radius:64px;' src='avatars/$dbfrom_image2' width='64px' height='64px'></img></a><div style='position:relative;top:-50px;right:-70px; '><b>$dbfrom_user2</b></div>
			<div style='position:relative;top:-45px;right:-70px;'><a id='msg' style='color:#7E807F;' href='$site/read_msg?msgid=$dbmsg_id2&fromid=$dbfrom_id2#message'>$dbmessage2</a></div></ul>";
			}else{
				if (strlen($dbmessage2) >= 50)
			$dbmessage2 = substr($dbmessage2, 0, 50) ."...";
			echo "<ul style='background-color: silver; width:700px; height:70px;' >
			<a href='$site/profile?id=$dbfrom_id2'><img style='border: 2px solid #E1E3E2; border-radius:64px;' src='avatars/$dbfrom_image2' width='64px' height='64px'></img></a><div style='position:relative;top:-50px;right:-70px; '><b>$dbfrom_user2</b></div>
			<div style='position:relative;top:-45px;right:-70px;'><a id='msg' style='color:#7E807F;' href='$site/read_msg?msgid=$dbmsg_id2&fromid=$dbfrom_id2#message'>$dbmessage2</a></div></ul>";
			}
			
			
		}//end while loop.
	}
	else
		echo "<div><b>You have no mail.</b></div>";
		
}else
	echo "<font color='white'>You must be logged in to view this page.</font>"

?>