$("button#btnsubmitforgotpass").click(function(){
	// Create local variables.
	var username = $("#fusername");
	var erroruname = $("#fusername_error");
	var email = $("#femail");
	var email_error = $("#femail_error");
	// RegularExpression for E-mail validation.
	var a = $("#femail").val();
	var regexp = /^[a-zA-Z0-9]+[a-zA-Z0-9_.-]+[a-zA-Z0-9_­-]+@[a-zA-Z0-9]+[a-zA-Z0-9.-]+[a-zA-Z0-9­]+.[a-z]{2,4}$/;
	// Validate the form with the local variables.
	if(username.val() != "" || email.val() != ""){
		if(username.val() != ""){
			if(email.val() != ""){
				if(regexp.test(a)){
				$("div#ack").hide();
				$.post($("#frmforgotpass").attr("action"),
				$("#frmforgotpass :input").serializeArray(),
				function (data) {
				$("div#ack").html(data).fadeIn("slow");
				});
			  }
				else
				email_error.html("Please enter a valid E-mail address.");
				$("div#ack").fadeOut();
			}
			else
			email_error.html("Please enter your  email address.");
			$("div#ack").fadeOut();
		}
		else
		erroruname.html("Please enter your username.");
		$("div#ack").fadeOut();
	}
	else
		$("div#ack").html("You did not fill in the form.").fadeIn();
		
		$("#frmforgotpass").submit(function () {
        return false;
    });
});
$(document).ready(function(){
// Create local variables to obtain the user input from the form.
	var username = $("#fusername");
	var erroruname = $("td#fusername_error");
	var email = $("#femail");
	var email_error = $("td#femail_error");
	// RegularExpression for E-mail validation.
	var a = $("#femail").val();
	var regexp = /^[a-zA-Z0-9]+[a-zA-Z0-9_.-]+[a-zA-Z0-9_­-]+@[a-zA-Z0-9]+[a-zA-Z0-9.-]+[a-zA-Z0-9­]+.[a-z]{2,4}$/;
	// Add blur to the input fields.
		username.blur(UserName);
		email.blur(EMail);
	// Create functions for the blur to take effect.
	function UserName(){
				if(username.val() == ""){
					erroruname.text("Please enter your username.");
					return false;
				}
				else
				{
					erroruname.text("");
					return true;
				}
			}
			
			function EMail(){
				if(email.val() == ""){
					email_error.text("Please enter your email.");
					return false;
				}
				else
				{
					email_error.text("");
					return true;
				}
			}
			
			$("#frmforgotpass").submit(function () {
        return false;
    });
});





