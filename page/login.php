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
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="login.php">FacePlänt</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="navbar-main">
      <ul class="nav navbar-nav">
        <li class="col-sm-12 col-sm-offset-12"><a href="#">Suggested Plänt Care <span class="sr-only"></span></a></li>
        
        
      </ul>
			<form class="navbar-form navbar-right" method=post role="search">
                    <div class="form-group">
                        <input type="text" class="form-control" name="signupEmail" placeholder="Username">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="signupPassword" placeholder="Password">
                    </div>
                    <button type="submit" class="btn btn-default">Sign In</button>
                </form>
      </form>
      
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<div class="container">



	<div class="col-lg-12 ">
				
		
		
		<div id="signupForm" class="col-lg-4 col-sm-offset-8" style="background-color:rgba(0, 0, 0, 0.5)";>
				<h2><font color="white">Loo kasutaja</font></h2>
				<?php echo $nameError ?>

				<?php echo $registerEmailError;?>
				<?php echo $registerPasswordError;?>
				
			<div class="form-group">
				<form method=post>

				<input class="form-control" type=text  name=registerEmail  placeholder="Sisesta meiliaadress" value="<?=$registerEmail;?>"> <br><br>
				
				

				<input class="form-control" type=password name=registerPassword  placeholder="Vali parool" > 
				<h3><font face="verdana" color="white">Sisesta oma ees- ja perekonnanimi</font></h3>
				<input class="form-control" name=FirstName placeholder="eesnimi" type="text" value="<?=$userFirstName;?>">
				<input class="form-control" name=LastName placeholder="perekonnanimi" type="text" value="<?=$userLastName;?>">
					
				<?php echo $personalError;  ?>
				
				<h3><font face="verdana" color="white"> Kirjuta enda kohta midagi huvitavat</font></h3>
				<input class="form-control" type=text name=personal placeholder="Kirjuta midagi enda kohta" value="<?=$aboutUser;?>"> <br><br>
				
				
				
				<center><input class="btn-success" type="submit" value="Kinnitan"></center>
				
				
			


				</form>
				
			</div>
		

		</div>
	
	
	</div>
	
</div>
<div>
</div>
<?php require("../footer.php");?>