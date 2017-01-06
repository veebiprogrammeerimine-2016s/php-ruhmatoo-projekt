<!DOCTYPE html>
<html>
	<head>
		<title>iksd.ee portaal</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">		
		<meta charset="UTF-8">
		<!-- jQuery -->	
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">

		<!-- Latest compiled and minified JavaScript tra git -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

		
		<style>
		html {position: relative;min-height: 100%;}
		body {
			padding-top: 70px; 
			background-color: white;
		}
		.wrapper{width: 100%; margin: 0 auto; font-family: Georgia, "Times New Roman", Times, serif;}
		.wrapper > ul#results li{margin-bottom: 100px;background: #f9f9f9; padding: 100px; list-style: none;}
		.loading-info{text-align:center;}

		.rated,
		.rated:hover,
		.rated:focus {
			text-decoration:none;
			color: #6495ED;
			cursor:default;
		}
		.rating {
			text-decoration:none;
			cursor:pointer;
		}
		.unrated {
			text-decoration:none;
			color: #bdc3c7;
		}
		.unrated:hover {
			text-decoration:none;
			color: #bdc3c7;
		}
		.form-control {
			width: 30%;
		}
		a {
			color:#bdc3c7;
		}
		a:hover {
			text-decoration:none;
			color:#bdc3c7;
		}
		a:active {
			text-decoration:none;
			color:#bdc3c7;
		}
		.iksdee {
			font-size: 30px;
			font-family: "Arial", Verdana, Sans-serif;
		}
		.well {
			width: 50%;
		}
		div.search {
			position: fixed;
			bottom:2%;
			height:30px;
			width:50%;
			left:87%;
		}
		.input-group {
			width:25%;
		}

		.report:active {
			text-decoration:none;
			color:	#F08080;
		}
		.report:hover {
			text-decoration:none;
			color:	#F08080;
		}
		div.reklaamid {
			position:fixed;
			left:85%;
			bottom:10%
		}
		span.caption {
			font-size: 30px;
			font-family: "Arial", Verdana, Sans-serif;
		}
		a.under:hover {
			text-decoration: underline;
		}

		</style>
	</head>
	<body>
	
	<nav class="navbar navbar-default navbar-fixed-top navbar-inverse">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href='data.php'><span class="iksdee">iksd.ee  </span></h2><span class="glyphicon glyphicon-sunglasses"></a>
        </div>
          <ul class="nav navbar-nav">
            <li><a href="data.php">postitused </a></li>
			<li><a href="upload.php"> uus postitus</a></li>
			<li><p class="invisible">tyhi ruum</p></li>
		  </ul>
		<p class="navbar-text navbar-right">Tere, <a href="user.php?username=<?=$_SESSION["username"];?>"> <?=$_SESSION["username"];  ?>  </a>  <a class="btn btn-xs btn-primary" href="?logout=1" style="text-decoration:none; color:white;" >logi välja</a></p>


        </div><!--/.nav-collapse -->
      </div>
    </nav>