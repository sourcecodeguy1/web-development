<?php
error_reporting(0);
session_start();
$username = $_SESSION['username'];
$userid = $_SESSION['userid'];
$site = "http://localhost/ddrguy.16mb";
?>
<?php
require("connect.php");
	$mail_query = mysqli_query($con, "SELECT m1.* FROM tbl_private_message m1 INNER JOIN (SELECT max(Id) as lastmsgId FROM tbl_private_message WHERE to_id='".$userid."' AND read_unread='0' GROUP BY msg_id) m2 ON m1.Id=m2.lastmsgId ORDER BY id DESC");
	$mail_numrows = mysqli_num_rows($mail_query);
	
    $row = mysqli_fetch_assoc($mail_query);
	
	
	
	if($mail_numrows > 0){
	echo $mail_numrows;
	}
?>