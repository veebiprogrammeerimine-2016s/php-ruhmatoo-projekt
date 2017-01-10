<?php

require("../functions.php");

	if(!isset($_SESSION["userId"])) {
		header("Location: login.php");
		exit();
	}

	if(isset($_GET["logout"])) {
		session_destroy();
		header("Location: login.php");
		exit();
	}
	
	if($_SESSION["userlevel"] != 2) {
		header("Location: sneakermarket.php");
		exit();
	}


	

$currentId = $_GET["id"];


$recentPostData = $Sneakers->getRecentPostInfo($currentId);

$recentPostHeading = $recentPostData->heading;
$recentPostBrand = $recentPostData->brand;
$recentPostModel = $recentPostData->model;
$recentPostSize = $recentPostData->size;
$recentPostType = $recentPostData->type;
$recentPostCondition = $recentPostData->condition;
$recentPostPrice = $recentPostData->price;
$recentPostDescription = $recentPostData->description;



if(isset($_POST["model"]) && isset($_POST["description"]) && isset($_POST["price"]) && isset($_POST["heading"]) && isset($_POST["brand"]) && isset($_POST["type"]) && isset($_POST["condition"]) &&
	!empty($_POST["model"]) && !empty($_POST["description"]) && !empty($_POST["price"]) && !empty($_POST["heading"]) && !empty($_POST["brand"]) && !empty($_POST["type"]) && !empty($_POST["condition"])) {
		
		$updateStatus = 4;
		$Sneakers->savesneaker($currentId, $Helper->cleanInput($_POST["heading"]), $Helper->cleanInput($_POST["brand"]), $Helper->cleanInput($_POST["model"]), $Helper->cleanInput($_POST["size"]), $Helper->cleanInput($_POST["type"]), $Helper->cleanInput($_POST["condition"]), $Helper->cleanInput($_POST["description"]), $Helper->cleanInput($_POST["price"]), $updateStatus);
		
		$recentPostData = $Sneakers->getRecentPostInfo($currentId);
		$recentId = $recentPostData->id;
		$Sneakers->deletePreviousPostVersions($currentId, $recentId);
		
		header("Location: adminedit.php?id=".$currentId);
		exit();
	}
	
	if(isset($_POST["delete"])) {
		
		$Sneakers->deleteUnfinishedPost($currentId);
		
		header("Location: admin.php");
		exit();
	}


$maleShoes = "";
$femaleShoes = "";
	
	if($recentPostType == "male") {
		$maleShoes = "checked";
	} else {
		if($recentPostType == "female") {
			$femaleShoes = "checked";
		}
	}
	
	
$usedShoes = "";
$newShoes = "";
	
	if($recentPostCondition == "used") {
		$usedShoes = "checked";
	} else {
		if($recentPostCondition == "new") {
			$newShoes = "checked";
		}
	}


	
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
			
			$Sneakers->uploadImages($uploadName, $currentId);
			
			
			
			//header("Location: data.php?upload=true");
			//exit();
			
			
		} else {
			echo "<br>Üleslaadimisel ilmnes tõrge.";
			$alertMsg = "<div class='alert alert-danger' role='alert'>Üleslaadimisel ilmnes tõrge</div>";
		}
	}
}
	
	
$imageInfo = $Sneakers->ifUserUploadedImage($currentId);
$imageCheck = $imageInfo->imagecheck;

	if($imageCheck == 0) {
		$imageData = "";
	} else {
		$imageData = $Sneakers->getImageData($currentId);
		$imageName = $imageData->name;
		
		//echo "Image name: ".$imageName."<br>";
	}


$displayedImage = "";

	if($imageCheck == 0) {
		$displayedImage = "../uploads/default.png";
	} else {
		$displayedImage = "../uploads/".$imageName;
	}
	
	
	if(isset($_POST["submitUpload"])) {
		
		$recentImageInfo = $Sneakers->getImageData($currentId);
		$recentImageId = $recentImageInfo->id;		
		
		$Sneakers->deletePreviousImages($currentId, $recentImageId);
		
		header("Location: adminedit.php?id=".$currentId);
		exit();
	}

	
	if(isset($_POST["submitDefaultPic"])) {
		
		$Sneakers->uploadImages("default.png", $currentId);
		
		$recentImageInfo = $Sneakers->getImageData($currentId);
		$recentImageId = $recentImageInfo->id;
		
		$Sneakers->deletePreviousImages($currentId, $recentImageId);
		
		header("Location: adminedit.php?id=".$currentId);
		exit();
		
	}
































