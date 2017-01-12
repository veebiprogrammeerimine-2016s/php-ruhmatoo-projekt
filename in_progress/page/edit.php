<?php
	//edit.php
	require("../functions.php");
	
    require("../class/Helper.class.php");
	$Helper = new Helper();

	require("../class/Note.class.php");
	$Note = new Note($mysqli);
	
	// kas aadressireal on delete
	if(isset($_GET["delete"])){
		// saadan kaasa aadressirealt id
		$Note->deleteNote($_GET["id"]);
		header("Location: edit.php");
		exit();
		
	}

	
	//kas kasutaja uuendab andmeid
	if(isset($_POST["update"])){
		
		$Note->updateNote($Helper->cleanInput($_POST["id"]), $Helper->cleanInput($_POST["paid_warranty"]), $Helper->cleanInput($_POST["serialnumber"]), $Helper->cleanInput($_POST["device"]),
						  $Helper->cleanInput($_POST["manufacturer"]), $Helper->cleanInput($_POST["model"]), $Helper->cleanInput($_POST["date_of_purchase"]), $Helper->cleanInput($_POST["first_lastname"]),
						  $Helper->cleanInput($_POST["country"]), $Helper->cleanInput($_POST["city"]), $Helper->cleanInput($_POST["address"]), $Helper->cleanInput($_POST["postcode"]),
						  $Helper->cleanInput($_POST["email"]), $Helper->cleanInput($_POST["number"]), $Helper->cleanInput($_POST["problem"]),$Helper->cleanInput($_POST["add_info"]),$Helper->cleanInput($_POST["rma"]),
						  $Helper->cleanInput($_POST["status"]));
		
		header("Location: edit.php?id=".$_POST["id"]."&success=true");
        exit();	
		
	}
	
	//saadan kaasa id
	$c = $Note->getSingleNoteData($_GET["id"]);
	//var_dump($c);

	
?>
<?php require("../header.php"); ?>

<br><br>
<a href="edit0.php"> Back </a>

<h2>Edit</h2>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
	<input type="hidden" name="id" value="<?=$_GET["id"];?>" > 
  	<label for="note" >Notes</label><br>
	<textarea  id="paid_warranty" name="paid_warranty"><?php echo $c->paid_warranty;?></textarea><br>
	<textarea  id="serialnumber" name="serialnumber"><?php echo $c->serialnumber;?></textarea><br>
	<textarea  id="device" name="device"><?php echo $c->device;?></textarea><br>
	<textarea  id="manufacturer" name="manufacturer"><?php echo $c->manufacturer;?></textarea><br>
	<textarea  id="model" name="model"><?php echo $c->model;?></textarea><br>
	<textarea  id="date_of_purchase" name="date_of_purchase"><?php echo $c->date_of_purchase;?></textarea><br>
	<textarea  id="first_lastname" name="first_lastname"><?php echo $c->first_lastname;?></textarea><br>
  	<textarea  id="country" name="country"><?php echo $c->country;?></textarea><br>
	<textarea  id="city" name="city"><?php echo $c->city;?></textarea><br>
	<textarea  id="address" name="address"><?php echo $c->address;?></textarea><br>
	<textarea  id="postcode" name="postcode"><?php echo $c->postcode;?></textarea><br>
	<textarea  id="email" name="email"><?php echo $c->email;?></textarea><br>
	<textarea  id="number" name="number"><?php echo $c->number;?></textarea><br>
	<textarea  id="problem" name="problem"><?php echo $c->problem;?></textarea><br>
	<textarea  id="add_info" name="add_info"><?php echo $c->add_info;?></textarea><br>
	<textarea  id="status" name="status"><?php echo $c->status;?></textarea><br>
	
	
	<input type="submit" name="update" value="Save">
  </form>
  
<br>
<br>
<!--<a href="?id=<?=$_GET["id"];?>&delete=true">Clean</a>-->
  
  
  
  
  
<?php require("../footer.php"); ?>