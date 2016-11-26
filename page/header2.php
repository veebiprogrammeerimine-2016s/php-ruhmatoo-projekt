<html>
	<head>
	<link rel="stylesheet" type="text/css" href="disain.css">

		<title>Sisselogimise leht</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</head>
	<body>


	
	    <div class="nav">
		
			<div id="iKala" class="col-xs-offset-1 col-xs-4">
				<h2>
					<font style="font-family:verdana;font-weight:bold;color:white">
						iKala
					</font>
				
				<h2>
					 
				</div>
				
				  <ul>
				  
					<li class="btn navbar"><a href="login.php">Avaleht</a></li>
					<li class="btn navbar"><a href="eestikalad.php">Eesti kalad</a></li>
					<li class="btn navbar"><a href="info.php">Info</a></li>
					<li class="btn navbar"><a href="#">Kontakt</a></li>
					<li class="btn navbar"><a href="user.php">Profiil</a></li>
					<li class="btn navbar"><a href="?logout=1">Logi välja</a></li>
					 <form class ="form-wrapper">
					<input id="otsing"  type="search" name="q" value="<?=$q;?>">
					<input id="nupp" type="submit" value="Otsi">
					</form>
				  </ul>
    </div>