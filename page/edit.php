<?php 
//edit.php
	require("../functions.php");
	
	
if (isset($_GET["deleted"])){
		
		$Plant->delete($_GET["id"]);
			header("Location: data.php");
			exit();
		
	}
	
	//kas kasutaja uuendab andmeid
	if(isset($_POST["update"])){
		
		$Plant->update($Helper->cleanInput($_POST["id"]), $Helper->cleanInput($_POST["plant"]), $Helper->cleanInput($_POST["interval"]));
		
		header("Location: data.php?id=".$_POST["id"]."&success=true");
        exit();	
		
	}
	//saadan kaasa id
$p = $Plant->getSingleData($_GET["id"]);
	
	//Kui pole id-d aadressireal, siis suunan
	if (!isset($_GET["id"])){
		header("Location:data.php");
		exit();
	}
	
/*	$p = $Plant->getSingleData($_GET["id"]);
	var_dump($p); */
	
if(isset($_GET["success"])){
		echo "salvestamine õnnestus";
	}

	


	
?>
<?php require("../header.php");?>
<br><br>
<a href="data.php"> Tagasi </a>

<h2>Muuda kirjet</h2>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
	<input type="hidden" name="id" value="<?=$_GET["id"];?>" > 
  	<label for="plant_name" >Taime nimi</label><br>
	<input id="plant_name" name="plant" type="text" value="<?php echo $p->name;?>" ><br><br>
  	<label for="watering_interval" >Kastmisintervall</label><br>
	<input id="watering_interval" name="interval" type="text" value="<?php echo $p->watering_days;?>"><br><br>
  	
	<input type="submit" name="update" value="Salvesta">
	<br><br>
	
	
	
  </form>
  <br>
  <br>
  <a href="?id=<?=$_GET["id"];?>&deleted=true">Kustuta</a>
  <?php require("../footer.php");?>
