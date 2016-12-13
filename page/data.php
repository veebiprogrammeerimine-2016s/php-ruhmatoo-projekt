<?php

require("../functions.php");

//kui ei ole kasutaja id'd
if (!isset($_SESSION["userId"])) {

	//suunan sisselogimise lehele
	header("Location: login.php");
	exit();

}

//kui on ?logout aadressi real siis login välja
if(isset ($_GET["logout"])) {

	session_destroy();
	header("Location:login.php");
	exit();
}

$msg = " ";
if(isset($_SESSION["message"])) {
	$msg = $_SESSION["message"];

	//kui ühe näitame siis kusutua ära, et pärast refreshi ei näita
	unset($_SESSION["message"]);

}


?>

<h1>TV Show Calendar</h1>
<?=$msg;?>

<p>
	Welcome <?=$_SESSION["userName"];?>!
	<br><br>
	<a href="?logout=1"> Log out</a>
</p>

<br><br>
<br><br>