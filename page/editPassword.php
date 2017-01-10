<?php

	require("../functions.php");
	
	require("../class/User.class.php");
	$User = new User($mysqli);
	
	require("../class/Helper.class.php");
	$Helper = new Helper();
	
	if (!isset ($_SESSION["userId"])) {
		
		header("Location: login.php");
		exit();
	}
	
	$error = "";
	$oldPasswordError = "";
	$newPasswordError = "";
	$newPasswordError2 = "";
	
	$newPassword = "";
	$newPassword2 = "";
	
	if (isset ($_POST["oldPassword"]) ){ 
		if (empty ($_POST["oldPassword"]) ){ 
			$oldPasswordError = "<font color='red'> Palun täida väli!</font>";		
		} else {
			$error = $User->checkPassword($Helper->cleanInput($_POST["oldPassword"]));
		}
	}
	
	if ($error == "Parool on vale!"){ 
		$oldPasswordError = "<font color='red'> Sisestasid vale parooli!</font>";
	}
	
	if (isset ($_POST["newPassword"]) ){ 
		if (empty ($_POST["newPassword"]) ){ 
			$newPasswordError = "<font color='red'> Palun täida väli!</font>";		
		} else {
			if (strlen($_POST["newPassword"]) < 8) {
				$newPasswordError = "<font color='red'>Parool peab olema vähemalt 8 tähemärki pikk!</font>";
			} else {
				$newPassword = $_POST["newPassword"];
				$newPasswordError = "";
			}
		}
	}
	
	if (isset ($_POST["newPassword2"]) ){ 
		if (empty ($_POST["newPassword2"]) ){ 
			$newPasswordError2 = "<font color='red'> Palun täida väli!</font>";		
		} else {
			$newPassword2 = $_POST["newPassword2"];
		}
	}
	
	
	$msg="";
	if ($error == "Parool on õige"){
		if(empty($newPasswordError) && 
		empty($newPasswordError2)) {
			if($newPassword == $newPassword2 ){
				$passwordHash = hash("sha512", $newPassword);
				$msg = $User->addNewPassword($Helper->cleanInput($passwordHash));
			}
			
			if($newPassword != $newPassword2 ){
				$msg= "<font style='color:red;'> Uued paroolid ei ühti!</font>";
			}
		}
	}
	
?>

<?php require("../header.php"); ?>
<div class="editPassword" style="padding-left:20px;"> 
	<div class="col-sm-3 col-md-3">

		<h2><a href="user.php"> < Tagasi </a></h2>
		
		<?php echo $msg; ?>
		<h2>Muuda Parooli</h2>

		<form method="POST"> 
		<label>Sisesta vana parool</label><br>
		<input class="form-control" name="oldPassword" type="password"> <?php echo $oldPasswordError; ?>
		<br><br>
		
		<label>Sisesta uus parool</label><br>
		<input class="form-control" name="newPassword" type="password"> <?php echo $newPasswordError; ?>
		<br><br>
		
		<label>Sisesta uus parool uuesti</label><br>
		<input class="form-control" name="newPassword2" type="password"><?php echo $newPasswordError2; ?>
		<br><br>
		
		<input class="btn btn-success" type="submit" value = "Muuda parool">
		
		</form>
	</div>
</div>
 
<?php require("../footer.php"); ?>
