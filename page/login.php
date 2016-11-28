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
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.1.1.min.js"></script>

<nav id="nav "class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
   
    <div id="logo" class="navbar-left" ">
      <a class="navbar-brand" href="login.php">FacePlänt</a>
    </div>
	<span class="menu-trigger">MENU</span>
    
    <div class="nav-menu">
      <ul class="clearfix">
        <li><a href="care.php">Taimehooldus<span class="sr-only"></span></a></li>
		<li><a href="#">Meist<span class="sr-only"></span></a></li>
        <div class="navbar-right"><li>	<form method=post class="colform">
                    <div class="form-group">
                        <input type="text" class="form-control" name="signupEmail" placeholder="E-maili aadress">
                    
                   
                        <input type="password" class="form-control" name="signupPassword" placeholder="Parool">
                    </div>
                    <button type="submit" class="btn btn-default">Logi sisse</button>
                <span class="sr-only"></form></li></div>
      </ul>
			
      
      
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
<!--JAVASCRIPT-->	
<script>jQuery(document).ready(function() {

	jQuery(".menu-trigger").click(function() {
		
		jQuery(".nav-menu").slideToggle(400, function(){
			jQuery(this).toggleClass("nav-expanded").css('display', '');
			
		});
	});


});</script>
<!-- CSS sheet lõpetas töötamise, pean siia kirjutama -->
<style>
	

	nav{
		height:50px;
	}

  div.nav-menu ul li a {
		padding:15px;
		font-size:110%;
		float:left;
	  
	  
	  

  }
  div.nav-menu ul li form {
	  width:100%;
	  float:right;
  }
    div.nav-menu ul li{
		  float: left;
		  border-bottom: 2px solid #d5dce4;
		  padding: 10px;
		  list-style:none;
	  }
   
  
  .menu-trigger {
	  display:none;
  }
  @media screen and (max-width: 480px){
	  
	  .menu-trigger {
		  display: block;
		  color:#6b6b47;
		  padding:10px;
		  text-align:right;
		  font-size:83%;
		  cursor:pointer;
		 
	  }
	 
	  div.nav-menu {
		  display: none;
	  }
	  
	  div.nav-expanded{
		  display:block;
		  background-color:white;
		  text-align:center;
	  }
	  
	  div.nav-menu ul li{
		  float: none;
		  border-bottom: 2px solid #d5dce4;
		  padding: 10px;
		  text-align:center;
	  }
	  
	  div.nav-menu ul li:last-child {
		  border-bottom: none;
		  padding:10px;
	  }
	  
  }

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


#logo{
	
	height:50px;
	´
	
}



#insertPlants{
	padding-left:20px;
	padding-right:20px;
	
	
}

body{
	font-family:helvetica;
	
	
}

a{
	color:black;
}

</style>

<?php require("../footer.php");?>