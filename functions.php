<!--- FUNCTIONS --->

<?php

require_once("/home/vladsuto/config.php");

if(!isset($_SESSION))
{
    session_start();
}

$dbName = "if16_vladsuto_garagediary";
$mysqli = new mysqli($serverHost, $serverUsername, $serverPassword, $dbName);

require("../class/users.class.php");
$Users = new Users($mysqli);
require("../class/cars.class.php");
$Cars = new Cars($mysqli);
require("../class/helper.class.php");
$Helper = new Helper();
require("../class/events.class.php");
$Events = new Events($mysqli);
