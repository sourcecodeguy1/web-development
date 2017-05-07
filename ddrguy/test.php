<?php

require 'PHPMailerAutoload.php';

$email = "juliothemanslayer@yahoo.com";

//PHPMailer Object
$mail = new PHPMailer;

//From email address and name
$mail->From = "admin@ddrguy.16mb.com";
$mail->FromName = "Admin";

//To address and name
//$mail->addAddress("juliothemanslayer@yahoo.com", "ddrguy user");
$mail->addAddress("juliothemanslayer@yahoo.com"); //Recipient name is optional

//Provide file path and name of the attachments
//$mail->addAttachment("file.txt", "File.txt");        
//$mail->addAttachment("images/DDRGUY_LOGO.png"); //Filename is optional

//Address to which recipient will reply
//$mail->addReplyTo("reply@ddrguy.16mb.com", "Reply");

//Send HTML or Plain Text email
$mail->isHTML(true);

$mail->Subject = "Testing";
$mail->Body = '<!DOCTYPE html><html><head><meta charset="UTF-8"><title>ddrguy Password Changed</title></head><body style="margin:0px; font-family:Tahoma, Geneva, sans-serif;"><div style="padding:10px; background:#194F9E; font-size:24px; color:#CCC;"><a href="http://www.ddrguy.16mb.com/index"><img src="http://www.ddrguy.16mb.com/images/DDRGUY_LOGO.png" width="36" height="30" alt="ddrguy" style="border:none; float:left;"></a>Password Changed Notification</div><div style="padding:24px; font-size:17px;">Hello <b>You name here</b>, you recently requested a forgot password.<br /><br />Your new password is below. Copy and paste it when you log in. It is urgent that
you change your password after logging in for security reasons.<br /><br /><font color="red">Password here</font><br /><br /><a href="http://www.ddrguy.16mb.com/login">Click here to login to your account now</a><br /><br /><font color="green">If you did not made this change, click the link below to contact the admin.<br /><br /></font>
<a href="http://www.ddrguy.16mb.com/contact?email='.$email.'">Contact Admin</a><br /><br /></div></body></html>';
$mail->AltBody = "This is the plain text version of the email content";

if(!$mail->send()) 
{
    echo "Mailer Error: " . $mail->ErrorInfo;
} 
else 
{
    echo "Message has been sent successfully";
}
?>