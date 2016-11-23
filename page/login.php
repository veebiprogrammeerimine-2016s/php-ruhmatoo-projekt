<?php 
	
	require("../functions.php");
	
	$User = new User($mysqli);
	
	$Helper = new Helper();
	
	// kui on juba sisse loginud siis suunan data lehele
	if (isset($_SESSION["userId"])){
		
		//suunan sisselogimise lehele
		header("Location: data.php");
		exit();
		
	}
	

	//echo hash("sha512", "b");
	
	
	//GET ja POSTi muutujad
	//var_dump($_GET);
	//echo "<br>";
	//var_dump($_POST);
	
	//echo strlen("äö");
	
	
	$error ="";
	if ( isset($_POST["loginEmail"]) && 
		isset($_POST["loginPassword"]) && 
		!empty($_POST["loginEmail"]) && 
		!empty($_POST["loginPassword"])
	  ) {
		  
		$error = $User->login($Helper->cleanInput($_POST["loginEmail"]), $Helper->cleanInput($_POST["loginPassword"]));
		
	}
	

?>
<?php require("../header.php"); ?>

	<div class="container">
	
		<div class="row">
		<body style='background-color:Silver'>
			<div class="col-sm-4 "></div>
			<div class="col-sm-4 ">
				<h3>Logi sisse</h3>
				<form method="POST">
					<p style="color:red;"><?=$error;?></p>
					 <label for="fname">E-post</label><br>
					<input type="text" id="fname" name="loginEmail">
					
					<br>

					<label for="lname">Parool</label><br>
					<input type="password" id="lname" name="loginPassword" placeholder="Parool">
					
					<br><br>
					
					
					<input class="btn btn-success btn-sm hidden-xs" type="submit" value="Logi sisse">
					<input class="btn btn-success btn-sm btn-block visible-xs-block" type="submit" value="Logi sisse">
					<br>
					
					<a href="registration.php">Pole kasutajat? Registreeru SIIN!</a>
					
					
				</form>
			</div>
		</div>
		
	</div>
<?php require("../footer.php"); ?>