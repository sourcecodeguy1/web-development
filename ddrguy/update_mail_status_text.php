<?php
error_reporting(0);
session_start();
$username = $_SESSION['username'];
$userid = $_SESSION['userid'];
$site = "http://localhost/ddrguy.16mb";
?>

<?php
// Check if the session variables are set.
require("connect.php");
	$mail_query = mysqli_query($con, "SELECT m1.* FROM tbl_private_message m1 INNER JOIN (SELECT max(Id) as lastmsgId FROM tbl_private_message WHERE to_id='".$userid."' GROUP BY msg_id) m2 ON m1.Id=m2.lastmsgId ORDER BY id DESC");
	$mail_numrows = mysqli_num_rows($mail_query);
	
    $row = mysqli_fetch_assoc($mail_query);
	
	$dbfrom_user2 = $row['from_user'];
	$dbopen_status_mail_msg = $row['open_status_msg'];
	
	
	if($mail_numrows > 0){
		if($dbopen_status_mail_msg == 0){
			// Update the database open_status_msg to 1 = read!
			mysqli_query($con, "UPDATE tbl_private_message SET open_status_msg='1' WHERE to_id='".$userid."'");
			echo "<b><font color='orange'>$dbfrom_user2</font></b> <font color='white'>sent you a message!</font>";
			
			echo "<script type='text/javascript'>
					
					$('#result').fadeIn('slow');
					
					
				  </script>";
				  echo '<audio src="./yougotmail.mp3"  autoplay="autoplay"></audio>';
		}else{
			echo "<script type='text/javascript'>
					
					setTimeout(function(){
					$('#result').fadeOut('slow');
					}, 8000);
					
				  </script>";
		} 
	}

?>