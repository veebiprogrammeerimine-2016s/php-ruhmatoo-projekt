<?php

	require("../functions.php");
	
	require("../class/User.class.php");
	$User = new User($mysqli);
	
	require("../class/Helper.class.php");
	$Helper = new Helper();
	
	//kas kasutaja uuendab andmeid
	if(isset($_POST["update"])){
		
		$User->update($Helper->cleanInput($_SESSION["userId"]), $Helper->cleanInput($_POST["firstname"]), $Helper->cleanInput($_POST["lastname"]), $Helper->cleanInput($_POST["email"]), $Helper->cleanInput($_POST["gender"]), $Helper->cleanInput($_POST["phonenumber"]));
		
		header("Location: user.php?id=".$_SESSION["userId"]."&success=true");
        exit();	
	}
	

	//saadan kaasa id
	$p = $User->editData($_SESSION["userId"]);
	
	if(isset($_GET["success"])){
		//echo "Salvestamine õnnestus";
	}
	
	$gender = "female";
	if ($p->gender == "female") {
		$gender = "female";
	}
	
	if ($p->gender == "male"){
		$gender = "male";
	}

	
?>
<?php require("../header.php"); ?>
<div class="editUser" style="padding-left:20px;padding-right:20px"> 
	<div class="col-sm-3 col-md-3">
		<h2><a href="user.php"> < Tagasi </a></h2>

		<h2>Muuda andmeid</h2>
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
		<input type="hidden" name="id" value="<?=$_GET["id"];?>" > 
		
		<label for="firstname" >Eesnimi</label><br>
		<input class="form-control" id="firstname" name="firstname" type="text" value="<?php echo $p->firstname;?>" ><br><br>
		
		<label for="lastname" >Perekonnanimi</label><br>
		<input class="form-control" id="lastname" name="lastname" type="text" value="<?php echo $p->lastname;?>" ><br><br>
		
		<label for="email" >E-posti aadress</label><br>
		<input class="form-control" id="email" name="email" type="text" value="<?php echo $p->email;?>" ><br><br>
		
		<label for="gender">Sugu</label><br>
				<?php if($gender == "female") { ?>
				<input type="radio" name="gender" value="female" checked> Naine
				<?php } else { ?>
				<input type="radio" name="gender" value="female">Naine
				<?php } ?>
				<br>
				<?php if($gender == "male") { ?>
				<input type="radio" name="gender" value="male" checked> Mees
				<?php } else { ?>
				<input type="radio" name="gender" value="male">Mees
				<?php } ?>
				<br><br>
				
		<label for="phonenumber" >Telefoninumber</label><br>
		<input class="form-control" id="phonenumber" name="phonenumber" type="text" value="<?=$p->phonenumber;?>"><br><br>
		
		<input type="submit" name="update"  class="btn btn-success" value="Salvesta">
	  </form>
   </div>
 </div>
 
 <?php require("../footer.php"); ?>
