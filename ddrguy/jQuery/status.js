$("button#btnstatus").click(function(){
	// Create local variables.
	var username = $("#stuser");
	var erroruname = $("#stuser_error");
	var password = $("#stpass");
	var errorpass = $("#stpass_error");
	// Validate the form with the local variables.
	if(username.val() != "" || password.val() != ""){
		if(username.val() != ""){
			if(password.val() != ""){
				$("div#status_notification").hide();
				$.post($("#frmstatus").attr("action"),
				$("#frmstatus :input").serializeArray(),
				function (data) {
				$("div#status_notification").html(data).fadeIn("slow");
				});
			}
			else
			errorpass.html("Please enter your  password.");
			$("div#status_notification").fadeOut();
		}
		else
		erroruname.html("Please enter your username.");
		$("div#status_notification").fadeOut();
	}
	else
		$("div#status_notification").html("You did not fill in the form.").fadeIn();
		
		$("#frmstatus").submit(function () {
        return false;
    });
});
$(document).ready(function(){
// Create local variables to obtain form information.
		var stusername = $("#stuser");
		var error_uname = $("td#stuser_error");
		var password = $("#stpass");
		var error_password = $("td#stpass_error");
		// Add blur to the input fields.
		stusername.blur(StatusUname);
		password.blur(StatusPassword);
		// Create functions for blur function to work.
			function StatusUname(){
				if(stusername.val() == ""){
					error_uname.text("Please enter your username.");
					return false;
				}
				else
				{
					error_uname.text("");
					return true;
				}
			}
			
			function StatusPassword(){
				if(password.val() == ""){
					error_password.text("Please enter your password.");
					return false;
				}
				else
				{
					error_password.text("");
					return true;
				}
			}
				$("#frmstatus").submit(function () {
				return false;
    });
});