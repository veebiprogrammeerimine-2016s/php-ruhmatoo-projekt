<?php 
require("../../config.php");
require("functions.php");

$tyreFittings = getAllTyreFittings();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Rehvivahetus Online</title>
    <!-- bootstrap css -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css" integrity="sha384-y3tfxAZXuh4HwSYylfB+J125MxIs6mR5FOHamPBG064zB+AFeWH94NdvaCBm8qnd" crossorigin="anonymous">
        <link rel="stylesheet" href="css/style.css">
  </head>
  <body id="home" data-spy="scroll" data-targer=".navbar" data-offset="100">
  	<!-- navbar -->
    <nav class="navbar navbar-fixed-top navbar-dark bg-primary">
    <div class="container">
  <ul class="nav navbar-nav">
    <li class="nav-item">
      <a class="nav-link" href="#home">Esileht <span class="sr-only">(current)</span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#about">Meist</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#tirechanger">Rehvitöökoda</a>
    </li>
    <!--<li class="nav-item">
      <a class="nav-link" href="#schedule">Schedule</a>
    </li>
    -->
  </ul>
  <a class="navbar-brand pull-sm-right m-r-0 hidden-xs-down" href="http://www.tlu.ee">Presented by TLÜ team</a>
  </div>
</nav>
    <!-- /navbar-->
    <!-- jumbotron -->
    <div class="jumbotron jumbotron-fluid bg-info">
  <div class="container text-sm-center p-t-3">
    <h1 class="display-2">Rehvivahetus Online</h1>
    <p class="lead">Me tahame, et Sinu rehvid oleksid kindlalt auto all</p>
    <div class="btn-group m-t-2" role="group" aria-label="Basic example">
  <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#register">Liitu Meiega</button>
  <a class="btn btn-secondary btn-lg" href="#tirechanger" >Tutvu Partneritega</a>

</div>
  </div>
  
</div>
	
    <!-- /jumbotron-->
      <div class="container p-t-2">
      <!-- about -->
      <div id="about" class="row">
        
        <div class="col-lg-4 col-lg-push-4">
          <h3 class="m-b-2">Meie Partnerid</h3>
            <p>Meie valitud ja kõrgelt hinnatud partnerid on kahtlemata oma ala professionaalid ning pakuvad meile ning ka teile ainult parimat ja kvaliteetsemat teenust.</p>
            
        </div>
        <div class="col-lg-4 col-lg-pull-4">
          <h3 class="m-b-2">Rehvivahetus Online</h3>
            <p>Esimene keskkond, kes pakub broneerida rehvivahetus erinevates kohtades!</p>
            <p>Pakume klientidele kõiki rehvivahetusega seotuid teenuseid.</p>
        </div>
        <div class="col-lg-4">
          <h3 class="m-b-2">Miks valida meid?</h3>
           <div class="list-group">
  <a class="list-group-item"><strong>Asukoht</strong>: Kõik on ühes kohas</a>
  <a class="list-group-item"><strong>Hind</strong>: Vali endale parem hind </a>
  <a class="list-group-item"><strong>Partnerid</strong>: Ainult paremad rehvitöökodat</a>
  <a class="list-group-item"><strong>Järjekord</strong>: Sa ei pea ootama. Vali endale sobiv aeg ja koht</a>
</div>
        </div>
      </div> <!-- /about -->
      
      <!-- speakers -->
      <div class ="container">
      <h1 id="tirechanger" class="display-4 text-xs-center m-y-3 text-muted">Rehvitöökoda</h1>
         <div class="row">
         
          	<?php
			$html = "";
			foreach($tyreFittings as $tyreFitting)
			{
				$html .= "<div class='col-md-6 col-lg-4'>";
				$html .= "<div class='card'>";
                $html .= "<img class='card-img-top img-fluid' src='".$tyreFitting->logo."' alt='Partneri logo'>";
                $html .= "<div class='card-block'>";
                $html .= "<h4 class='card-title'>".$tyreFitting->name."</h4>";
                $html .= "<p class='card-text'>".$tyreFitting->description."...</p>";
                $html .= "<a href='#' class='btn btn-primary'>Tutvu lähemalt</a>";
                $html .= "</div>";
            	$html .= "</div>";
				$html .= "</div>";
			
			}
			
            echo $html;
			?>
          	
                 
         
        
          
        </div><!-- /speakers -->
      </div>
  
      <!-- callout button-->
      <button type="button" class="btn btn-info-outline btn-lg center-block m-y-3" data-toggle="modal" data-target="#register">Ära oota. Hakka Partneriks!</button>
      <!-- /callout button-->
      <!-- signup form -->
<hr>
<div class="row p-y-2 text-muted ">
  <div class="col-md-6 col-xl-5">
    <p><strong>Kontaktid</strong></p>
    <p>Võtke meiega ühendust</p>
     <img src="http://www.freeiconspng.com/uploads/email-icon-23.png" style="width:20px;heigth:20px;"> info@rehvivahetus.ee
  </div>
  <div class="col-md-6 col-xl-5 col-xl-offset-2">
    <p><strong>Liitu meie uudiskirjaga!</strong></p>
    <div class="input-group">
      <input type="text" class="form-control" placeholder="Email">
      <span class="input-group-btn">
        <button class="btn btn-primary" type="button">Telli</button>
      </span>
    </div>
  </div>
</div>
<hr><!-- /signup form -->
     <!-- footer -->
     <div class="row p-y-1">
  <div class="col-md-7">
	<ul class="nav nav-inline">
      <li class="nav-item">
        <a class="nav-link active" href="http://www.facebook.com">Facebook</a>
      </li>
      
</ul>
  </div>
  <div class="col-md-5 text-md-right">
    <small>&copy; 2016 TLÜ team</small>
  </div>
</div>
     <!-- /footer-->
    </div>  <!-- container -->
    <!-- ====================
    FORM MODAL
    ======================== -->
            <div id="register" class="modal fade">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Register</h4>
              </div>
              <div class="modal-body">
                <p>Form goes here..</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->	
    <!-- jQuery first, then bootstrap js -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/js/bootstrap.min.js" integrity="sha384-vZ2WRJMwsjRMW/8U7i6PWi6AlO1L79snBrmgiDpgIWJ82z8eA5lenwvxbMV1PAh7" crossorigin="anonymous">

        </script>
        <script> <!--SMOOTH -->
		        $(function() {
  $('a[href*="#"]:not([href="#"])').click(function() {
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
      if (target.length) {
        $('html, body').animate({
          scrollTop: target.offset().top
        }, 1000);
        return false;
      }
    }
  });
});
      
		</script>
  </body>
</html>