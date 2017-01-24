<?php

require("../functions.php");
	
	if(isset($_GET["logout"])) {
		session_destroy();
		header("Location: productselect.php");
		exit();
	}
if(isset($_GET["q"])){
		$q = $Helper->cleanInput($_GET["q"]);
		$allPosts = $Products->getAllPosts($q);
	}else{
		$q="";
		$allPosts = $Products->getAllPosts($q);
	}

require("../header.php");
?>

<div class="container">
  <br>
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
   
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">

      <div class="item active">
        <img src="534556707.jpg" alt="sale" width="460" height="345">
        <div class="carousel-caption">
          <h3>Sale</h3>
          <h2>Everything you need to buy and sell online.</h2>
        </div>
      </div>

      <div class="item">
        <img src="465297030.jpg" alt="computer" width="460" height="345">
        <div class="carousel-caption">
          <h3>Simple</h3>
          <h2>Easily accessible online e-commerce website.</h2>
        </div>
      </div>
    
      <div class="item">
        <img src="arrows.jpg" alt="people" width="460" height="345">
        <div class="carousel-caption">
          <h3>Person to person</h3>
          <h2>Person to person selling</h2>
        </div>
      </div>
  
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>
<style>
  .carousel-inner > .item > img,
  .carousel-inner > .item > a > img {
      width: 50%;
      margin: auto;
  }
  </style>
</body>
</html>
<br><br>