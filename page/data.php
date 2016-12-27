<?php

require("../functions.php");

//kui ei ole kasutaja id'd suunan sisselogimise lehele
	if(!isset($_SESSION["userId"])) {
		header("Location: login.php");
		exit();
	}

//logout
	if(isset($_GET["logout"])) {
		session_destroy();
		header("Location: login.php");
		exit();
	}

$submitBtn = "";
$submitUploadBtn = "disabled";



/****** KUULUTUSE ANDMETE SALVESTAMISVORMI PHP ******/
	
	if(isset($_POST["model"]) && isset($_POST["description"]) && isset($_POST["price"]) && isset($_POST["heading"]) &&
		!empty($_POST["model"]) && !empty($_POST["description"]) && !empty($_POST["price"]) && !empty($_POST["heading"])
		) {
		$Sneakers->savesneaker($Helper->cleanInput($_POST["heading"]), $Helper->cleanInput($_POST["model"]), $Helper->cleanInput($_POST["description"]), $Helper->cleanInput($_POST["price"]));
		
		$submitBtn = "disabled";
		$submitUploadBtn = "";
	}
		



/*** muutujad ***/

$recentPostData = $Sneakers->getRecentPost();
$recentPostId = $recentPostData->id;
$primaryPicture = 0;

$alertMsg = "";



/****** UPLOAD PHP ******/

if(isset($_FILES["fileToUpload"]) && !empty($_FILES["fileToUpload"]["name"])) {
	
	$uploadName = $_FILES["fileToUpload"]["name"];
	$target_dir = "../uploads/";
	$target_file = $target_dir.basename($uploadName);
	$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
	
	$uploadName = uniqid().".".$imageFileType;
	$target_file = $target_dir.basename($uploadName);
	$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
	
	$uploadTmp = $_FILES["fileToUpload"]["tmp_name"];
	$uploadSize = $_FILES["fileToUpload"]["size"];
	
	$uploadOk = 1;
	
// kontroll kas on pilt
	if(isset($_POST["submitUpload"])) {
		$check = getimagesize($uploadTmp);
		if($check !== false) {
			echo "<br>Fail on pilt - ".$check["mime"].".";
			$uploadOk = 1;
			
		} else {
			echo "<br>Fail ei ole pilt.";
			$upload = 0;
		}
	}
	
// kontroll kas failinimi on unikaalne
	if(file_exists($target_file)) {
		echo "<br>Sellise nimega fail on juba olemas";
		$uploadOk = 0;
	}
	
// pildiformaatide kontroll
	if($imageFileType != "jpg" &&
		$imageFileType != "png" &&
		$imageFileType != "jpeg" &&
		$imageFileType != "gif") {
			echo "<br>Ainult .jpg, .jpeg, .png ja .gif formaadid on lubatud";
			$uploadOk = 0;
		}
	
// faili suuruse kontroll
	if($uploadSize > 5000000) {
		echo "<br>Fail on liiga suur.";
		$uploadOk = 0;
	}


// kui eelnevad kontrollid läbitud, siis uploadib pildi
	if($uploadOk == 0) {
		echo "<br>Faili ei ole üles laetud.";
		$alertMsg = "<div class='alert alert-warning' role='alert'>Faili ei ole üles laetud</div>";
		
	} else {
		if (move_uploaded_file($uploadTmp, $target_file)) {
			echo "<br>Pilt nimega ".basename($uploadName)." on üles laetud</div>";
			
			$alertMsg = "<div class='alert alert-success' role='alert'>Pilt on üles laetud!</div>";
			$primaryPicture = 1;
			
			$Sneakers->uploadImages($uploadName, $recentPostId, $primaryPicture);
			
			$submitBtn = "";
			$submitUploadBtn = "disabled";
			
			//header("Location: data.php?upload=true");
			//exit();
			
			
		} else {
			echo "<br>Üleslaadimisel ilmnes tõrge.";
			$alertMsg = "<div class='alert alert-danger' role='alert'>Üleslaadimisel ilmnes tõrge</div>";
		}
	}
}









require("../header.php"); 
?>



