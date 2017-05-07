<?php 
$title = "DDR Guy - Read Message"; 
?>
<?php require("./top.php"); ?>
    <div id='full'>
	
	<?php
		if($username){	// This makes sure the user is logged in.
	$id = $_GET['id'];
	$from_id = $_GET['fromid'];
	$msgid = $_GET['msgid'];
		
			require_once("./connect.php");
			// Check the database to see if there is a read message to be updated.
			$update_query = mysqli_query($con, "SELECT * FROM tbl_private_message WHERE to_id='".$userid."' AND msg_id='".$msgid."' AND read_unread='0' ORDER BY id DESC")or die(mysqli_error($con)); 
			$update_numrows = mysqli_num_rows($update_query);
			if($update_numrows > 0){
				
				// Update the database message as read.
					mysqli_query($con, "UPDATE tbl_private_message SET read_unread='1' WHERE msg_id='".$msgid."'");
					
				// end of updating the read message table.
			}
				
				//Load more messages button goes here...
					$query = mysqli_query($con, "SELECT * FROM tbl_private_message WHERE msg_id='".$msgid."' AND from_id='".$from_id."' AND to_id='".$userid."'");
					$numrows = mysqli_num_rows($query);
					while($row = mysqli_fetch_assoc($query)){
					$dbmessageID = $row['msg_id'];
					$dbFromID = $row['from_id'];
					$dbFromUser = $row['from_user'];
					}
				/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
				
					
					if($msgid == $dbmessageID){	// MAKES SURE THAT THE MESSAGE ID IS THE SAME AS THE ONE IN THE DATABASE
												// ALONG WITH THE SAME CURRENTLY LOGGED IN USER.
				
				///////////////////////////////////////////// PRE-LOADED MESSAGES GO HERE
					echo "<div id='pre_load_msg'></div>"; // PRE-LOADED MESSAGES COME FROM "pre_load.php"
			//***************************************************************************************************//
					
					/////////////////////////////////////////////////////////////////////
					
				echo "<center><div id='error_reply_msg' style='color: white;'></div></center>";
				echo "<form id='frmreply' action='$site/read_msg_reply_parser?msgid=$msgid&fromid=$from_id' method='post'>
				<center><div><textarea placeholder='Reply to ".$dbFromUser."' id='reply_box' name='replymsg' style='margin-top:15px;margin-left:60px;font-family:Bradley Hand ITC,Helvetica,sans-serif;font-size:18px;font-weight:bold;' ></textarea></div></center>
				<center><div><input id='reply_btn' type='button' name='btnsubmit' class='button' value='Reply' onclick='reply()' /></div></center>
				</form>";
					echo "<a name='message'></a>";
					
					}else{
						echo "<div style='color: white;'>Oops! The page that you're trying to reach is either invalid or broken.</div>";
					}
					
				}else{
					echo "You must be logged in to view this page.";
				}
				
	?>
	<script type='text/javascript' src='pre_load.js'></script>
	</div>
	
	<div class='clear'>
	
	<?php require("bottom.php");?>
	</div>