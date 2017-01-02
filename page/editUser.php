<?php

	require("../functions.php");
	
	require("../class/User.class.php");
	$User = new User($mysqli);
	
	require("../class/Helper.class.php");
	$Helper = new Helper();
	
	//kas kasutaja uuendab andmeid
	if(isset($_POST["update"])){
		
		$User->update($Helper->cleanInput($_SESSION["userId"]), $Helper->cleanInput($_POST["email"]), $Helper->cleanInput($_POST["phonenumber"]));
		
		header("Location: user.php?id=".$_SESSION["userId"]."&success=true");
        exit();	
	}
	

	//saadan kaasa id
	$p = $User->editData($_SESSION["userId"]);
	
	if(isset($_GET["success"])){
		//echo "Salvestamine õnnestus";
	}
	
?>
<?php require("../header.php"); ?>
<div class="editUser" style="padding-left:20px;padding-right:20px"> 
<br>
<a href="user.php"> &larr; Tagasi minu treeningpäevikusse</a>

<h2>Muuda andmeid</h2>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
	<input type="hidden" name="id" value="<?=$_GET["id"];?>" > 
  	<label for="email" >E-posti aadress</label><br>
	<input id="email" name="email" type="text" value="<?php echo $p->email;?>" ><br><br>
  	<label for="phonenumber" >Telefoninumber</label><br>
	<input id="phonenumber" name="phonenumber" type="text" value="<?=$p->phonenumber;?>"><br><br>
  	
	<input type="submit" name="update" value="Salvesta">
  </form>
 </div>
 
 <?php require("../footer.php"); ?>
