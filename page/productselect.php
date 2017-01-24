<?php

require("../functions.php");
	
	if(isset($_GET["logout"])) {
		session_destroy();
		header("Location: productselect.php");
		exit();
	}
if(isset($_GET["q"])){
		$q = $Helper->cleanInput($_GET["q"]);
		$allPosts = $Products->getAllPosts($q);
	}else{
		$q="";
		$allPosts = $Products->getAllPosts($q);
	}

require("../header.php");
?>