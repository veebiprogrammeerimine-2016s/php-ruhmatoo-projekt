<?php

	require("../../../config.php");
	require("../functions.php");
	
	if(isset($_SESSION["userId"])){
		
		header("Location: productselect.php");
		exit();	
	}
	$signinUserError= "";
	$signinPasswordError= "";
	$signinuser= "";
	
	$error="";
	if(isset($_POST["loginuser"]) && isset($_POST["loginpassword"]) &&
		!empty($_POST["loginuser"]) && !empty($_POST["loginpassword"])
		) {
		
		$error = $User->login ($Helper->cleanInput($_POST["loginuser"]), $Helper->cleanInput($_POST["loginpassword"]));
	}
	
	if(isset($_POST["loginuser"])){
		if(empty($_POST["loginuser"])){
			$signinUserError= "Kasutajanimi on kohustuslik!";
		}else{
			$signinuser = $_POST["loginuser"];
		}
	}
	
	if(isset($_POST["loginpassword"])){
		if(empty($_POST["loginpassword"])){
			$signinPasswordError= "Parool on kohustuslik!";		
		}
	}





?>

<?php require("../header.php"); ?>

<div class="container">
	
	<div class="row">
	
		<div class="col-sm-12 col-sm-offset-0">
	
			<h1>Login</h1>
			<form method="POST">
				<?php if($error!=""){ ?>
				<div class="alert alert-danger" role="alert"><?=$error;?></div>
				<?php } ?>
				<div class="form-group">
					<input class="form-control" name="loginuser" placeholder="Kasutaja" type="text" value="<?=$signinuser;?>"> <text style="color:orange;"><?php echo $signinUserError; ?></text>
				</div>
				<br>
				
				<div class="form-group">
					<input class="form-control" name="loginpassword" placeholder="Parool" type="password"> <text style="color:orange;"><?php echo $signinPasswordError; ?></text>
				</div>
				<br>
					
				<input class="btn btn-primary btn-block visible-xs-block" type="submit" value="Logi Sisse">
				<input class="btn btn-primary btn-block btn-sm hidden-xs" type="submit" value="Logi Sisse">
			</form>
			
		</div>
	</div>
</div>
<?php require("../footer.php"); ?>



