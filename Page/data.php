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

<div class="container-fluid">
    <div class="row">
		<div align="center">
			<?=$msg;?>

			<h3><p> Welcome <?=$_SESSION["userEmail"];?>!</p></h3>
			
				<a href="upload.php" class="button button1">Upload</a>
				<a href="?logout=1" class="button button1">Logout</a>

			<br><br>
			<br><br>
		</div>
	</div>
</div>
<?php require("../footer.php"); ?>