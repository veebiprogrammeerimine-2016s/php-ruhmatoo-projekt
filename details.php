<?php
require("functions.php");
//require("modals.php");
//require("index.php");
if(isset($_POST["regPassword"]) && isset($_POST["regUsername"]))
	{
		if( !empty($_POST["regPassword"])&& !empty($_POST["regUsername"]))
		{

		signUP($_POST["regUsername"],$_POST["regPassword"]);
		
		?>
        <script>alert("Kasutaja on tehtud!");</script>
        <?php
		
		}
    
	}
		
if(isset($_POST["username"]) && isset($_POST["password"]))
	{
		
		login($_POST["username"],$_POST["password"]);
		if(!isset($_SESSION["userId"]))
		{
			?> <script> alert("Vale parool või kasutaja nimi"); </script> <?php
		}
		
	}
$tyreFitting = getSingleTyreFitting($_GET["id"]);
$services = getTyreFittingServices($_GET["id"]);

?>


<?php  	require("header.php");?>
<nav class="navbar navbar-fixed-top navbar-dark bg-primary">
    <div class="">
  <ul class="nav navbar-nav">
    <li class="nav-item">
      <a class="nav-link" href="index.php">Esileht <span class="sr-only">(current)</span></a>
    </li>
  </ul>
  <a class="navbar-brand pull-sm-right m-r-0 hidden-sm-down" href="http://www.tlu.ee">Presented by TLÜ team</a>
      <ul class="nav navbar-nav ">
      <li class="nav-item pull-xs-right mrg">
          <a class="nav-link"  data-toggle="modal" data-target="#login" style="cursor:pointer">Logi sisse</a>
      </li>
      </ul>
  </div>
</nav>
<div class="card">
	<div class="row">
       <div class='col-md-6 col-lg-4'>
          <img class="card-img-top" src="<?php echo $tyreFitting->logo ?>" alt="Card image cap" style="width:100%;">
          <div class="card-block">
            <h4 class="card-title"><?php echo $tyreFitting->name ?></h4>
            <p class="card-text"><?php echo $tyreFitting->description  ?></p>
          </div>
          <ul class="list-group list-group-flush">
            <li class="list-group-item">Cras justo odio</li>
            <li class="list-group-item">Dapibus ac facilisis in</li>
            <li class="list-group-item">Vestibulum at eros</li>
          </ul>
          <div class="card-block">
            <a href="#" class="card-link">Card link</a>
            <a href="#" class="card-link">Another link</a>
          </div>
        </div>
		<div class="col-lg-4">
        <iframe src="<?php echo $tyreFitting->location ?>" width="100%" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
    </div>    
	</div>        
</div>

<?php require("modals.php");
require("footer.php");?>         