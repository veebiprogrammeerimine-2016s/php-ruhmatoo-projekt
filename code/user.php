<?php 
	
	require("functions.php");
	
	//kui ei ole kasutaja id'd
	if (!isset($_SESSION["userId"])){
		
		//suunan sisselogimise lehele
		header("Location: login.php");
		exit();
	}
	
	
	//kui on ?logout aadressireal siis login välja
	if (isset($_GET["logout"])) {
		
		session_destroy();
		header("Location: login.php");
		exit();
	}
	
	$msg = "";
	if(isset($_SESSION["message"])){
		$msg = $_SESSION["message"];
		
		//kui ühe näitame siis kustuta ära, et pärast refreshi ei näitaks
		unset($_SESSION["message"]);
	}
	
	
	if ( isset($_POST["contact"]) && 
		!empty($_POST["contact"])
	  ) {
		  
		savecontact(cleanInput($_POST["contact"]));
		
	}
	
	if ( isset($_POST["usercontact"]) && 
		!empty($_POST["usercontact"])
	  ) {
		  
		saveUsercontact(cleanInput($_POST["usercontact"]));
		
	}
	
    $contacts = getAllcontacts();
    $usercontacts = getAllUsercontacts();
	
?>
<head>
<link rel="stylesheet" href="pikaday.css">
<link rel="stylesheet" href="site.css">
<link rel="stylesheet" href="theme.css">
<link rel="stylesheet" href="triangle.css">
</head>
<h1><a href="about.php"> About</a><a href="data.php"> Home</a> Contacts</a> <?=$_SESSION["userEmail"];?>!</a>
	<a href="?logout=1">Logout</a></h1>

<form method="POST">
	
<h2>Got new contacts? How about adding them?</h2>
	<input name="contact" type="text">
	
	<input type="submit" value="Save">
	
</form>

<form method="POST">

<h2>Your contacts!</h2>
<?php
    
    $listHtml = "<ul>";
	
	foreach($usercontacts as $i){
		
		
		$listHtml .= "<li>".$i->contact."</li>";
	}
    
    $listHtml .= "</ul>";
	
	echo $listHtml;
	
    
?>
