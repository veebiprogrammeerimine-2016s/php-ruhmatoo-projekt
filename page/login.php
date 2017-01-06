<?php

	require("../../../../config.php");
	require("../functions.php");
	
	
	//kui on see siis suunan data lehele
	if(isset($_SESSION["userId"])){
		
		header("Location: sneakermarket.php");
		exit();
		
	}
	
	
	$signinEmailError= "";
	$signinPasswordError= "";
	$signinemail= "";
	
	
	$error="";
	if(isset($_POST["loginemail"]) && isset($_POST["loginpassword"]) &&
		!empty($_POST["loginemail"]) && !empty($_POST["loginpassword"])
		) {
		
		$error = $User->login ($Helper->cleanInput($_POST["loginemail"]), $Helper->cleanInput($_POST["loginpassword"]));
		
		
	}
	
	if(isset($_POST["loginemail"])){
		
		if(empty($_POST["loginemail"])){
			
			$signinEmailError= "E-mail on sisestamata!";
			
		}else{
			
			$signinemail = $_POST["loginemail"];
			
		}
	}
	
	if(isset($_POST["loginpassword"])){
		
		if(empty($_POST["loginpassword"])){
			
			$signinPasswordError= "Parool on sisestamata!";
			
		}
	}
	
	
	
?>


<?php require("../header.php"); ?>

<div class="container">
	
	<div class="row">
	
		<div class="col-sm-2 col-sm-offset-4">
	
			<h1>Logi sisse</h1>
			<form method="POST">
				<?php if($error!=""){ ?>
				<div class="alert alert-danger" role="alert"><?=$error;?></div>
				<?php } ?>
				<div class="form-group">
					<input class="form-control" name="loginemail" placeholder="Kasutaja" type="text" value="<?=$signinemail;?>"> <text style="color:red;"><?php echo $signinEmailError; ?></text>
				</div>
				<br>
				
				<div class="form-group">
					<input class="form-control" name="loginpassword" placeholder="Parool" type="password"> <text style="color:red;"><?php echo $signinPasswordError; ?></text>
				</div>
				<br>
					
				<input class="btn btn-success btn-block visible-xs-block" type="submit" value="Logi Sisse">
				<input class="btn btn-success btn-sm hidden-xs" type="submit" value="Logi Sisse">
			</form>
			
		</div>
	</div>
</div>
<?php require("../footer.php"); ?>