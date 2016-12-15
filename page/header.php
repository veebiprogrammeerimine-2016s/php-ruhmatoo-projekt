<?php
	require("../function/functions.php");
	require("../function/login.php");
	if (file_exists("../../config.php"))  {
		require("../../config.php");
	} else {
		require("../../../../config.php");
	}
	$appName = "Töömehe leidja";
?>
<html>
<meta charset='utf-8'>
<header>

<!--<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">-->
<!--<link rel="stylesheet" href="https://code.getmdl.io/1.2.1/material.indigo-pink.min.css">-->
<!--<script defer src="https://code.getmdl.io/1.2.1/material.min.js"></script>-->

<!--<link rel="stylesheet" href="https://unpkg.com/purecss@0.6.0/build/pure-min.css">-->

<link rel="stylesheet" href="../styles/default.css">

</header>
<body>
