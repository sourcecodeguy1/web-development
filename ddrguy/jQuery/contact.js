$("button#btncontact").click(function(){
	// Create local variables.
	var name = $("#fname");
	var errorname = $("td#error_cName");
	var email = $("td#email");
	var erroremail = $("#error_cEmail");
	var message = $("#message");
	var errormessage = $("td#error_cMessage");
	// Validate the form with the local variables.
	if(name.val() != "" || email.val() != ""){
		if(name.val() != ""){
			if(email.val() != ""){
				if(message.val() != ""){
				$("div#ack").hide();
				$.post($("#frmContact").attr("action"),
				$("#frmContact :input").serializeArray(),
				function (data) {
				$("div#ack").html(data).fadeIn("slow");
				});
				
				}
				else
				errormessage.html("Please enter your message.");
			}
			else
			erroremail.html("Please enter your  email address.");
		}
		else
		errorname.html("Please enter your name.");
	}
	else
		$("div#ack").html("You did not fill in the form.").fadeIn(1000);
		
		$("#frmContact").submit(function () {
        return false;
    });
});