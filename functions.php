<?php

require("../config.php");

/* Session start */
session_start();

/* Connection */
$database = "izipaevik";
$mysqli = new mysqli($serverHost, $serverUsername, $serverPassword, $database);

?>