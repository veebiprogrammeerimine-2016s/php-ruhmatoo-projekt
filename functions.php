<?php

require("/home/egenoor/config.php");

session_start();

$database = "if16_ege";
$mysqli = new mysqli($serverHost, $serverUsername, $serverPassword, $database);

require("class/Helper.class.php");
$Helper = new Helper();



function getSeriesData() {
	$database = "if16_ege";
	$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $database);
	
	$myData = mysql_query("SELECT title FROM user_tv_db");
	while($record = mysql_fetch_array($myData)) {
		echo '<option value="' . $record['title'] . '">' . $record['title'] . '</option>';
	}
	$mysqli->close();
}




?>