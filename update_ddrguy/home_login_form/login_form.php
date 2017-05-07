	<?php
		// Hide scripting errors.
		error_reporting(0);
	?>
	
	
	
	<?php
		
		// Create a local variable to hold the basename of the php file we're searching for. 
		$pageName = basename($_SERVER['PHP_SELF']);
		
		if($pageName != "login.php"){
			// Display the login form status.
			$login_form = '<div class="col-md-4">
                  
                  </div>
                  <div class="col-md-4">
                    <form class="form-horizontal" role="form">
                      <div class="form-group">
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputEmail3" placeholder="Email or username">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-10">
                          <input type="password" class="form-control" id="inputPassword3" placeholder="Password">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-2">
                          <button type="submit" class="btn btn-primary">Sign in</button>
                        </div>
                      <div class="form-group">
                        <div class=" col-sm-2">
						 <!-- Trigger the modal with a button -->
                          <button id="btnforgotpass" type="button" class="btn btn-primary btn-link">Forgot Password?</button>
						  
					
		  <!-- Login Modal -->
		  <div class="container">
			 
			 

			  <!-- Modal -->
			  <div class="modal fade" id="myModal" role="dialog">
				<div class="modal-dialog">
				
				  <!-- Modal content-->
				  <div class="modal-content">
					<div class="modal-header">
					  <button type="button" class="close" data-dismiss="modal">&times;</button>
					  <h4 class="modal-title">Forgot Password</h4><br />
					  <p>We\'ll send you and email with details on how to reset your password.</p>
					</div>
					
					<!--This is the content area that hold the form controls-->
					<div class="modal-body">
					<form id="logform" class="form-horizontal" role="form" action="modalsubmit.php" method="post">
					
					  <div class="form-group">
                        <div class="col-sm-10">
						<div id="ack"></div>
                          <input type="email" class="form-control" id="inputEmail3" placeholder="Enter your email address">
						  
                        </div>
                      </div>
					   <div class="form-group">
                        <div class="col-sm-10">
                          <div id="errorEmailMsg" class="alert alert-danger collapse"></div>
						  
                        </div>
                      </div>
					</div>
					
					
					
					<div class="modal-footer">
					  <button id="btnresetpass" type="button" class="btn btn-primary pull-left">Reset Password</button>
					  <button id="btnclose" type="button" class="btn btn-default">Close</button>
					</div>
					</form>
					 
				  </div>
				  
				</div>
			  </div>
			  
			</div>

		  <!-- End Modal -->
						  
						  
                        </div>
                      </div>
                      <div class="form-group">
                        <div class=" col-sm-8 col-sm-offset-1">
                          <span><b>Not a member?</b></span><button type="submit" class="btn btn-primary btn-link">Register</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> <!--End of login form-->';
			echo $login_form;
		}else{
			// Do not display the login form status.
			echo "";
		}
	
		
	
	?>
	
	
	
    <script type="text/javascript" src="javascript_files/login_form/login_form.js"></script>

	
	
	
	