<?php

require("../../../config.php");
require("../functions.php");

if(isset($_SESSION["userID"])){
	
	header("Location:data.php");
	exit();
}


	
	//MUUTUJAD
	$signupEmailError = "";
	$signupPasswordError = "";
	$registerEmailError = "";
	$registerPasswordError ="";
	$signupEmail = "";	
	$registerEmail = "";
	$personalError = "";
	$nameError = "";
	$userFirstName= "";
	$userLastName="";
	$aboutUser="";
	
	
	if(isset($_POST["personal"])) {
		if( empty($_POST["personal"])){
			
			$personalError = "Kirjuta enda kohta midagi! :)";
		} else {
			
			$aboutUser = $_POST["personal"];
		}
		
	}
	
	if(isset($_POST["FirstName"])){
		
		if(empty($_POST["FirstName"])){
			
			$nameError = "Ees-ja perekonnanimi on kohustuslikud!";
		} else {
			
			$userFirstName=$_POST["FirstName"];
			
		}
	}
	
	if(isset($_POST["LastName"])){
		
		if(empty($_POST["LastName"])){
			
			$nameError = "Ees-ja perekonnanimi on kohustuslikud!";
		} else {
			$userLastName=$_POST["LastName"];
			
		}
	}

	if( isset($_POST["signupEmail"] )){

	

		if( empty($_POST["signupEmail"])) {

			$signupEmailError = "see väli on kohustuslik";
			
		} else {
			
			//email olemas
			$signupEmail=$_POST["signupEmail"];



			}
	}



	if( isset($_POST["signupPassword"])) {

		if( empty($_POST["signupPassword"])) {

			$signupPasswordError = "see väli on kohustuslik";
		}else{
		//Siia jõuan siis, kui parool oli olemas ja parool ei olnud tühi. !ELSE!
			if(strlen($_POST["signupPassword"])<8) {

				$signupPasswordError = "Parool peab olema vähemalt 8 märki pikk";
			}




	}
	}

	if( isset($_POST["registerEmail"] )){

		

		if( empty($_POST["registerEmail"])) {

			$registerEmailError = "e-mail on kohustuslik";
         }else{
			
			//email olemas
			$registerEmail=$_POST["registerEmail"];




		}
	}



if( isset($_POST["registerPassword"] )){

		

		if( empty($_POST["registerPassword"])) {

			$registerPasswordError = "parool on kohustuslik";
			
			
		} else {

             if(strlen($_POST["registerPassword"])<8) {

				$registerPasswordError = "Parool peab olema vähemalt 8 märki pikk";
			}

		}
	}


	
	
	if($registerEmailError == "" && empty ($registerPasswordError) && isset($_POST["registerEmail"])
			&& isset($_POST["registerPassword"])&& isset($_POST["personal"]) && !empty($_POST["personal"]) && isset($_POST["FirstName"]) 
			&& isset($_POST["LastName"])) {
		
		
		
		$password = hash("whirlpool", $_POST["registerPassword"]);
		
		
		$User->signUp(($Helper->cleanInput($registerEmail)),($Helper->cleanInput($password)),($Helper->cleanInput($userFirstName)),($Helper->cleanInput($userLastName)),($Helper->cleanInput($aboutUser)));
	
		echo "Salvestan...";
		echo "email : ".$_POST["registerEmail"]."<br>";
	
	}
	
//var_dump($_POST);
$error="";

if( isset($_POST["signupEmail"]) && isset($_POST["signupPassword"])&& 
			!empty($_POST["signupEmail"]) && !empty($_POST["signupPassword"])
			){
				
				$error = $User->login($Helper->cleanInput($_POST["signupEmail"]),($Helper->cleanInput($_POST["signupPassword"])));
			}
	
	
?>
<?php require("../header.php");?>
<div class="container">
	<div class="row">
		<div class="col-sm-4 col-sm-offset-4">

			<br><br><br><br><br>

			<center><h2><font face="verdana" color="green">Logi sisse</font></h2></center>


			<div class="form-group">
				<center><form method=POST>



					<input class="form-control" name=signupEmail placeholder="e-mail" type="text" value="<?=$signupEmail;?>"> <?php echo $signupEmailError;  ?>

				<br><br>


					<input class="form-control" name=signupPassword placeholder="parool" type="password"> <?php echo $signupPasswordError; ?>

				<br><br>

					<input class="btn btn-success" type="submit" value="Logi sisse">
				<br><br>
				<br><br><br>
					

				</form>
			</div>	
				
				
			</div>	
				
				
			<div class="col-sm-4 col-sm-offset-4">
				<h2><font face="verdana" color="green">Loo kasutaja</font></h2>
				<?php echo $nameError ?>

				<?php echo $registerEmailError;?>
				<?php echo $registerPasswordError;?>
				
			<div class="form-group">
				<form method=post>

				<input class="form-control" type=text  name=registerEmail  placeholder="Sisesta meiliaadress" value="<?=$registerEmail;?>"> <br><br>
				
				

				<input class="form-control" type=password name=registerPassword  placeholder="Vali parool" > <br><br>
				<h3><font face="verdana" color="green">Sisesta oma ees- ja perekonnanimi</font></h3>
				<input class="form-control" name=FirstName placeholder="eesnimi" type="text" value="<?=$userFirstName;?>">
				<input class="form-control" name=LastName placeholder="perekonnanimi" type="text" value="<?=$userLastName;?>">
					
				<br><br><?php echo $personalError;  ?>
				
				<h3><font face="verdana" color="green"> Kirjuta enda kohta midagi huvitavat</font></h3><br>
				<input class="form-control" type=text name=personal placeholder="Kirjuta midagi enda kohta" value="<?=$aboutUser;?>"> <br><br>
				
				
				
				<center><input class="btn-success" type="submit" value="Kinnitan"></center>
				
				
			


				</form>
				
			</div>
		

		</div>
	</div>
</div>
<?php require("../footer.php");?>