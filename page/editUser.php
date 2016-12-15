<?php

	require("../functions.php");
	
	require("../class/User.class.php");
	$User = new User($mysqli);
	
	require("../class/Helper.class.php");
	$Helper = new Helper();
	
	//kas kasutaja uuendab andmeid
	if(isset($_POST["update"])){
		
		$User->update($Helper->cleanInput($_SESSION["id"]), $Helper->cleanInput($_SESSION["email"]), $Helper->cleanInput($_SESSION["phonenumber"]));
		
		header("Location: editUser.php?id=".$_SESSION["id"]."&success=true");
        exit();	
	}
	
	//kustutan
	if(isset($_SESSION["delete"])){
		
		$User->delete($_SESSION["id"]);
		
		header("Location: user.php");
		exit();
	}
	
	//saadan kaasa id
	$p = $User->editData($_SESSION["userId"]);
	
	if(isset($_SESSION["success"])){
		//echo "Salvestamine õnnestus";
	}
	
?>
<?php require("../header.php"); ?>

<br><br>
<a href="user.php"> < tagasi </a>

<div class "edit" style="padding-left:10px;">

<h2>Muuda andmeid</h2>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
	<input type="hidden" name="id" value="<?=$_GET["id"];?>" > 
  	<label for="email" >E-posti aadress</label><br>
	<input id="email" name="email" type="text" value="<?php echo $p->email;?>" ><br><br>
  	<label for="phonenumber" >Telefoni number</label><br>
	<input id="phonenumber" name="phonenumber" type="text" value="<?=$p->phonenumber;?>"><br><br>
  	
	<input type="submit" name="update" value="Salvesta">
  </form>
  
  
 <br>
 
 <a href="?id=<?=$_SESSION["id"];?>&delete=true">Kustuta</a>
 <br>
 <br>
 <br>
 
 </div>
 
 <?php require("../header.php"); ?>
