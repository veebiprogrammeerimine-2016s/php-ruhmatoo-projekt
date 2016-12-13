<?php 
	
	require("../functions.php");
	
	require("../class/Level.class.php");
	$Level = new Level($mysqli);
	
	require("../class/Helper.class.php");
	$Helper = new Helper();
	
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
	
	
	if ( isset($_POST["level"]) && 
		!empty($_POST["level"])
	  ) {
		  
		$Level->save($Helper->cleanInput($_POST["level"]));
		
	}
	
	if ( isset($_POST["userLevel"]) && 
		!empty($_POST["userLevel"])
	  ) {
		  
		$Level->saveUser($Helper->cleanInput($_POST["userLevel"]));
		
	}
	
    $levels = $Level->get();
    $userLevels = $Level->getUser();
	
?>

<h1><a href="data.php"> < tagasi</a><p>User account</h1>
<?=$msg;?>
<p>
	Welcome <?=$_SESSION["userEmail"];?>!
	<a href="?logout=1">Logout</a>
</p>


<h2>Insert your web programming skill level </h2>
<?php
    
    $listHtml = "<ul>";
	
	foreach($userLevels as $i){
		
		
		$listHtml .= "<li>".$i->level."</li>";

	}
    
    $listHtml .= "</ul>";

	
	echo $listHtml;
    
?>
<form method="POST">
	
	<label>Skill level</label><br>
	<input name="level" type="text">
	
	<input type="submit" value="Save">
	
</form>



<h2>Your skill level</h2>
<form method="POST">
	
	<label>Skill level</label><br>
	<select name="userLevel" type="text">
        <?php
            
            $listHtml = "";
        	
        	foreach($levels as $i){
        		
        		
        		$listHtml .= "<option value='".$i->id."'>".$i->level."</option>";
        
        	}
        	
        	echo $listHtml;
            
        ?>
    </select>
    	
	
	<input type="submit" value="Add">
	
</form>
