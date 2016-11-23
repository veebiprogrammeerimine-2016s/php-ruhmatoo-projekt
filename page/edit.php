<?php
	//edit.php
	require("../functions.php");
	
	
	//var_dump($_POST);
	
	//kas kasutaja uuendab andmeid
	if(isset($_POST["update"])){
		
		$Animal->update($Helper->cleanInput($_POST["id"]), $Helper->cleanInput($_POST["type"]), $Helper->cleanInput($_POST["name"]), $Helper->cleanInput($_POST["age"]));
		
		header("Location: animals.php?id=".$_POST["id"]."&success=true");
        exit();	
		
	}
	
	//kustutan
	if(isset($_GET["delete"]) && isset($_GET["id"])){
		
		$Animal->delete($_GET["id"]);
		
		header("Location: animals.php");
		exit();
	}
	
	
	
	// kui ei ole id'd aadressireal siis suunan
	if(!isset($_GET["id"])){
		header("Location: animals.php");
		exit();
	}
	
	//saadan kaasa id
	$c = $Animal->getSingle($_GET["id"]);
	//var_dump($c);
	
	if(isset($_GET["success"])){
		echo "Salvestamine onnestus";
	}

	
?>
<?php require("../header.php"); ?>
<br><br>
<a href="apartments.php"> tagasi </a>

<h2>Muuda kirjet</h2>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
	<input type="hidden" name="id" value="<?=$_GET["id"];?>" > 
  	<label for="type" >Liik</label><br>
	<input id="type" name="type" type="text" value="<?php echo $c->type;?>" ><br><br>
  	<label for="name" >Nimi</label><br>
	<input id="name" name="name" type="text" value="<?=$c->name;?>"><br><br>
	<label for="age" >Vanus</label><br>
	<input id="age" name="age" type="text" value="<?=$c->age;?>"><br><br>
	
	<input type="submit" name="update" value="Uuenda">
  </form>
  
  
 <br>
 <br>
 <br>
 <a href="?id=<?=$_GET["id"];?>&delete=true">Kustuta</a>
 <?php require("../footer.php"); ?>