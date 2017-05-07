 <?php
		//Create a title for the page.
		
		$title = "Home";
	?>

<?php require_once("header/header.php");?>
  
    
	
    <div class="section">	<!--Start of carousel-->
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="carousel slide" id="carousel-632973" data-interval="5000" data-ride="carousel">
              <ol class="carousel-indicators text-danger">
                <li class="active" data-slide-to="0" data-target="#carousel-632973"></li>
                <li data-slide-to="1" data-target="#carousel-632973"></li>
                <li data-slide-to="2" data-target="#carousel-632973"></li>
                <li data-slide-to="3" data-target="#carousel-632973"></li>
                <li data-slide-to="4" data-target="#carousel-632973"></li>
                <li data-slide-to="5" data-target="#carousel-632973"></li>
              </ol>
              <div class="carousel-inner">
                <div class="item active">
                  <img alt="Carousel Bootstrap First" src="carousel_images\ddr.jpg" style="width: 1504px; height: 470px;" id="ddrgoldlogo">
                  <div class="carousel-caption"></div>
                </div>
                <div class="item">
                  <img alt="Carousel Bootstrap Second" src="carousel_images\maxresdefault.jpg" style="width: 1504px; height: 470px;" id="ddrlogo3">
                  <div class="carousel-caption"></div>
                </div>
                <div class="item">
                  <img alt="Carousel Bootstrap Third" src="carousel_images\r936332_9861575.jpg" style="width: 1504px; height: 470px;" id="ddrarrows">
                  <div class="carousel-caption"></div>
                </div>
                <div class="item">
                  <img src="carousel_images\DDR2009Logo.png" style="width: 1504px; height: 470px;" id="ddrlogo2">
                  <div class="carousel-caption"></div>
                </div>
                <div class="item">
                  <img src="carousel_images\DDR_Logo_1998-2009.png" style="width: 1504px; height: 470px;" id="ddrlogo">
                  <div class="carousel-caption"></div>
                </div>
                <div class="item">
                  <img src="carousel_images\ddrnew.jpg" style="width: 1504px; height: 470px;" id="ddrnew">
                  <div class="carousel-caption"></div>
                </div>
              </div>
              <a class="left carousel-control" href="#carousel-632973" data-slide="prev"></a>
              <a class="right carousel-control" href="#carousel-632973" data-slide="next"></a>
            </div>
          </div>
        </div>
      </div>
    </div> <!--End of carousel-->
	
    <?php require_once("footer/footer.php"); ?>