<?php
if (!isset($_SESSION["userId"])){
		
		//suunan sisselogimise lehele
		header("Location: index.php");
		exit();
	}

echo "Test";

?>