//This javascript code handles the modal login form.

$("#btnforgotpass").click(function(){
	
		$("#myModal").modal("show");
	
});

$("#btnclose").click(function(){
	
		$("#myModal").modal("hide");
	
});

// Validate user input in modal form.
$("#btnresetpass").click(function(){
	
	// Create local variables.
	var email = $("#inputEmail3");
	var erroremail = $("#errorEmailMsg");
	// Validate the form with the local variables.
	
		if(email.val() != ""){
			
				$("div#ack").hide();
				$.post($("#logform").attr("action"),
				$("#logform :input").serializeArray(),
				function (data) {
				$("div#ack").html(data).fadeIn("slow");
				});
		
		}
		else
		erroremail.html("Please enter your email.").show("fade");
	
		
		$("#logform").submit(function () {
        return false;
    });

	
	
	
	
});
	
	

