<?php
	session_start();
	require("../function/functions.php");
	require("../function/login.php");
	$dbconn = new mysqli($server, $user, $pass, $db);
?>
<html>
<meta charset='utf-8' name="viewport" content="width=device-width, initial-scale=1.0">
<header>

<!--<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">-->
<!--<link rel="stylesheet" href="https://code.getmdl.io/1.2.1/material.indigo-pink.min.css">-->
<!--<script defer src="https://code.getmdl.io/1.2.1/material.min.js"></script>-->

<!--<link rel="stylesheet" href="https://unpkg.com/purecss@0.6.0/build/pure-min.css">-->

<link rel="stylesheet" href="../styles/default.css">

</header>
<body>
