<?php

require("functions.php");

if (!isset($_SESSION["userId"])){
		
		//suunan sisselogimise lehele
		header("Location: index.php");
		exit();
	}

echo "Test";

if (isset($_GET["logout"])) {
		
		session_destroy();
		header("Location: index.php");
		exit();
	}

?>
<p>
<a href="?logout=1">Logi välja</a>
</p>