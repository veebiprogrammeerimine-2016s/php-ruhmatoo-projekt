<?php
	//edit.php
	require("functions.php");
    $Car = new Car($mysqli);
	
	//kas kasutaja uuendab andmeid
	if(isset($_POST["update"])){
		
		$Car->update(cleanInput($_POST["Mileage"]), cleanInput($_POST["DoneJob"]), cleanInput($_POST["JobCost"]), cleanInput($_POST["Comment"]));
		
		header("Location: edit.php?id=".$_POST["id"]."&success=true");
        exit();	
		
	}
	
	
	//saadan kaasa id
	$c = $Car->getSingleData($_GET["id"]);
	

	
?>
<?php require ("header.php");?>
<br><br>
<a href="userpage.php"> tagasi </a>

<h2>Muuda kirjet</h2>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
	<input type="hidden" name="id" value="<?=$_GET["id"];?>" > 
  	<label for="Mileage" >Läbisõit</label><br>
	<input id="Mileage" name="Mileage" type="text" value="<?php echo $c->Mileage;?>" ><br><br>
  	<label for="DoneJob" >Tehtud töö</label><br>
	<input id="DoneJob" name="DoneJob" type="text" value="<?=$c->DoneJob;?>"><br><br>
	<label for="JobCost" >Töö maksumus</label><br>
	<input id="JobCost" name="JobCost" type="text" value="<?=$c->JobCost;?>"><br><br>
	<label for="Comment" >Kommentaar</label><br>
	<input id="Comment" name="Comment" type="text" value="<?=$c->Comment;?>"><br><br>
  	
	<input type="submit" name="update" value="Salvesta">
  </form>
  

<?php require ("footer.php");?>
  