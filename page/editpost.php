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
		header("Location: data.php");
		exit();
	}
	
$currentId = $_GET["id"];
$recentPostData = $Products->getRecentPostInfo($currentId);
$recentPostHeading = $recentPostData->heading;
$recentPostCondition = $recentPostData->condition;
$recentPostPrice = $recentPostData->price;
$recentPostDescription = $recentPostData->description;

if(isset($_POST["description"]) && isset($_POST["price"]) && isset($_POST["heading"]) && isset($_POST["condition"]) &&
	 !empty($_POST["description"]) && !empty($_POST["price"]) && !empty($_POST["heading"])  &&  !empty($_POST["condition"])) {
		
		$updateStatus = 4;
		$Products->saveproduct($currentId, $Helper->cleanInput($_POST["heading"]), $Helper->cleanInput($_POST["condition"]), $Helper->cleanInput($_POST["description"]), $Helper->cleanInput($_POST["price"]), $updateStatus);
		
		$recentPostData = $Products->getRecentPostInfo($currentId);
		$recentId = $recentPostData->id;
		$Products->deletePreviousPostVersions($currentId, $recentId);
		
		header("Location: editpost.php?id=".$currentId);
		exit();
	}
	
	if(isset($_POST["delete"])) {
		
		$Products->deleteUnfinishedPost($currentId);
		
		header("Location: myposts.php");
		exit();
	}
	






?>