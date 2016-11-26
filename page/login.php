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
	
	
?><?php require("../header.php");?>

  <script src="path/to/jquery.js" type="text/javascript"></script>
   <script src="path/to/jquery.mmenu.min.js" type="text/javascript"></script>
   <script src="path/to/jquery.mmenu.navbars.min.js" type="text/javascript"></script>
   <link href="path/to/jquery.mmenu.css" type="text/css" rel="stylesheet" />
   <link href="path/to/jquery.mmenu.navbars.css" type="text/css" rel="stylesheet" />
   <script type="text/javascript">
      $(document).ready(function() {
         $("#my-menu").mmenu({
            navbars: [{
               // first navbar options
            }, {
               // second navbar options
            }]
         });
      });
   </script>

<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div id="logo" class="navbar-header">
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
        <li class="col-sm-8"><a href="care.php">Taimehooldus<span class="sr-only"></span></a></li>
        
        
      </ul>
			<form id="loginforms" class="navbar-form navbar-right col-xs-offset-4 col-sm-6" method=post role="search">
                    <div class="form-group">
                        <input type="text" class="form-control" name="signupEmail" placeholder="E-maili aadress">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="signupPassword" placeholder="Parool">
                    </div>
                    <button type="submit" class="btn btn-default">Logi sisse</button>
                </form>
      </form>
      
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
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
				
				
				
				
				<center><input class="btn btn-default" type="submit" value="Kinnita"></center>
				
				
			


				</form>
				
			</div>
		

		</div>
	
	
	</div>
	</div>
<br>
	<div class="container" id="para1" >
		<h3>Tere tulemast FacePlänt-i!</h3>
	</div>
<!-- CSS sheet lõpetas töötamise, pean siia kirjutama -->
<style>
   #para1{text-align:center;
  width:1250px;
  height:400px;
  border-style:double;
  background-color: #000000;
  border-top-left-radius:10px;
  border-top-right-radius:10px;
  padding-top:30;
  opacity:0.8;

  }
  
  #signupForm
{	-moz-border-radius:10px;
	-webkit-border-radius:10px;
	padding-top:30px;
	padding-right:30px;
	padding-left:30px;
	height:400px;
}
h3{
	color:white;
}
h4{
	
	color:white;
	
}


p {
	padding:10px;
}
a {
	
	width: 120px;
	margin-left:auto;
	margin-right:auto;
}

#logo{
	padding-top:20px;
	padding-left:20px;
	padding-right:20px;
	
}

#loginforms{
	padding-top:20px;
	padding-left:20px;
	padding-right:20px;
	
}

#insertPlants{
	padding-left:20px;
	padding-right:20px;
	
	
}

body{
	font-family:helvetica;
	
	
}
ul {
    list-style-type: none;
    margin: 0px;
    padding: 0px;
	
}

li {
	padding-top:20px;
	padding-left:20px;
	padding-right:20px;
	
}

</style>

<?php require("../footer.php");?>