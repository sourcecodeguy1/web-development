$("button#btnlogin").click(function(){
	// Create local variables.
	var username = $("#Lusername");
	var erroruname = $("#error_user");
	var password = $("#Lpassword");
	var errorpass = $("#error_pass");
	// Validate the form with the local variables.
	if(username.val() != "" || password.val() != ""){
		if(username.val() != ""){
			if(password.val() != ""){
				$("div#ack").hide();
				$.post($("#logform").attr("action"),
				$("#logform :input").serializeArray(),
				function (data) {
				$("div#ack").html(data).fadeIn("slow");
				});
			}
			else
			errorpass.html("Please enter your  password.");
		}
		else
		erroruname.html("Please enter your username.");
	}
	else
		$("div#ack").html("You did not fill in the form.").fadeIn();
		
		$("#logform").submit(function () {
        return false;
    });
});