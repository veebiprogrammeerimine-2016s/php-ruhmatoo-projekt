<?php 
	require("functions.php");
	require("class/User.class.php");
	$User = new User($mysqli);
	
	
	if (!isset($_SESSION["userId"])){
		
		//suunan sisselogimise lehele
		header("Location: firstpage.php");
		exit();
	}
	
	
	$msg = "";
	if(isset($_SESSION["message"])){
		$msg = $_SESSION["message"];
		
		//kui �he n�itame siis kustuta �ra, et p�rast refreshi ei n�itaks
		unset($_SESSION["message"]);
	}
	
	$error ="";
	if ( isset($_POST["loginEmail"]) && 
		isset($_POST["loginPassword"]) && 
		!empty($_POST["loginEmail"]) && 
		!empty($_POST["loginPassword"])
	  ) {
		  
		$error = $User->login(cleanInput($_POST["loginEmail"]), cleanInput($_POST["loginPassword"]));
		
	}
	
		if (isset($_GET["logout"])) {
		
		session_destroy();
		header("Location: firstpage.php");
		exit();
	}
	
	
?>


<?php require ("header.php");?>
<div class="container">
<?=$msg;?>
<p>
	Tere tulemast <a class="col-md-10" href="userpage.php"><?=$_SESSION["userEmail"];?>!</a>
	<a href="?logout=1">Logi v�lja</a>
</p>
		<div class="row">
			<div class="col-md-10">
				<img src="Logo.png" alt="Firma logo" style="width:250px;height:200px;">
			</div>

		</div>
	</div>
	

	
<?php require ("footer.php");?>
