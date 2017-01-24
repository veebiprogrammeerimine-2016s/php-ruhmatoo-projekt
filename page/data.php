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






?>