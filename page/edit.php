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
	
if(isset($_GET["success"])){
		echo "salvestamine õnnestus";
	}
$pageName="edit";	
?>

<?php require("../header.php");?>

<div class="container" >
<div id="editForm" class="col-lg-6 col-sm-offset-10">
<a href="data.php"><i class='glyphicon glyphicon-chevron-left'></i>Tagasi</a>

<h2>Muuda kirjet</h2>
  <form class="edit-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
	<input type="hidden" name="id" value="<?=$_GET["id"];?>" required> 
  	<label for="plant_name" >Taime nimi</label><br>
	<input id="plant_name" name="plant" type="text" value="<?php echo $p->names;?>" required><br><br>
  	<label for="watering_interval" >Kastmisintervall</label><br>
	<input id="watering_interval" name="interval" type="text" value="<?php echo $p->watering_interval;?>" required><br><br>
  	<input type="submit" name="update" value="Salvesta">
	<br><br>
	
	
	
  </form>
  <br>
  <br>
  <a href="?id=<?=$_GET["id"];?>&deleted=true"><i class='glyphicon glyphicon-remove'></i>Kustuta</a>
    </div>
    </div>
  <?php require("../footer.php");?>
