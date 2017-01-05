<?php 
	require("../functions.php");

	if (isset($_SESSION["userId"])){

		header("Location: homepage.php");
		exit();
	}
	
	$signupEmailError = "";
	$signupPasswordError = "";
	$signupEmail = "";
	

	if( isset( $_POST["signupEmail"] ) ){

		if( empty( $_POST["signupEmail"] ) ){
			
			$signupEmailError = "See v�li on kohustuslik";
			
		} else {
			
			$signupEmail = $_POST["signupEmail"];
		}
	} 
	
	if( isset( $_POST["signupPassword"] ) ){
		
		if( empty( $_POST["signupPassword"] ) ){
			
			$signupPasswordError = "Parool on kohustuslik";
			
		} else {
			
			if ( strlen($_POST["signupPassword"]) < 8 ) {
				
				$signupPasswordError = "Parool peab olema v�hemalt 8 t�hem�rkki pikk";
			
			}
		}
	}
	
	if ( isset($_POST["signupEmail"]) && 
		 isset($_POST["signupPassword"]) && 
		 $signupEmailError == "" && 
		 empty($signupPasswordError)
		) {
		
		echo "Salvestan... <br>";
		
		echo "email: ".$signupEmail."<br>";
		echo "password: ".$_POST["signupPassword"]."<br>";
		
		$password = hash("sha512", $_POST["signupPassword"]);
		
		echo "password hashed: ".$password."<br>";
		
		$signupEmail = cleanInput($signupEmail);
		
		$User->signUp($signupEmail, cleanInput($password));
	}
	
	
	$error ="";
	if ( isset($_POST["loginEmail"]) && 
		isset($_POST["loginPassword"]) && 
		!empty($_POST["loginEmail"]) && 
		!empty($_POST["loginPassword"])
	  ) {
		  
		$error = $User->login(cleanInput($_POST["loginEmail"]), cleanInput($_POST["loginPassword"]));
		
	}

	if(isset($_GET["q"])){
		$q = $_GET["q"];
	} else {
		$q = "";
	}

	$sort = "id";

	if(isset($_GET["sort"])) {
		$sort = $_GET["sort"];
	}

	$cars=$Car->getAll($q, $sort);


?>


<?php require ("../header.php");?>

<div class="container">
		<div class="row">
			<div class="col-sm-9">
				<img src="Logo.png" alt="Firma logo" style="width:250px;height:200px;">
			</div>
			<div class="col-sm-3">
				<h1>Logi sisse</h1>
				<form method="POST">
					<p style="color:red;"><?=$error;?></p>
					<br>
					<div class="form-group">
						<input class="form-control" name="loginEmail" placeholder="Email" type="text">
					</div>
					<class="form-group">
						<input class="form-control" type="password" name="loginPassword" placeholder="Parool">	
						<br>
					<input class="btn btn-success btn-sm" type="submit" value="Logi sisse">
					<a class="btn btn-success btn-sm" href="create.php"> Registreeri</a>
				</form>
			</div>
		</div>
</div>

<h2>Autod</h2>

<div class="container-fluid">
	<form class="form-inline">
		<div class="row">
			<form>
					<input class="form-control" type="search" name="q" placeholder="Otsi" value="<?=$q;?>">
				<button type="submit" class="btn btn-primary">
					<i class="glyphicon glyphicon-search"></i>
				</button>
			</form>
		</div>
	</form>
</div>
<br>

<?php

$html = "<table class='table table-hover'>";
$html .= "<tr>";
$html .= "<th>id</th>";
$html .= "<th>Registreerimismärk</th>";
$html .= "<th>Sõiduki mark</th>";
$html .= "<th>Sõiduki mudel</th>";
$html .= "<th>Ajalugu</th>";
$html .= "</tr>";


foreach ($cars as $c) {
	$html .= "<tr>";
	$html .= "<td>".$c->id."</td>";
	$html .= "<td>".$c->RegPlate."</td>";
	$html .= "<td>".$c->Mark."</td>";
	$html .= "<td>".$c->Model."</td>";
	$html .= "<td><a class='btn btn-default btn-sm' href='car.php?id=".$c->id."'><span class='glyphicon glyphicon-th-list'></span>Vaata ajalugu</a></td>";
	$html .= "</tr>";
}
$html .= "</table>";
echo $html;

?>

	
<?php require ("../footer.php");?>
