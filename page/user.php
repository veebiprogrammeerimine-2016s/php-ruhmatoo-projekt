<?php

	require("../functions.php");
	
	require("../class/User.class.php");
	$User = new User($mysqli);
	
	require("../class/Helper.class.php");
	$Helper = new Helper();
	
	//kas on sisse loginud, kui ei ole, siis suunata login lehele
	
	if (!isset ($_SESSION["userId"])) {
		
		header("Location: login.php");
		exit();
	}
	
	//kas ?logout on aadressireal
	if (isset($_GET["logout"])) {
		
		session_destroy ();
		header ("Location: login.php");
		exit();
	}

	$userData = $User->addToArray();
	//echo $userData;
	//var_dump($userFavorites);
?>
<?php require("../header.php"); ?>

<div class "data" style="padding-left:10px;">
<div align="center"><h1>Minu treeningpäevik</h1>
	<p>
		<a href="data.php">Tagasi avalehele</a><br>
		<a href="?logout=1">Logi välja</a>
	</p>
</div>

<h2>Minu andmed</h2>
<div>

<p>Eesnimi: <?php echo $userData->firstname;?></p>
<p>Perekonnanimi: <?php echo $userData->lastname;?></p>
<p>Kasutaja e-post: <?php echo $userData->email;?></p>
<p>Sugu: <?php echo $userData->gender;?></p>
<p>Telefoninumber: <?php echo $userData->phonenumber;?></p>


</div>
<?php require("../footer.php"); ?>
