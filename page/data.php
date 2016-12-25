<?php

	require("../functions.php");

	//kui ei ole kasutaja id'd suunan sisselogimise lehele
	if(!isset($_SESSION["userId"])){
		header("Location: login.php");
		exit();
	}

	//logout
	if(isset($_GET["logout"])){
		session_destroy();
		header("Location: login.php");
		exit();
	}

	//kuulutuse lisamisvormi php
	if(isset($_POST["contactemail"]) && isset($_POST["description"]) && isset($_POST["price"]) &&
		!empty($_POST["contactemail"]) && !empty($_POST["description"]) && !empty($_POST["price"])
		) {
		$Sneakers->savesneaker($Helper->cleanInput($_POST["contactemail"]), $Helper->cleanInput($_POST["description"]), $Helper->cleanInput($_POST["price"]));
	}
	
	

	
?>


<?php
// --- UPLOAD PHP ---

$alertMsg = "";

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
	
	// kontroll kas failinime on unikaalne
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
			$alertMsg = "<div class='alert alert-success' role='alert'>Pilt on üles laetud!";
			
			$Sneakers->uploadImages($uploadName, $Helper->cleanInput($_POST["description"]));
			
		} else {
			echo "<br>Üleslaadimisel ilmnes tõrge.";
			$alertMsg = "<div class='alert alert-danger' role='alert'>Üleslaadimisel ilmnes tõrge</div>";
		}
	}
	
}



?>




<?php require("../header.php"); ?>

<div class="container">
	
	<ul class="nav nav-tabs">
		<li role="presentation" class="active"><a href="#">Loo kuulutus</a></li>
		<li role="presentation"><a href="myposts.php">Minu kuulutused</a></li>
	</ul>

	<div class="row">
		<div class="col-md-3">
			<h3>Create a post</h3>
			<form method="POST">
				<div class="form-group">	
					<label for="price">Price ($)</label>
					<input type="integer" name="price" class="form-control" placeholder="ex. 490" id="price">
				</div>
				
				<div class="form-group">
					<label for="contact-email">Contact E-Mail</label>
					<input type="text" name="contactemail" value="<?=$_SESSION["userEmail"];?>" class="form-control" id="contact-email">
				</div>
				
				<div class="form-group">
					<input type="submit" value="Save & Post" class="btn btn-success">
				</div>
			</form>
			
			<h3>Upload an image</h3>
			<form action="data.php" method="post" enctype="multipart/form-data">
				
				<div class="form-group">
					<div>
						<?php echo $alertMsg; ?>
					</div>
					<label for="fileToUpload">Uploadi pilt:</label><br>
					<label class="btn btn-primary" for="fileToUpload">
						<span class="glyphicon glyphicon-folder-open"></span>
						<input type="file" name="fileToUpload" id="fileToUpload" style="display: none;">
						Browse
					</label>
				</div>
				
				<div class="form-group">
					<label for="description">Description</label>
					<textarea type="text" name="description" cols="40" rows="2" maxlength="50" placeholder="ex. Air Jordan X Retro 'OVO', size 43" class="form-control" id="description"></textarea>
				</div>
				
				<div class="form-group">
					<input type="submit" name="submitUpload" value="Upload Image" class="btn btn-success">
				</div>	
			</form>
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