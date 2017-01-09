<?php 
	
	require("functions.php");
	
	//kui ei ole kasutaja id'd
	if (!isset($_SESSION["userId"])){
		
		//suunan sisselogimise lehele
		header("Location: login.php");
		exit();
	}
	
	
	//kui on ?logout aadressireal siis login v�lja
	if (isset($_GET["logout"])) {
		
		session_destroy();
		header("Location: login.php");
		exit();
	}
	
	$msg = "";
	if(isset($_SESSION["message"])){
		$msg = $_SESSION["message"];
		
		//kui �he n�itame siis kustuta �ra, et p�rast refreshi ei n�itaks
		unset($_SESSION["message"]);
	}
	
	
	if ( isset($_POST["interest"]) && 
		!empty($_POST["interest"])
	  ) {
		  
		saveInterest(cleanInput($_POST["interest"]));
		
	}
	
	// RIPPMEN�� VALIK
	if ( isset($_POST["userInterest"]) && 
		!empty($_POST["userInterest"])
	  ) {
		
		echo $_POST["userInterest"]."<br>";
		
		saveUserInterest(cleanInput($_POST["userInterest"]));
		
	}
	
    $interests = getAllInterests();
	
?>
<h1><a href="data.php"> < tagasi</a> Kasutaja leht</h1>
<?=$msg;?>
<p>
	Tere tulemast <?=$_SESSION["userEmail"];?>!
	<a href="?logout=1">Logi v�lja</a>
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



<h2>Kasutaja hobid</h2>
<form method="POST">
	
	<label>Hobi/huviala nimi</label><br>
	<select name="userInterest" type="text">
        <?php
            
            $listHtml = "";
        	
        	foreach($interests as $i){
        		
        		
        		$listHtml .= "<option value='".$i->id."'>".$i->interest."</option>";
        
        	}
        	
        	echo $listHtml;
            
        ?>
    </select>
    	
	
	<input type="submit" value="Lisa">
	
</form>