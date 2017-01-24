<?php

require("../functions.php");

	if(!isset($_SESSION["userId"])) {
		header("Location: login.php");
		exit();
	}

	if(isset($_GET["logout"])) {
		session_destroy();
		header("Location: login.php");
		exit();
	}
	
	if(!isset($_GET["id"])) {
		header("Location: productselect.php");
		exit();
	}
	
	if($_GET["id"] == "") {
		header("Location: productselect.php");
		exit();
}

$postData = $Products->getSinglePostData($_GET["id"]);
$postId = $postData->postid;

if($_GET["id"] != $postId) {
	header("Location: productselect.php");
	exit();
}

if(isset($_POST["comments"]) && !empty($_POST["comments"])) {
	$Products->postComment($_GET["id"], $Helper->cleanInput($_POST["comments"]));
}


require("../header.php");
?>
