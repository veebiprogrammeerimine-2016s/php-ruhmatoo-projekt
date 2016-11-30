<?php 
	require("functions.php");
	require("class/user.class.php");
	$User = new User($mysqli);
	
	
	if (!isset($_SESSION["userId"])){
		
		//suunan sisselogimise lehele
		header("Location: firstpage.php");
		exit();
	}
	
	
	$msg = "";
	if(isset($_SESSION["message"])){
		$msg = $_SESSION["message"];
		
		//kui ühe näitame siis kustuta ära, et pärast refreshi ei näitaks
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

<?=$msg;?>
<p>
	Tere tulemast <a href="user.php"><?=$_SESSION["userEmail"];?>!</a>
	<a href="?logout=1">Logi välja</a>
</p>


<div class="container">
		<div class="row">
			<div class="col-sm-9">
				<img src="Logo.png" alt="Firma logo" style="width:250px;height:200px;">

			</div>
			<div class="col-sm-3">
			
				</form>
			</div>
		</div>
	</div>
	

	
<?php require ("footer.php");?>
