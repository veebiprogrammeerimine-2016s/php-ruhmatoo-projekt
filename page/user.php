<?php 
	
	require("../functions.php");
	
    require("../class/Helper.class.php");
	$Helper = new Helper();
	
	require("../class/Interest.class.php");
	$Interest = new Interest($mysqli);
	
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
		  
		$Interest->saveInterest($Helper->cleanInput($_POST["interest"]));
		
	}
	
	// RIPPMENÜÜ VALIK
	if ( isset($_POST["userInterest"]) && 
		!empty($_POST["userInterest"])
	  ) {
		
		echo $_POST["userInterest"]."<br>";
		
		$Interest->saveUserInterest($Helper->cleanInput($_POST["userInterest"]));
		
	}
	
    $interests = $Interest->getAllInterests();
	
	
	
?>


<?php require("header3.php");?>
<a href="data.php"> < tagasi</a> <h1> <font color="blue"> Kasutaja Profiil </font> </h1>

<p>
	<h3>Tere tulemast  <?=$_SESSION["userEmail"];?>!</h3>
	<a href="?logout=1">Logi välja</a>
</p>


<h2>Salvesta hobi</h2>
<?php
    
    $listHtml = "<ul>";
	
	foreach($interests as $i){
		
		
		$listHtml .= "<li>".$i->interest."</li>";

	}
    
    $listHtml .= "</ul>";

	
	echo $listHtml;
    
?>
<form method="POST">
	
	<label>Hobi/huviala nimi</label><br>
	<input name="interest" type="text">
	
	<input type="submit" value="Salvesta">
	
</form>



