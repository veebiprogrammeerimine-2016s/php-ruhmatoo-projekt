<?php 

	require("../functions.php");
	
	if (!isset($_SESSION["userId"])){
		header("Location: login.php");
		exit();
	}

	if (isset($_GET["logout"])) {
		session_destroy();
		header("Location: login.php");
		exit();
	}
	$msg = "";
	if(isset($_SESSION["message"])){
		$msg = $_SESSION["message"];
		
		unset($_SESSION["message"]);
	}
	if ( isset($_POST["interest"]) && 
		!empty($_POST["interest"])
	  ) {
		$Interest->saveInterest($Helper->cleanInput($_POST["interest"]));
	}
	if ( isset($_POST["userInterest"]) && 
		!empty($_POST["userInterest"])
	  ) {
		$Interest->saveUserInterest($Helper->cleanInput($_POST["userInterest"]));
	}
    $interests = $Interest->getAllInterests();
	$userInterests = $Interest->getAllUserInterests();
?>
<?php require("../header.php"); ?>

<h1><a href="data.php"> < tagasi</a> Kasutaja leht</h1>
<?=$msg;?>
<p>
	Tere tulemast <?=$_SESSION["userEmail"];?> 	<a href="?logout=1">Logi välja</a>
</p>













