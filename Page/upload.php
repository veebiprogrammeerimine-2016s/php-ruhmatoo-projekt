<?php 
	require("../functions.php");
	
	if(!isset ($_SESSION["userId"])) {
		header("Location: login.php");
		exit();
		
	}
	
	if (isset($_GET["logout"])) {
		
		session_destroy();
		header("Location: login.php");
		exit();
		
	}
	
	$msg = " ";
	if(isset($_SESSION["message"])) {
		$msg = $_SESSION["message"];
	
	unset($_SESSION["message"]);
	
		}
	
	
?>

<?php require("../header.php"); ?>

<style>
	.container-fluid {
		font-family: 'Open Sans', sans-serif;
		font-size: 13px;
	}
	
		.button {
			background-color: #4CAF50;
			border: none;
			color: white;
			padding: 8px 20px;
			text-align: center;
			text-decoration: none;
			display: inline-block;
			font-size: 14px;
			margin: 4px 2px;
			-webkit-transition-duration: 0.4s;
			transition-duration: 0.4s;
			cursor: pointer;
			font-family: 'Open Sans', sans-serif;
		}
		
		.button1 {
			background-color: white;
			color: black;
			border: 1px solid #000000;
		}

		.button1:hover {
			background-color: #555555;
			color: white;
		}
</style>

<body>
<div class="container-fluid">
    <div class="row">
		<div align="center">
			<h2>Upload</h2>
			What type of content would you like to upload?<br><br><br>
			<h3>Pictures</h3>
			<a href="pictures_animals_imageUpload.php" class="button button1">Animals</a>
			<a href="pictures_nature_imageUpload.php" class="button button1">Nature</a>
			<br><br>
			<h3>Gifs</h3>
			<a href="gifs_animals_imageUpload.php" class="button button1">Animals</a>
			<a href="gifs_art_imageUpload.php" class="button button1">Art</a>
			<a href="gifs_nature_imageUpload.php" class="button button1">Nature</a>
		</div>
	</div>
</div>
</body>

<?php require("../footer.php"); ?>