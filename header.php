<!DOCTYPE html>
<html>
	<head>
		<title>Oled sisse logitud</title>
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
		}
		.wrapper{width: 500px;margin: 0 auto;font-family: Georgia, "Times New Roman", Times, serif;}
		.wrapper > ul#results li{margin-bottom: 1px;background: #f9f9f9;padding: 20px;list-style: none;}
		.loading-info{text-align:center;}
		</style>
	</head>
	<body>
	
	<nav class="navbar navbar-default navbar-fixed-top navbar-inverse">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href='data.php'>Projekt</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="data.php">ENG meemid</a></li>
            <li><a href="data.php">EST meemid</a></li>
			<li><a href="upload.php">Upload</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Admin CP<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li role="separator" class="divider"></li>
                <li class="dropdown-header">Nav header</li>
                <li><a href="#">Separated link</a></li>
                <li><a href="#">One more separated link</a></li>
              </ul>
            </li>
			<li><p class="invisible">empty space</p></li>

		  </ul>

	
		<p class="navbar-text navbar-right">Welcome back, <a href="user.php?username=<?=$_SESSION["username"];?>"> <?=$_SESSION["username"];  ?>  </a>  <a class="btn btn-xs btn-primary" href="?logout=1" style="text-decoration:none; color:white;" >  Log Out</a></p>
		
		<form class="navbar-form navbar-middle" method="GET">
			<div class="form-group">
				<input name="searchPost" type="text" class="form-control input-sm" placeholder="Looking for something?" value="<?=$search;?>">  
				<button type="submit" class="btn btn-sm btn-primary"><a style="text-decoration:none; color:white;" >Search</a></button>
			</div>
		</form>

        </div><!--/.nav-collapse -->
      </div>
    </nav>