<?php
error_reporting(0);
session_start();
$username = $_SESSION['username'];
$userid = $_SESSION['userid'];
echo "<title>ddrguy - Process_picture</title>";
$site = "http://www.ddrguy.16mb.com";

?>
<?php

if(isset($_FILES["avatar"]) && $_FILES["avatar"]["error"]== UPLOAD_ERR_OK)
{

    ############ Edit settings ##############
	$UploadDirectory	= './avatars/'; //specify upload directory ends with / (slash)
	##########################################
	
	/*
	Note : You will run into errors or blank page if "memory_limit" or "upload_max_filesize" is set to low in "php.ini". 
	Open "php.ini" file, and search for "memory_limit" or "upload_max_filesize" limit 
	and set them adequately, also check "post_max_size".
	*/
	
	//check if this is an ajax request
	if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
		die();
	}
	
	
	//Is file size is less than allowed size.
	if ($_FILES["avatar"]["size"] > 5242880) {
		die("File size is too big!");
	}
	
	//allowed file type Server side check
	switch(strtolower($_FILES['avatar']['type']))
		{
			//allowed file types
            case 'image/png': 
			case 'image/gif': 
			case 'image/jpeg': 
			case 'image/pjpeg':
			case 'text/plain':
			case 'text/html': //html file
			case 'application/x-zip-compressed':
			case 'application/pdf':
			case 'application/msword':
			case 'application/vnd.ms-excel':
			case 'video/mp4':
				break;
			default:
				die('Unsupported File!'); //output error
	}
	
	$File_Name          = strtolower($_FILES['avatar']['name']);
	$tmpname			= $_FILES['avatar']['tmp_name'];
	$File_Ext           = substr($File_Name, strrpos($File_Name, '.')); //get file extention
	$Random_Number      = rand(0, 9999999999); //Random number to be added to name.
	$NewFileName 		= $username.$File_Ext; //new file name
	
	if(move_uploaded_file($tmpname, $UploadDirectory.$NewFileName ))
	   {
		require("connect.php");
		//mysqli_query($con, "INSERT INTO avatars VALUES ('', '$username', '$NewFileName') ");
		
		mysqli_query($con, "UPDATE users SET avatar='".$NewFileName."' WHERE id='".$userid."'");
		echo "<script type='text/javascript'>
							 $('#frmuploadpic').fadeOut(1000);
								window.location.replace('$site/profile?id=$userid');
								
							</script>";
		die('Success! File Uploaded.');
		
		
	}else{
		die('error uploading File!');
	}
	
}
else
{
	die('Something wrong with upload! Is "upload_max_filesize" set correctly?');
}