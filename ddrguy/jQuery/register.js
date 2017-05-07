$("button#btnregister").click(function () {
		
		// Create local variables to obtain form information.
		var firstname = $("#fname");
		var error_name = $("td#error_fname");
		var lastname = $("#lname");
		var error_lname = $("td#error_lname");
		var username = $("#username");
		var error_uname = $("td#error_username");
		var email = $("#email");
		var error_email = $("td#error_email");
		var password = $("#pass1");
		var error_password = $("td#error_password");
		var repassword = $("#pass2");
		var error_conpass = $("td#error_confirmpass");
		// RegularExpression for E-mail validation.
		var a = $("#email").val();
        var regexp = /^[a-zA-Z0-9]+[a-zA-Z0-9_.-]+[a-zA-Z0-9_­-]+@[a-zA-Z0-9]+[a-zA-Z0-9.-]+[a-zA-Z0-9­]+.[a-z]{2,4}$/;
		// Validate form input with created local variables
		if(firstname.val() != "" || lastname.val() != "" || username.val() != "" || email.val() != "" || password.val() != "" || repassword.val() != ""){
			if(firstname.val() != ""){
				if(lastname.val() != ""){
					if(username.val() != ""){
						if(username.val().length >= 5){
							if(email.val() != ""){
								if(regexp.test(a)){
									if(password.val() != ""){
										if(password.val().length >= 8){
											if(repassword.val() != ""){
												if(password.val() == repassword.val()){
											
													$("div#ack").hide();
													$.post($("#regform").attr("action"),
													$("#regform :input").serializeArray(),
													function (data) {
													error_email.fadeOut();
													$("div#ack").html(data).fadeIn("slow");
													});
												}
												else
												$(error_conpass).html("Your passwords did not match.");
												$("div#ack").fadeOut();
											}
											else
												$(error_conpass).html("Please enter your confirm password.");
												$("div#ack").fadeOut();
										}
										else
										$(error_password).html("Your password must be at least 8 characters.");
										$("div#ack").fadeOut();
									}
									else
										$(error_password).html("Please enter your password.");
										$("div#ack").fadeOut();
									
								}
								else
								$(error_email).html("Please enter a valid E-mail address.");
								$("div#ack").fadeOut();
								error_email.fadeIn();
							}
							else
								$(error_email).html("Please enter your email.");
								$("div#ack").fadeOut();
							
						}
						else
						$(error_uname).html("Your username must be at least 5 characters long.");
					}
					else
						$(error_uname).html("Please enter your username.");
						$("div#ack").fadeOut();
				}
				else
					$(error_lname).html("Please enter your last name.");
					$("div#ack").fadeOut();
			}
			else
				$(error_name).html("Please enter your name.");
				$("div#ack").fadeOut();
		}
		else
			$("div#ack").html("Please fill in the form.").fadeIn(1000);

    $("#regform").submit(function () {
        return false;
    });

});
$(document).ready(function(){
// Create local variables to obtain form information.
		var firstname = $("#fname");
		var error_name = $("td#error_fname");
		var lastname = $("#lname");
		var error_lname = $("td#error_lname");
		var username = $("#username");
		var error_uname = $("td#error_username");
		var email = $("#email");
		var error_email = $("td#error_email");
		var password = $("#pass1");
		var error_password = $("td#error_password");
		var repassword = $("#pass2");
		var error_conpass = $("td#error_confirmpass");
		// RegularExpression for E-mail validation.
		var a = $("#email").val();
        var regexp = /^[a-zA-Z0-9]+[a-zA-Z0-9_.-]+[a-zA-Z0-9_­-]+@[a-zA-Z0-9]+[a-zA-Z0-9.-]+[a-zA-Z0-9­]+.[a-z]{2,4}$/;
		// Add blur to the input fields.
		firstname.blur(FirstName);
		lastname.blur(LastName);
		username.blur(UserName);
		email.blur(EMail);
		password.blur(Password);
		repassword.blur(ConfirmPassword);
		// Create functions for blur function to work.
			function FirstName(){
				if(firstname.val() == ""){
					error_name.text("Please enter your name.");
					return false;
				}
				else
				{
					error_name.text("");
					return true;
				}
			}
				function LastName(){
				if(lastname.val() == ""){
					error_lname.text("Please enter your last name.");
					return false;
				}
				else
				{
					error_lname.text("");
					return true;
				}
			}
				
				function UserName(){
				if(username.val() == ""){
					error_uname.text("Please enter your username.");
					return false;
				}
				else if(username.val().length < 5){
					error_uname.text("Your username must be at least 5 characters.");
					return false;
				}
				else
				{
					error_uname.text("");
					return true;
				}
			}
			
				function EMail(){
				if(email.val() == ""){
					error_email.text("Please enter your email.");
					return false;
				}
				else
				{
					error_email.text("");
					return true;
				}
			}
			
			function Password(){
				if(password.val() == ""){
					error_password.text("Please enter your password.");
					return false;
				}
				else if(password.val().length < 8){
					error_password.text("Your password must be at least 8 characters.");
					return false;
				}
				else
				{
					error_password.text("");
					return true;
				}
			}
			
			function ConfirmPassword(){
				if(repassword.val() == ""){
					error_conpass.text("Please enter your confirm password.");
					return false;
				}
				else if(password.val() != repassword.val()){
					error_conpass.text("Your passwords did not match.");
					return false;
				}
				else
				{
					error_conpass.text("");
					return true;
				}
			}
});