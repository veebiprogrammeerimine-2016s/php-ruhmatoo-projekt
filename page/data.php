<?php

require("../functions.php");

	if(!isset($_SESSION["userId"])) {
		header("Location: login.php");
		exit();
	}

	if(isset($_GET["logout"])) {
		session_destroy();
		header("Location: productselect.php");
		exit();
	}

	if(isset($_POST["newpost"])) {
	
		$Products->createNewPost();
		$newPostData = $Products->getNewPostId();
		$newPostId = $newPostData->id;
		header("Location: createpost.php?id=".$newPostId);
		exit();
	}


$newPostBtn = "";
$modifyPostBtn = "disabled";
$pc = $Products->ifUserHasCreatedPost();
$upc = $pc->postcheck;

	if($upc == 0) {
		$newPostData = "";
	} else {
		$newPostData = $Products->getNewPostId();
		$newPostStatus = $newPostData->status;
		$newPostId = $newPostData->id;
		
		if($newPostStatus == 0) {
		$newPostBtn = "disabled";
		$modifyPostBtn = "";
		} else {
			$newPostBtn = "";
			$modifyPostBtn = "disabled";
		}
	}
require("../header.php"); 





?>
