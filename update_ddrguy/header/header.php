<!DOCTYPE html>
<html>
<head>
    <title><?php echo $title;?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	
	<script type="text/javascript" src="../javascript_files/jsminfiles/jquery.min.js"></script>
    <script type="text/javascript" src="../javascript_files/jsminfiles/bootstrap.min.js"></script>
	
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://pingendo.github.io/pingendo-bootstrap/themes/default/bootstrap.css" rel="stylesheet" type="text/css">
  </head>
  <body>
  <div class="section"><!--Start of login form-->
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section">
              <div class="container">
                <div class="row">
                  <div class="col-md-4">
                    <a href="index.php"><img src="header_logo/DDRGUY_LOGO.png" class="img-responsive"></a>
                  </div>
  <?php require_once("home_login_form/login_form.php");?>