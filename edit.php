<?php
	//edit.php
	require("functions.php");
    $Car = new Car($mysqli);

	if (!isset($_SESSION["userId"])){

	//suunan sisselogimise lehele
		header("Location: firstpage.php");
		exit();
	}

	//kas kasutaja uuendab andmeid
	if(isset($_POST["update"])){
		
		echo "Töö salvestamine õnnestus!";
		
		$Car->saveWorkForSingleCar(cleanInput($_POST["Mileage"]), cleanInput($_POST["DoneJob"]), cleanInput($_POST["JobCost"]), cleanInput($_POST["Comment"]), cleanInput($_POST["id"]));
		
		header("Location: edit.php?id=".$_POST["id"]."&success=true");
        exit();	
		
	}
	
	//$c = $Car->getSingleData($_GET["id"]);
	//var_dump($c);

	if(isset($_GET["delete"])){
		
		$Car->deleteCar($_GET["id"]);
	
	} 
	
?>
<?php require ("header.php");?>
<br><br>
<a href="userpage.php"> tagasi </a>

<h2>Muuda kirjet</h2>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
	<input type="hidden" name="id" value="<?=$_GET["id"];?>" > 
  	<label for="Mileage" >Läbisõit</label><br>
	<input id="Mileage" name="Mileage" type="text"  ><br><br>
  	<label for="DoneJob" >Tehtud töö</label><br>
	<input id="DoneJob" name="DoneJob" type="text" ><br><br>
	<label for="JobCost" >Töö maksumus</label><br>
	<input id="JobCost" name="JobCost" type="text" ><br><br>
	<label for="Comment" >Kommentaar</label><br>
	<input id="Comment" name="Comment" type="text" ><br><br>
  	
	<input type="submit" name="update" value="Salvesta">
  </form>
  
  <br><br>
  
  <a href="?id=<?=$_GET["id"];?>&delete=true">Kustuta</a>

<?php require ("footer.php");?>
  