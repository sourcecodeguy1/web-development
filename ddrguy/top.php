<?php
error_reporting(0);
session_start();
$username = $_SESSION['username'];
$userid = $_SESSION['userid'];
$site = "http://localhost/ddrguy.16mb";
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css" />
<meta http-equiv="" content="5; url=http://localhost/ddrguy/index.php">
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<link rel="stylesheet" type="text/css" href="stylesheet/jquery.validate.css" />
<link rel="stylesheet" type="text/css" href="stylesheet/style.css" />
<script type="text/javascript" src="jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="jquery.form.min.js"></script>
<script type="text/javascript" src="update_mail.js"></script>
<script type="text/javascript" src="update_mail_status.js"></script>
<script type="text/javascript" src="update_mail_status_text.js"></script>
<script type='text/javascript' src='jQuery/read_msg_reply_parser.js'></script>
<script type='text/javascript' src='check_reply_msg.js'></script>


<script>
$(document).ready(function() { 
	var options = { 
			target:   'div#ack',   // target element(s) to be updated with server response 
			beforeSubmit:  beforeSubmit,  // pre-submit callback 
	
			resetForm: true        // reset the form after successful submit 
		}; 
		
	 $('#frmuploadpic').submit(function() { 
			$(this).ajaxSubmit(options);  			
			// always return false to prevent standard browser submit and page navigation 
			return false; 
		}); 
		

//function after succesful file upload (when server response)
/*function afterSuccess()
{
	$('#submit-btn').show(); //hide submit button
	$('#loading-img').hide(); //hide submit button
	$('#progressbox').delay( 1000 ).fadeOut(); //hide progress bar
	
}*/

//function to check file size before uploading.
function beforeSubmit(){
    //check whether browser fully supports all File API
   if (window.File && window.FileReader && window.FileList && window.Blob)
	{
		if( !$('#avatar').val()) //check empty input filed
		{
			$("div#ack").html("<b><font color='red'>Please select an image.</font></b>");
			return false
		}

		var fsize = $('#avatar')[0].files[0].size; //get file size
		var ftype = $('#avatar')[0].files[0].type; // get file type
		

		//allow file types 
		switch(ftype)
        {
            case 'image/png': 
			case 'image/gif': 
			case 'image/jpeg': 
			case 'image/pjpeg':
			case 'text/plain':
			case 'text/html':
			case 'application/x-zip-compressed':
			case 'application/pdf':
			case 'application/msword':
			case 'application/vnd.ms-excel':
			case 'video/mp4':
                break;
            default:
                $("div#ack").html("<b>"+ftype+"</b> Unsupported file type!");
				return false
        }
		
		//Allowed file size is less than 5 MB (1048576)
		if(fsize>5242880) 
		{
			$("div#ack").html("<b>"+bytesToSize(fsize) +"</b> Too big file! <br />File is too big, it should be less than 5 MB.");
			return false
		}
				
		/*$('#submit-btn').hide(); //hide submit button
		$('#loading-img').show(); //hide submit button
		$("#output").html("");*/
	}
	else
	{
		//Output error to older unsupported browsers that doesn't support HTML5 File API
		$("div#ack").html("Please upgrade your browser, because your current browser lacks some new features we need!");
		return false;
	}
}

//progress bar function
/*function OnProgress(event, position, total, percentComplete)
{
    //Progress bar
	$('#progressbox').show();
    $('#progressbar').width(percentComplete + '%') //update progressbar percent complete
    $('#statustxt').html(percentComplete + '%'); //update status text
    if(percentComplete>50)
        {
            $('#statustxt').css('color','#000'); //change status text to white after 50%
        }
}*/

//function to format bites bit.ly/19yoIPO
function bytesToSize(bytes) {
   var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
   if (bytes == 0) return '0 Bytes';
   var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
   return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
}

});

</script>
<title><?php echo "$title";?></title>
<?php require("functions.php"); ?>
<style type="text/css">
body
{
background-color: #194F9E;
}
#span_message
{
height: 10px;
width: 10px;
color: red;
}
</style>
</head>
<body>

	
	
	<div id="wrapper">
	<div id="header"><img src="images/DDRGUY_LOGO.png"></img>
	<div id="status"><?php require ("status.php"); ?></div>
	</div>
	
	
	<div id="nav">
	<a href="<?php echo $site?>/index">Home</a>
	<a href="<?php echo $site?>/videos">Videos</a>
	<?php
	if($username){
	echo "<a href='$site/friends'>Friends List</a>";
	
	
	
	
	
	echo "<a href='$site/mail'>Mail <span id='span_message'></span></a>";
	
	
	
	
	echo "<a href='$site/add_gallery'>Gallery</a>";
	}
	?>
	
	</div>
	
	<center><div id="result" hidden></div></center>
	<div id="content">