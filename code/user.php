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
	
	
	if ( isset($_POST["interest"]) && 
		!empty($_POST["interest"])
	  ) {
		  
		saveInterest(cleanInput($_POST["interest"]));
		
	}
	
	if ( isset($_POST["userInterest"]) && 
		!empty($_POST["userInterest"])
	  ) {
		  
		saveUserInterest(cleanInput($_POST["userInterest"]));
		
	}
	
    $interests = getAllInterests();
    $userInterests = getAllUserInterests();
	
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
	<input name="interest" type="text">
	
	<input type="submit" value="Save">
	
</form>

<form method="POST">
	
	<label>Skills</label><br>
	<select name="userInterest" type="text">
        <?php
            
            $listHtml = "";
        	
        	foreach($interests as $i){
        		
        		
        		$listHtml .= "<option value='".$i->id."'>".$i->interest."</option>";
        
        	}
        	
        	echo $listHtml;
            
        ?>
    </select>
    	
	
	<input type="submit" value="Add">

<h2>Your contacts!</h2>
<?php
    
    $listHtml = "<ul>";
	
	foreach($userInterests as $i){
		
		
		$listHtml .= "<li>".$i->interest."</li>";
	}
    
    $listHtml .= "</ul>";
	
	echo $listHtml;
	
    
?>
