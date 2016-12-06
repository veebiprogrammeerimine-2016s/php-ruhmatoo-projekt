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
	
	$nameError = "";
	$userFirstName= "";
	$userLastName="";
	
	
	

	
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
			&& isset($_POST["registerPassword"])&&  isset($_POST["FirstName"]) 
			&& isset($_POST["LastName"])) {
		
		
		
		$password = hash("whirlpool", $_POST["registerPassword"]);
		
		
		$User->signUp(($Helper->cleanInput($registerEmail)),($Helper->cleanInput($password)),($Helper->cleanInput($userFirstName)),($Helper->cleanInput($userLastName)));
	
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
	

	$pageName = "login";
?> <?php require("../header.php");?>

<div class="container">


<br><br><br><br>
	<div class="col-lg-12 ">
	
				
				
		
		
		<div id="signupForm" class="col-lg-4 col-sm-offset-8" style="background-color:rgba(0, 0, 0, 0.5)";>
				<h3>Loo kasutaja</h3>
				<?php echo $nameError ?>

				<?php echo $registerEmailError;?>
				<?php echo $registerPasswordError;?>
				
			<div class="form-group">
				<form method=post>

				<input class="form-control" type=text  name=registerEmail  placeholder="Sisesta meiliaadress" value="<?=$registerEmail;?>"> <br>
				
				

				<input class="form-control" type=password name=registerPassword  placeholder="Vali parool" > 
				<h4>Sisesta ees-ja perekonnanimi</h4>
				<input class="form-control" name=FirstName placeholder="eesnimi" type="text" value="<?=$userFirstName;?>"><br>
				<input class="form-control" name=LastName placeholder="perekonnanimi" type="text" value="<?=$userLastName;?>">
					
				<br>
				
				
				
				
				<center><input class="btn btn-success" type="submit" value="Kinnita"></center>
				
				
			


				</form>
				
			</div>
		

		</div>
	
	
	</div>
	</div>
<br>
	<div class="container" id="para1" >
		<h3>Tere tulemast FacePlänt-i!</h3>
	</div>



<?php require("../footer.php");?>