<div class="container">
	
	
<!-- **** KUULUTUSTE LEHE ALAMMENÜÜ **** -->
	
	<ul class="nav nav-tabs">
		<li role="presentation" class="active"><a href="#">Loo kuulutus</a></li>
		<li role="presentation"><a href="myposts.php">Minu kuulutused</a></li>
	</ul>
	
	
<!-- **** KUULUTUSE PÕHIANDMETE SISESTAMISVÄLJAD **** -->
	
	<div class="row">
		<div class="col-md-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Uus kuulutus</h3>
				</div>
				<div class="panel-body">
					<form method="POST">
						<fieldset <?php echo $submitBtn; ?>>
						
							<div class="form-group">
								<label for="heading">Pealkiri</label>
								<input type="text" name="heading" class="form-control" placeholder="kuulutuse pealkiri" id="heading">
							</div>
						
							<div class="form-group">
								<label for="model">Mudel</label>
								<input type="text" name="model" class="form-control" placeholder="mudeli nimi" id="model">
							</div>
						
							<div class="form-group">	
								<label for="price">Hind</label>
								<input type="integer" name="price" class="form-control" placeholder="ex. 490" id="price">
							</div>

							<div class="form-group">
								<label for="description">Kirjeldus</label>
								<textarea type="text" name="description" cols="40" rows="2" maxlength="50" placeholder="ex. Air Jordan X Retro 'OVO', size 43" class="form-control" id="description"></textarea>
							</div>
							
							<div class="form-group">
								<input type="submit" name="submit" value="Loo uus kuulutus" class="btn btn-success">
							</div>
							
						</fieldset>
					</form>
				</div>
			</div>
		</div>
		
		
<!-- **** VIIMATI LISATUD KUULUTUSE PREVIEW **** -->
		
		<div class="col-md-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Sinu viimati lisatud kuulutus</h3>
				</div>
				<div class="panel-body">
				
					<form method="POST" class="form-horizontal">
						<div class="form-group">
							<label class="col-md-2 control-label">Pealkiri</label>
							<div class="col-md-9 col-md-offset-1">
								<p class="form-control-static"><?php echo $recentPostData->heading; ?></p>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-md-2 control-label">Mudel</label>
							<div class="col-md-9 col-md-offset-1">
								<p class="form-control-static"><?php echo $recentPostData->model; ?></p>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-md-2 control-label">Hind</label>
							<div class="col-md-9 col-md-offset-1">
								<p class="form-control-static"><?php echo $recentPostData->price." €"; ?></p>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-md-2 control-label">Kirjeldus</label>
							<div class="col-md-9 col-md-offset-1">
								<p class="form-control-static"><?php echo $recentPostData->description; ?></p>
							</div>
						</div>
					</form>
					
<?php

	//echo $recentPostData->heading."<br>".$recentPostData->model."<br>".$recentPostData->price."<br>".$recentPostData->description."<br>";
	//echo "Userid: ".$_SESSION["userId"]."<br>Recent post id: ".$recentPostId;



?>
					
					
				</div>
			</div>		
		</div>		
		
		
<!-- **** KUULUTUSELE PEAMISE (ESILEHE) PILDI LISAMISE PANEL **** -->
		
		<div class="col-md-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Lisa kuulutuse esilehe pilt</h3>
				</div>
				<div class="panel-body">
					<form action="data.php" method="post" enctype="multipart/form-data">
						<fieldset <?php echo $submitUploadBtn; ?>>
						
							<div class="form-group">
								<div>
									<?php echo $alertMsg; ?>
								</div>
								
								<label for="fileToUpload">Uploadi pilt:</label><br>
								<label class="btn btn-default btn-file" for="fileToUpload">
									<span class="glyphicon glyphicon-folder-open"></span>
									&nbsp;Vali...<input type="file" name="fileToUpload" id="fileToUpload" style="display: none;">
								</label>
							</div>

							<div class="form-group">
								<input type="submit" name="submitUpload" value="Lisa pilt" class="btn btn-success">
							</div>
						
						</fieldset>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
	
	


<!--
	<h2>Market</h2>
	<form>
		<input type="search" name="q" value="<?=$q;?>">
		<input type="submit" value="Search"><br><br>
	</form>
-->
	


	



<?php require("../footer.php"); ?>