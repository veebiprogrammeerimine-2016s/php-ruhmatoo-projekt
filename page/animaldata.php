<?php 
	
	require("../functions.php");
	
	//kui ei ole kasutaja id'd
	if (!isset($_SESSION["userId"])){
		
		//suunan sisselogimise lehele
		header("Location: login.php");
		exit();
	}
	
	
	//kui on ?logout aadressireal siis login välja
	if (isset($_GET["logout"])) {
		
		session_destroy();
		header("Location: login.php");
		exit();
	}
?>
<?php require("../header.php"); ?>
<a href="animals.php"> < tagasi</a>

<body style='background-color:Silver'>


<?php require("../footer.php"); ?>