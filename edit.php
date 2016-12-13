<?php
	//edit.php
	require("../functions.php");
	
	require("../class/Finish.class.php");
	$Finish = new Finish($mysqli);
	
	require("../class/Helper.class.php");
	$Helper = new Helper();
	
	//var_dump($_POST);
	
	//kas kasutaja uuendab andmeid
	if(isset($_POST["update"])){
		
		$Finish->update($Helper->cleanInput($_POST["id"]), $Helper->cleanInput($_POST["level"]), $Helper->cleanInput($_POST["description"]));
		
		header("Location: edit.php?id=".$_POST["id"]."&success=true");
        exit();	
		
	}
	
	//kustutan
	if(isset($_GET["delete"])){
		
		$Finish->delete($_GET["id"]);
		
		header("Location: data.php");
		exit();
	}
	
	
	
	// kui ei ole id'd aadressireal siis suunan
	if(!isset($_GET["id"])){
		header("Location: data.php");
		exit();
	}
	
	//saadan kaasa id
	$f = $Finish->getSingle($_GET["id"]);
	//var_dump($c);
	
	if(isset($_GET["success"])){
		echo "Success!";
	}

	
?>

<a href="data.php"> Back </a>

<h2>Edit</h2>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
	<input type="hidden" name="id" value="<?=$_GET["id"];?>" > 
  	<label for="number_level" >Level</label><br>
	<input id="number_level" name="level" type="text" value="<?php echo $f->level;?>" ><br><br>
  	<label for="description" >Description</label><br>
	<input id="description" name="description" type="text" value="<?=$f->description;?>"><br><br>
  	
	<input type="submit" name="update" value="Save">
  </form>
  
  
 <br>
 <br>
 <br>
 <a href="?id=<?=$_GET["id"];?>&delete=true">Delete</a>
