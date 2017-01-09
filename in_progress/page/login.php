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
	
	//kas on üldse olemas
	if (isset ($_POST["signupEmail"])) {
		
		// oli olemas, ehk keegi vajutas nuppu
		// kas oli tühi
		if (empty ($_POST["signupEmail"])) {
			
			//oli tõesti tühi
			$signupEmailError = "*";
			
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
			$signupPasswordError = "*";
			
		} else {
			
			// oli midagi, ei olnud tühi
			
			// kas pikkus vähemalt 8
			if (strlen ($_POST["signupPassword"]) < 8 ) {
				
				$signupPasswordError = "The password must contain at least 8 symbols!";
				
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
		echo "Success! Saving...<br>";
		//echo "email ".$signupEmail."<br>";
		//echo "parool ".$_POST["signupPassword"]."<br>";
		
		$password = hash("sha512", $_POST["signupPassword"]);
		

		//echo "räsi ".$password."<br>";
		
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
<?php require("../header.php"); ?>

<div class="container">
	<div class="row">
	
		<div class="col-sm-4 col-md-3">
	
			<h1>Sign in</h1>
			<p style="color:red;"><?php echo $notice; ?></p>
			<form method="POST">
				
				<label>E-mail</label><br>
				
				<div class="form-group">
					<input class="form-control" name="loginEmail" type="email">
				</div>
				
				<br>
				
				<label>Password</label><br>
				
				<div class="form-group">
					<input class="form-control" name="loginPassword" type="password">
				</div>
				
				<br>
				
				<input class="btn btn-success btn-sm hidden-xs" type="submit" value="Sign in">
				<input class="btn btn-success btn-sm btn-block visible-xs-block" type="submit" value="Sign in">
			
			</form>
		</div>
		<div class="col-sm-4 col-md-3 col-sm-offset-4 col-md-offset-3"> </div>
		
		
	<div class="container">
		<div class="row">
		
			<div class="col-sm-4 col-md-3">			
				<h1>Sign up</h1>
				
				<form method="POST">
				
					
					<label>E-mail</label><br>
					<div class="form-group">
						<input class="form-control" name="signupEmail" type="email" value="<?=$signupEmail;?>" > <?php echo $signupEmailError; ?>
					</div>
					
					<br>
					
					<label>Password</label><br>
					<div class="form-group">
						<input class="form-control" placeholder="Password" name="signupPassword" type="password"> <?php echo $signupPasswordError; ?>
					</dir>			
					<br>
					<label>Choose your gender:</label>
					<br>
					
					<?php if ($gender == "male") { ?>
							<input type="radio" name="gender" value="male" checked > Male<br>
					<?php } else { ?>
							<input type="radio" name="gender" value="male"> Male<br>
					<?php } ?>
					
					<?php if ($gender == "female") { ?>
						<input type="radio" name="gender" value="female" checked > Female<br>
					<?php } else { ?>
						<input type="radio" name="gender" value="female"> Female<br>
					<?php } ?>
					
					<?php if ($gender == "other") { ?>
						<input type="radio" name="gender" value="other" checked > Other<br>
					<?php } else { ?>
						<input type="radio" name="gender" value="other"> Other<br>
					<?php } ?>
					<div class="form-group">
					
					</div>
					
						<input class="btn btn-primary btn-sm hidden-xs" type="submit" value="Sign up">
						<input class="btn btn-primary btn-sm btn-block visible-xs-block" type="submit" value="Sign up">
					
					</form>
				</div>	
				<div class="col-sm-4 col-md-3 col-sm-offset-4 col-md-offset-3">
			</div>
		
		
	</div>
</div>

<?php require("../footer.php"); ?>