require("../header.php");
?>



<div class="container">

	<ul class="nav nav-tabs">
		<li role="presentation"><a href="createpost.php">Uus kuulutus</a></li>
		<li role="presentation"><a href="myposts.php">Minu kuulutused</a></li>
		<li role="presentation" class="active"><a href="#">Kuulutuse muutmine</a></li>
	</ul>
	
	<div>
		<h3></h3>
	</div>


	<div class="row">
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-body">
				
					<form method="POST">
						
						<div class="form-group">
							<label for="heading">Pealkiri</label>
							<input type="text" name="heading" class="form-control" placeholder="Kuulutuse pealkiri" id="heading" value="<?php echo $recentPostHeading; ?>">
						</div>
						
						<div class="form-group">
							<label for="brand">Bränd</label>
							<input type="text" name="brand" class="form-control" placeholder="Bränd" id="brand" value="<?php echo $recentPostBrand; ?>">
						</div>
					
						<div class="form-group">
							<label for="model">Mudel</label>
							<input type="text" name="model" class="form-control" placeholder="Mudeli nimi" id="model" value="<?php echo $recentPostModel; ?>">
						</div>
						
						<div class="form-group">
							<label for="size">Suurus</label>
							<input type="text" name="size" class="form-control" placeholder="Jalanumbrile" id="size" value="<?php echo $recentPostSize; ?>">
						</div>
						
						
						<div>
							<label>Tüüp</label>
							<div class="radio">
								<label>
									<input type="radio" name="type" id="type1" value="male" <?php echo $maleShoes; ?>> Meeste jalanõud
								</label>
							</div>
							<div class="radio">
								<label>
									<input type="radio" name="type" id="type2" value="female" <?php echo $femaleShoes; ?>> Naiste jalanõud
								</label>
							</div>
						</div>
						
						
						<div>
							<label>Seisukord</label>
							<div class="radio">
								<label>
									<input type="radio" name="condition" id="condition1" value="used" <?php echo $usedShoes; ?>> Kasutatud
								</label>
							</div>
							<div class="radio">
								<label>
									<input type="radio" name="condition" id="condition2" value="new" <?php echo $newShoes; ?>> Uued
								</label>
							</div>
						</div>
						
					
						<div class="form-group">	
							<label for="price">Hind</label>
							<input type="integer" name="price" class="form-control" placeholder="€" id="price" value="<?php echo $recentPostPrice; ?>">
						</div>

						<div class="form-group">
							<label for="description">Kirjeldus</label>
							<textarea type="text" name="description" cols="40" rows="2" maxlength="50" placeholder="Lühikirjeldus" class="form-control" id="description"><?php echo $recentPostDescription; ?></textarea>
						</div>
						
						<div class="form-group">
							<input type="submit" name="submit" value="Salvesta muudatused" class="btn btn-success btn-lg btn-block">
						</div>

					</form>
					
					<form method="POST">
						<div class="form-group">
							<input type="submit" name="delete" value="Kustuta kuulutus" class="btn btn-danger">
						</div>
					</form>
					
				</div>
			</div>
		</div>
		
		
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-body">
					
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">								
								<p class="form-control-static"><img src="../uploads/<?php echo $displayedImage; ?>" class="img-thumbnail"></p>
							</div>
						</div>
						
						<div class="col-md-12">
							<form action="adminedit.php?id=<?php echo $_GET["id"]; ?>" method="POST" enctype="multipart/form-data">					
								<div class="form-group">
									<label for="fileToUpload">Uploadi pilt:</label><br>
									<label class="btn btn-default btn-file" for="fileToUpload">
										<span class="glyphicon glyphicon-folder-open"></span>
										&nbsp;Vali&hellip;<input type="file" name="fileToUpload" id="fileToUpload" style="display: none;">
									</label>
								</div>
								
								<div class="form-group">
									<input type="submit" name="submitUpload" value="Lisa pilt" class="btn btn-success btn-lg btn-block">
								</div>
							</form>
						</div>
						
						<div class="col-md-12">
							<form method="POST">
								<div class="form-group">
									<input type="submit" name="submitDefaultPic" value="Eemalda pilt" class="btn btn-danger">
								</div>
							</form>
						</div>
				
				
					</div>
				</div>
			</div>
		</div>
		
		
	</div>
</div>






















