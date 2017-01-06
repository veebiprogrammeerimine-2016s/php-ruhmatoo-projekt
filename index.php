<?php

	require("functions.php");
	
	require("class/User.class.php");
	$User = new User($mysqli);
	
	require("class/Helper.class.php");
	$Helper = new Helper($mysqli);
	
	require("class/Post.class.php");
	$Post = new Post($mysqli);
	
	$loginEmailError="";
	$loginPasswordError="";
	
	// kui on sisseloginud siis suunan data lehele
	if (isset($_SESSION["userId"])) {
		header("Location:../php-ruhmatoo-projekt/page/data.php");
		exit();
	}

	//kontroll
	if (isset ($_POST["loginEmail"])) {
		
		if (empty($_POST["loginEmail"]))  {
			
			$loginEmailError = "<br><span style='color: red'>Sisesta e-mail</span>";
		}
		
	}
	
	if (isset ($_POST["loginPassword"])) {
		if (empty($_POST["loginPassword"]))  {
			
			$loginPasswordError = "<br><span style='color: red'>Parool jäi sisestamata</span>";
		}
	}
	
	////
	//sisselogimise kutsumine
	if(isset($_POST["loginUsername"])  &&
	   isset($_POST["loginPassword"]) &&
	   !empty($_POST["loginUsername"]) &&
	   !empty($_POST["loginPassword"])
	   ) {
		   
		  $User->login($Helper->cleanInput($_POST["loginUsername"]), $Helper->cleanInput($_POST["loginPassword"])); 
		  
	}
	$five ="1";
	$results= $Post->onlyFive($five);
	$html="";
?>
<!DOCTYPE html>
<html>
	<head>
		<title>iksd.ee</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">		
		
		<!-- jQuery -->	
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">

		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</head>
	<body>


    <!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top navbar-inverse">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href='index.php'><span style="font-size: 30px;
			font-family: Arial, Verdana, Sans-serif;">iksd.ee  </span></h2><span class="glyphicon glyphicon-sunglasses"></a>
        </div>
          <ul class="nav navbar-nav">
			<li><p class="invisible">tyhi ruum</p></li>
			<li><p class="invisible">tyhi ruum</p></li>

			<!-- <li><a href='/~gregness/php-ruhmatoo-projekt/page/register.php'>Pole veel kasutajat?</a></li>-->
			<li><a href="page/register.php">Pole veel kasutajat? Klikka siia!</a></li>
		  </ul>
			
			<form class="navbar-form navbar-right" method="POST">
				<div class="form-group">
					<input name="loginUsername" type="text" class="form-control input-sm" placeholder="Username" value = "<?php if(isset($_POST['loginUsername'])) { echo $_POST['loginUsername']; } ?>">
					<input name="loginPassword" type="password" class="form-control input-sm" placeholder="Parool">
				</div>
				<button type="submit" class="btn btn-sm btn-success">Logi sisse</button>
			</form>


        </div><!--/.nav-collapse -->
      </div>
    </nav>
	<br><br>
    <!-- Begin page content -->
    <div class="container">
		<style>

		</style>
      <div class="page-header">
        <h1>Changelog</h1>
      </div>
      <p class="lead"><?php echo $loginEmailError; echo $loginPasswordError; ?><code>v0.1 login, signup</code></p>
	  <p class="lead"><?php echo $loginEmailError; echo $loginPasswordError; ?><code>v0.2 added upload</code></p>
	  <p class="lead"><?php echo $loginEmailError; echo $loginPasswordError; ?><code>v0.3 upload uniqid, resize and compression</code></p>
	  <p class="lead"><?php echo $loginEmailError; echo $loginPasswordError; ?><code>v0.4 infinite scroll</code></p>
    </div>
	
	
	
	
	
	<p class="lead">
	<div class='container'>
	<div class='row'><div class='col-lg-4'>
	<?php
	foreach ($results as $r) {
			
			
			
		
			$html .= "<div><table>";
				$html .= "<tr><h2>".$r->name."</h2></tr>";
				$html .= "<td><img src=".$r->message."></td></table>";

			$html .= "</div>";
		
		}
	
	echo $html;
	?>
	</div></div>
	<br>
	Tahad rohkem näha? Logi sisse!
	</p>
	

  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="padding:35px 50px;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4><span class="glyphicon glyphicon-lock"></span> Uue kasutaja loomine</h4>
        </div>
        <div class="modal-body" style="padding:40px 50px;">
          <form action="action.php" method="post" id="form" role="form"  onsubmit="return validate_all('results');">
            <div class="form-group">
              <label for="usrname"><span class="glyphicon glyphicon-user"></span> Kasutajanimi</label>
              <input type="text" class="form-control" name="login" placeholder="Sisesta kasutajanimi" value="{login}">
            </div>
			<div class="form-group">
              <label for="usrname"><span class="glyphicon glyphicon-envelope"></span> Email</label>
              <input type="text" name="email" class="form-control" id="usrname" placeholder="Sisesta email" value="{email}">
            </div>
            <div class="form-group">
              <label for="psw"><span class="glyphicon glyphicon-asterisk"></span> Parool</label>
              <input type="password" name="pass" class="form-control" placeholder="Sisesta parool" value="{pass>
            </div>
			<div class="form-group">
              <label for="psw"><span class="glyphicon glyphicon-asterisk"></span> Kinnita parool</label>
              <input type="password" class="form-control" name="cpass" placeholder="Sisesta uuesti parool" value="{cpass}">
            </div>
              <button class="btn btn-success btn-block"><span class="glyphicon glyphicon-ok"></span> Salvesta</button>
          </form>
		  <?php echo $Pelmeen;?>
		  <h3 id="results"></h3>
		  {errors}
        </div>

      </div>
      
    </div>
  </div> 

<?php require("footer.php"); ?>