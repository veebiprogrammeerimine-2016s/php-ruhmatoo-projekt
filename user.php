<?php 
	
	require("functions.php");
	
	//kui ei ole kasutaja id'd
	if (!isset($_SESSION["userId"])){
		
		//suunan sisselogimise lehele
		header("Location: login2.php");
		exit();
	}
	
	
	//kui on ?logout aadressireal siis login välja
	if (isset($_GET["logout"])) {
		
		session_destroy();
		header("Location: login2.php");
		exit();
	}
	
?>

<h1><a href="data.php"> < Back</a> User profile</h1>

<p>
	Signed in as <?=$_SESSION["userEmail"];?>
	<a href="?logout=1">Sign out</a>
</p>