<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

if (file_exists("../../config.php"))  {
	require("../../config.php");
} else {
	require("../../../../config.php");
}

$appName = "Töömehe leidja";






?>
