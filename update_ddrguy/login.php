 <?php
		//Create a title for the page.
		
		$title = "Login";
	?>

<?php require_once("header/header.php");?>
  
   <br />
   <br />
   <br />
   <br />
		  <h2 class="text-center">Sign in to your account here.</h2><hr />
            <form class="form-horizontal" role="form">
              <div class="form-group">
                <div class="col-sm-2">
                  <label for="inputEmail3" class="control-label">Email</label>
                </div>
                <div class="col-sm-10">
                  <input type="email" class="form-control" id="inputEmail3" placeholder="Email or Username">
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-2">
                  <label for="inputPassword3" class="control-label">Password</label>
                </div>
                <div class="col-sm-10">
                  <input type="password" class="form-control" id="inputPassword3" placeholder="Password">
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" class="btn btn-default btn btn-primary">Sign in</button>
				  
                </div>
					 </div>
              </div>
			  
			  <!--Forgot Password and Register form groups-->
              <div class="form-group">
                <div class="col-sm-offset-5">
                  <button type="submit" class="btn btn-primary btn-link">Forgot Password?</button>
				  
                </div>
					 </div>
              <div class="form-group">
                <div class="col-sm-offset-5">
				
                  <span><b>Not a member?</b></span><button type="submit" class="btn btn-primary btn-link">Register</button>
				  
                </div>
					 </div>
            </form>
          </div>
          </div>
        </div>
      </div>
    </div> <!--End of carousel-->
	
    <?php require_once("footer/footer.php"); ?>