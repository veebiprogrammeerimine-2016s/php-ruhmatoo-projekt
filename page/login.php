<?php 
	require("../functions.php");
	
    require("../class/Helper.class.php");
	$Helper = new Helper();
	
	require("../class/User.class.php");
	$User = new User($mysqli);
	
	// kui kasutaja on sisseloginud, siis suuna data lehele
	if(isset ($_SESSION["userId"])) {
		header("Location: data.php");
		exit();
	}
	//var_dump($_GET);
	//echo "<br>";
	//var_dump($_POST);
		
	$signupEmailError = "";
	$signupEmail = "";
	$loginEmail = "";
	$loginPassword = "";
	//kas on üldse olemas
	if (isset ($_POST["signupEmail"])) {
		
		// oli olemas, ehk keegi vajutas nuppu
		// kas oli tühi
		if (empty ($_POST["signupEmail"])) {
			
			//oli tõesti tühi
			$signupEmailError = "See väli on kohustuslik";
			
		} else {
				
			// kõik korras, email ei ole tühi ja on olemas
			$signupEmail = $_POST["signupEmail"];
		}
		
	}
	
	$signupPasswordError = "";
	
	//kas on üldse olemas
	if (isset ($_POST["signupPassword"])) {
		
		// oli olemas, ehk keegi vajutas nuppu
		// kas oli tühi
		if (empty ($_POST["signupPassword"])) {
			
			//oli tõesti tühi
			$signupPasswordError = "See väli on kohustuslik";
			
		} else {
			
			// oli midagi, ei olnud tühi
			
			// kas pikkus vähemalt 8
			if (strlen ($_POST["signupPassword"]) < 8 ) {
				
				$signupPasswordError = "Parool peab olema vähemalt 8 tm pikk";
				
			}
			
		}
		
	}
	
	
	$gender = "";
	if(isset($_POST["gender"])) {
		if(!empty($_POST["gender"])){
			
			//on olemas ja ei ole tühi
			$gender = $_POST["gender"];
		}
	}
	
	if ( isset($_POST["signupEmail"]) &&
		 isset($_POST["signupPassword"]) &&
		 $signupEmailError == "" && 
		 empty($signupPasswordError)
	   ) {
		
		// ühtegi viga ei ole, kõik vajalik olemas
		echo "salvestan...<br>";
		echo "email ".$signupEmail."<br>";
		echo "parool ".$_POST["signupPassword"]."<br>";
		
		$password = hash("sha512", $_POST["signupPassword"]);
		

		echo "räsi ".$password."<br>";
		
		//kutsun funktsiooni, et salvestada
		$User->signup($signupEmail, $password);
		
	}	
	
	
	$notice = "";
	// mõlemad login vormi väljad on täidetud
	if (	isset($_POST["loginEmail"]) && 
			isset($_POST["loginPassword"]) && 
			!empty($_POST["loginEmail"]) && 
			!empty($_POST["loginPassword"]) 
	) {
		$notice = $User->login($_POST["loginEmail"], $_POST["loginPassword"]);
		
		if(isset($notice->success)){
			header("Location: login.php");
			exit();
		}else {
			$notice = $notice->error;
			var_dump($notice->error);
		}
		
	}
	
?>
<?php require("../header.php");?>

<div class="container">
	<div class="col-md-8">
	<div class="col-sm-6"
<!DOCTYPE html>
<html>
	<head>

		<title>Sisselogimise leht</title>
		<link rel="stylesheet" type="text/css" href="disain.css">
	</head>
	<body >
	
	
<!--<body>
	<nav id="menyy">
		<ul>
			<li><a href="#huvitav" target="_self"> Huvitavaid fakte </a></li>
			<li><a href="#oluline" target="_self"> Olulisi fakte </a></li>
			<li><a href="#tabel" target="_self"> Tähtsaid fakte </a></li>
			<li><a href="#meedia" target="_self"> Heli ja liikuv pilt </a></li>
			<li><a href="#laul" target="_self"> Huvitavaid fakte laulus </a></li>
		</ul>
</nav>-->
		<h1>Logi sisse</h1>
		<p style="color:red;"><?php echo $notice; ?></p>
		<form method="POST">
			
			<label>E-post</label><br>
			<div class="form-group">
			<input class ="form-control" name="loginEmail" type="email" placeholder="E-mail" value="<?= $loginEmail; ?>">
			</div>
		
			
			<label>Parool</label><br>
			<input class ="form-control" name="loginPassword" type="password" placeholder="Parool">
						
			<br><br>
			
			<input class="btn btn-success btn-sm hidden-xs" type="submit" value="Logi sisse">
			<input class="btn btn-success btn-sm btn-block visible-xs-block" type="submit" value="Logi sisse">
		
		</form>
		</div>
		</div>
		
		<div class="col-md-4">
		<h1>Loo kasutaja</h1>
		
		<form method="POST">
			
			<label>E-post</label><br>
			<input class ="form-control" placeholder="E-mail" name="signupEmail" type="email" value="<?=$signupEmail;?>" > <?php echo $signupEmailError; ?>
			
			<br><br>
			
			<input class ="form-control" placeholder="Parool" name="signupPassword" type="password"> <?php echo $signupPasswordError; ?>
						
			<br><br>
			
			<?php if ($gender == "male") { ?>
				<input type="radio" name="gender" value="male" checked > Mees<br>
			<?php } else { ?>
				<input type="radio" name="gender" value="male"> Mees<br>
			<?php } ?>
			
			<?php if ($gender == "female") { ?>
				<input type="radio" name="gender" value="female" checked > Naine<br>
			<?php } else { ?>
				<input type="radio" name="gender" value="female"> Naine<br>
			<?php } ?>
			
			<?php if ($gender == "other") { ?>
				<input type="radio" name="gender" value="other" checked > Muu<br>
			<?php } else { ?>
				<input type="radio" name="gender" value="other"> Muu<br>
			<?php } ?>
			
			<input class="btn btn-success btn-sm hidden-xs" type="submit" value="Loo kasutaja">
		
		</form>

	</body>
</html>
</div>
</div>
</div>


<?php require("../booter.php");?>