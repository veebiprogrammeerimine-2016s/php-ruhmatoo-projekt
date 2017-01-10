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

//suunab tagasi kui ei ole postid'd
	if(!isset($_GET["id"])) {
		header("Location: data.php");
		exit();
	}


/*** muutujad ***/
/* poststatus määrab ära millal mingi nupp kuulutuse loomise protsessis aktiveeritakse või desaktiveeritakse */
$postStatus = 9;

$currentId = $_GET["id"];

$alertMsg = "";


/* kontroll kas kasutaja on varem kuulutuse info tabelisse 'sm_postinfo' midagi sisestanud */
$pcheck = $Sneakers->ifUserHasCreatedPostInfo($currentId);
$postInfoCheck = $pcheck->postcheck;


/* saan käimasoleva kuulutuse id */
$sm_postsId = $Sneakers->getNewPostId();
$postsId = $sm_postsId->id;


/* saan viimati loodud kuulutuse id kuulutuse info tabelist 'sm_postinfo' */
	if($postInfoCheck == 0) {
		$postinfoId = 0;
		//echo "sm_postinfo id: ".$postinfoId."<br>";
		
	} else {
		$sm_postinfoId = $Sneakers->getRecentPostId($currentId);
		$postinfoId = $sm_postinfoId->postid;
		
		//echo "sm_postinfo id: ".$postinfoId."<br>";
	}



/* ajutised echod */
//echo "sm_postinfo postcheck: ".$postInfoCheck."<br>";
//echo "sm_posts id: ".$postsId."<br>";


/* kui kuulutuse id tabelis 'sm_postinfo' on väiksem kui kuulutuse id tabelis 'sm_posts' tähendab, et uut kuulutust on alustatud aga andmeid pole veel sisestatud */
	if($postsId > $postinfoId) {
		
		$recentPostHeading = "";
		$recentPostBrand = "";
		$recentPostModel = "";
		$recentPostSize = "";
		$recentPostType = "";
		$recentPostCondition = "";
		$recentPostPrice = "";
		$recentPostDescription = "";
		
	} else {
		
		$recentPostData = $Sneakers->getRecentPostInfo($_GET["id"]);
		$postStatus = $recentPostData->status;
		
		$recentPostHeading = $recentPostData->heading;
		$recentPostBrand = $recentPostData->brand;
		$recentPostModel = $recentPostData->model;
		$recentPostSize = $recentPostData->size;
		$recentPostType = $recentPostData->type;
		$recentPostCondition = $recentPostData->condition;
		$recentPostPrice = $recentPostData->price;
		$recentPostDescription = $recentPostData->description;
		
	}

/* kui aadressireal olev id ei klapi viimase kasutaja poolt loodud kuulutuse id'ga, suunatakse õige id'ga kuulutuse loomise lehele tagasi */
	if($_GET["id"] != $postsId) {
		header("Location: createpost.php?id=".$postsId);
		exit();
	}



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
			
			$Sneakers->uploadImages($uploadName, $currentId);
			
			
			
			//header("Location: data.php?upload=true");
			//exit();
			
			
		} else {
			echo "<br>Üleslaadimisel ilmnes tõrge.";
			$alertMsg = "<div class='alert alert-danger' role='alert'>Üleslaadimisel ilmnes tõrge</div>";
		}
	}
}



//echo "current id: ".$currentId."<br>";

$imageInfo = $Sneakers->ifUserUploadedImage($currentId);
$imageCheck = $imageInfo->imagecheck;


$updateStatus = "";


	if(isset($_POST["submitUpload"])) {
		
		if($imageCheck == 0) {
		
		$updateStatus = 2;
		$Sneakers->updatePostStatus($updateStatus, $currentId);
		$Sneakers->uploadImages("default.png", $currentId);
		
		$recentImageInfo = $Sneakers->getImageData($currentId);
		$recentImageId = $recentImageInfo->id;
		
		$Sneakers->deletePreviousImages($currentId, $recentImageId);
		
		header("Location: createpost.php?id=".$currentId);
		exit();	
			
		} else {
		
		$updateStatus = 2;
		$Sneakers->updatePostStatus($updateStatus, $currentId);
		
		$recentImageInfo = $Sneakers->getImageData($currentId);
		$recentImageId = $recentImageInfo->id;
		
		$Sneakers->deletePreviousImages($currentId, $recentImageId);
		
		header("Location: createpost.php?id=".$currentId);
		exit();	
			
		}
	}
	

	if(isset($_POST["backToData"])) {
		
		$updateStatus = 0;
		$Sneakers->updatePostStatus($updateStatus, $currentId);
		
		header("Location: createpost.php?id=".$currentId);
		exit();
	}
	
	
	if(isset($_POST["cancelModifyData"]) && $imageCheck == 0) {
		
		$updateStatus = 1;
		$Sneakers->updatePostStatus($updateStatus, $currentId);
		
		header("Location: createpost.php?id=".$currentId);
		exit();
	}
	
	
	if(isset($_POST["backToUpload"])) {
		
		$updateStatus = 3;
		$Sneakers->updatePostStatus($updateStatus, $currentId);
		
		header("Location: createpost.php?id=".$currentId);
		exit();
	}
	
	
	if(isset($_POST["cancelModifyUpload"])) {
		
		if($postStatus == 3) {
			
			$updateStatus = 2;
			$Sneakers->updatePostStatus($updateStatus, $currentId);
			
			header("Location: createpost.php?id=".$currentId);
			exit();
			
		} else {
			
			$updateStatus = 2;
			$Sneakers->updatePostStatus($updateStatus, $currentId);
			
			$Sneakers->uploadImages("default.png", $currentId);
			
			header("Location: createpost.php?id=".$currentId);
			exit();
			
		}
	}
	
	
	if(isset($_POST["submitDefaultPic"])) {
		
		$updateStatus = 2;
		$Sneakers->updatePostStatus($updateStatus, $currentId);
		
		$Sneakers->uploadImages("default.png", $currentId);
		
		$recentImageInfo = $Sneakers->getImageData($currentId);
		$recentImageId = $recentImageInfo->id;
		
		$Sneakers->deletePreviousImages($currentId, $recentImageId);
		
		header("Location: createpost.php?id=".$currentId);
		exit();
	}
	
	
	if(isset($_POST["cancelModifyData"]) && $imageCheck == 1) {
		
		$updateStatus = 2;
		$Sneakers->updatePostStatus($updateStatus, $currentId);
		
		header("Location: createpost.php?id=".$currentId);
		exit();
	}
	
	
	
	
	/*if(isset($_POST["submit"])) {
		$postStatus = 0;
	}*/


/*** KUULUTUSE ANDMETE SALVESTAMISVORMI PHP ***/
	
	if(isset($_POST["model"]) && isset($_POST["description"]) && isset($_POST["price"]) && isset($_POST["heading"]) && isset($_POST["brand"]) && isset($_POST["type"]) && isset($_POST["condition"]) &&
		!empty($_POST["model"]) && !empty($_POST["description"]) && !empty($_POST["price"]) && !empty($_POST["heading"]) && !empty($_POST["brand"]) && !empty($_POST["type"]) && !empty($_POST["condition"])
		) {
		
		if($imageCheck != 1) {
			
			$updateStatus = 1;
			$Sneakers->savesneaker($_GET["id"], $Helper->cleanInput($_POST["heading"]), $Helper->cleanInput($_POST["brand"]), $Helper->cleanInput($_POST["model"]), $Helper->cleanInput($_POST["size"]), $Helper->cleanInput($_POST["type"]), $Helper->cleanInput($_POST["condition"]), $Helper->cleanInput($_POST["description"]), $Helper->cleanInput($_POST["price"]), $updateStatus);
		
			$recentPostData = $Sneakers->getRecentPostInfo($_GET["id"]);
			$postStatus = $recentPostData->status;
			//$postStatus = 0;
			$recentId = $recentPostData->id;
			
			$Sneakers->deletePreviousPostVersions($currentId, $recentId);
			
			header("Location: createpost.php?id=".$currentId);
			exit();
			
		} else {
			
			$updateStatus = 2;
			$Sneakers->savesneaker($_GET["id"], $Helper->cleanInput($_POST["heading"]), $Helper->cleanInput($_POST["brand"]), $Helper->cleanInput($_POST["model"]), $Helper->cleanInput($_POST["size"]), $Helper->cleanInput($_POST["type"]), $Helper->cleanInput($_POST["condition"]), $Helper->cleanInput($_POST["description"]), $Helper->cleanInput($_POST["price"]), $updateStatus);
		
			$recentPostData = $Sneakers->getRecentPostInfo($_GET["id"]);
			$postStatus = $recentPostData->status;
			//$postStatus = 0;
			$recentId = $recentPostData->id;
			
			$Sneakers->deletePreviousPostVersions($currentId, $recentId);
			
			header("Location: createpost.php?id=".$currentId);
			exit();
		}
	}
	
	if(isset($_POST["finishPostSubmit"])) {
		
		$Sneakers->finishPost($_GET["id"]);
		
		header("Location: data.php");
		exit();
	}
	
	if(isset($_POST["cancelPostSubmit"])) {
		
		$Sneakers->deleteUnfinishedPost($currentId);
		$Sneakers->finishDeletedPost($currentId);
		
		header("Location: data.php");
		exit();
	}

	if($imageCheck == 0) {
		$imageData = "";
	} else {
		$imageData = $Sneakers->getImageData($currentId);
		$imageName = $imageData->name;
		
		//echo "Image name: ".$imageName."<br>";
	}


//echo "Image check: ".$imageCheck."<br>";


$displayedImage = "";

	if($imageCheck == 0) {
		$displayedImage = "../uploads/default.png";
	} else {
		$displayedImage = "../uploads/".$imageName;
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
	




//echo "<br> poststatus: ".$postStatus;


$postHeading = "";
$postBrand = "";
$postModel = "";
$postSize = "";
$postType = "";
$postCondition = "";
$postPrice = "";
$postDescription = "";

$formHeadingError = "";
$formBrandError = "";
$formModelError = "";
$formSizeError = "";
$formTypeError = "";
$formConditionError = "";
$formPriceError = "";
$formDescriptionError = "";



	if(isset($_POST["heading"] )) {
		if(empty($_POST["heading"] )) {
			$formHeadingError = "has-error";
		} else {
			$postHeading = $_POST["heading"];
		}
	}
	
	if(isset($_POST["brand"] )) {
		if(empty($_POST["brand"] )) {
			$formBrandError = "has-error";
		} else {
			$postBrand = $_POST["brand"];
		}
	}
	
	if(isset($_POST["model"] )) {
		if(empty($_POST["model"] )) {
			$formModelError = "has-error";
		} else {
			$postModel = $_POST["model"];
		}
	}
	
	if(isset($_POST["size"] )) {
		if(empty($_POST["size"] )) {
			$formSizeError = "has-error";
		} else {
			$postSize = $_POST["size"];
		}
	}
	
	if(isset($_POST["type"] )) {
		if(empty($_POST["type"] )) {
			$formTypeError = "has-error";
		} else {
			$postType = $_POST["type"];
		}
	}
	
	if(isset($_POST["condition"] )) {
		if(empty($_POST["condition"] )) {
			$formConditionError = "has-error";
		} else {
			$postCondition = $_POST["condition"];
		}
	}
	
	if(isset($_POST["price"] )) {
		if(empty($_POST["price"] )) {
			$formPriceError = "has-error";
		} else {
			$postPrice = $_POST["price"];
		}
	}
	
	if(isset($_POST["description"] )) {
		if(empty($_POST["description"] )) {
			$formDescriptionError = "has-error";
		} else {
			$postDescription = $_POST["description"];
		}
	}
	
	if($postType == "" && isset($_POST["submit"])) {
		$formTypeError = "has-error";
	}
	
	if($postCondition == "" && isset($_POST["submit"])) {
		$formConditionError = "has-error";
	}
	
	

//echo "<br>postheading: ".$postHeading;
//echo "<br>posttype: ".$postType;


$maleShoesType = "";
$femaleShoesType = "";
	
	if($postType == "male") {
		$maleShoesType = "checked";
	} else {
		if($postType == "female") {
			$femaleShoesType = "checked";
		}
	}


$usedShoesType = "";
$newShoesType = "";
	
	if($postCondition == "used") {
		$usedShoesType = "checked";
	} else {
		if($postCondition == "new") {
			$newShoesType = "checked";
		}
	}






























/*if(isset($_POST["submit"])) {
		$postStatus = 0;
	}*/










	
	
	


$submitBtn = "";
$submitUploadBtn = "disabled";
$finishPostBtn = "disabled";
$cancelPostSubmitBtn = "disabled";

$modifyDataBtn = "disabled";
$cancelModifyDataBtn = "disabled";
$modifyUploadBtn = "disabled";
$cancelModifyUploadBtn = "disabled";
$submitDefaultPicBtn = "disabled";

$dataPanelStatus = "panel-primary";
$uploadPanelStatus = "panel-default";
$finishPostPanelStatus = "panel-default";


$dataPanelSubmitBtn = "btn-success";
$dataPanelModifyBtn = "btn-default";
$dataPanelCancelBtn = "btn-default";

$uploadPanelSubmitBtn = "btn-default";
$uploadPanelModifyBtn = "btn-default";
$uploadPanelDeleteBtn = "btn-default";
$uploadPanelCancelBtn = "btn-default";

$finishPostPanelSubmitBtn = "btn-default";
$finishPostPanelDeleteBtn = "btn-default";


//echo "poststatus: ".$postStatus."<br>";

	if($postStatus === 0) {
		$submitBtn = "";
		$submitUploadBtn = "disabled";
		$finishPostBtn = "disabled";
		$cancelPostSubmitBtn = "disabled";
		
		$modifyDataBtn = "disabled";
		$cancelModifyDataBtn = "";
		$modifyUploadBtn = "disabled";
		$cancelModifyUploadBtn = "disabled";
		$submitDefaultPicBtn = "disabled";
		
		$dataPanelStatus = "panel-primary";
		$uploadPanelStatus = "panel-default";
		$finishPostPanelStatus = "panel-default";
		
		$dataPanelSubmitBtn = "btn-success";
		$dataPanelModifyBtn = "btn-default";
		$dataPanelCancelBtn = "btn-warning";

		$uploadPanelSubmitBtn = "btn-default";
		$uploadPanelModifyBtn = "btn-default";
		$uploadPanelDeleteBtn = "btn-default";
		$uploadPanelCancelBtn = "btn-default";

		$finishPostPanelSubmitBtn = "btn-default";
		$finishPostPanelDeleteBtn = "btn-default";
	}

	if($postStatus == 1) {
		$submitBtn = "disabled";
		$submitUploadBtn = "";
		$finishPostBtn = "disabled";
		$cancelPostSubmitBtn = "";
		
		$modifyDataBtn = "";
		$cancelModifyDataBtn = "disabled";
		$modifyUploadBtn = "disabled";
		$cancelModifyUploadBtn = "";
		$submitDefaultPicBtn = "disabled";
		
		$dataPanelStatus = "panel-default";
		$uploadPanelStatus = "panel-primary";
		$finishPostPanelStatus = "panel-default";
		
		$dataPanelSubmitBtn = "btn-default";
		$dataPanelModifyBtn = "btn-primary";
		$dataPanelCancelBtn = "btn-default";

		$uploadPanelSubmitBtn = "btn-success";
		$uploadPanelModifyBtn = "btn-default";
		$uploadPanelDeleteBtn = "btn-default";
		$uploadPanelCancelBtn = "btn-warning";

		$finishPostPanelSubmitBtn = "btn-default";
		$finishPostPanelDeleteBtn = "btn-danger";
	}

	if($postStatus == 2) {
		$submitBtn = "disabled";
		$submitUploadBtn = "disabled";
		$finishPostBtn = "";
		$cancelPostSubmitBtn = "";
		
		$modifyDataBtn = "";
		$cancelModifyDataBtn = "disabled";
		$modifyUploadBtn = "";
		$cancelModifyUploadBtn = "disabled";
		$submitDefaultPicBtn = "disabled";
		
		$dataPanelStatus = "panel-default";
		$uploadPanelStatus = "panel-default";
		$finishPostPanelStatus = "panel-primary";
		
		$dataPanelSubmitBtn = "btn-default";
		$dataPanelModifyBtn = "btn-primary";
		$dataPanelCancelBtn = "btn-default";

		$uploadPanelSubmitBtn = "btn-default";
		$uploadPanelModifyBtn = "btn-primary";
		$uploadPanelDeleteBtn = "btn-default";
		$uploadPanelCancelBtn = "btn-default";

		$finishPostPanelSubmitBtn = "btn-success";
		$finishPostPanelDeleteBtn = "btn-danger";
	}
	
	if($postStatus == 3) {
		$submitBtn = "disabled";
		$submitUploadBtn = "";
		$finishPostBtn = "disabled";
		$cancelPostSubmitBtn = "disabled";
		
		$modifyDataBtn = "disabled";
		$cancelModifyDataBtn = "disabled";
		$modifyUploadBtn = "disabled";
		$cancelModifyUploadBtn = "";
		$submitDefaultPicBtn = "";
		
		$dataPanelStatus = "panel-default";
		$uploadPanelStatus = "panel-primary";
		$finishPostPanelStatus = "panel-default";
		
		$dataPanelSubmitBtn = "btn-default";
		$dataPanelModifyBtn = "btn-default";
		$dataPanelCancelBtn = "btn-default";

		$uploadPanelSubmitBtn = "btn-success";
		$uploadPanelModifyBtn = "btn-default";
		$uploadPanelDeleteBtn = "btn-danger";
		$uploadPanelCancelBtn = "btn-warning";

		$finishPostPanelSubmitBtn = "btn-default";
		$finishPostPanelDeleteBtn = "btn-default";
	}
	
	


	



require("../header.php"); 
?>

<!--AJUTINE KONTROLLPANEEL

<div class="container">
	<div class="panel panel-default">
		<div class="panel-body">
			<div class="row">
			
				<div class="col-md-2">
					<?php //echo "sm_posts id: ".$postsId; ?><br>
					<?php //echo "sm_postinfo id: ".$postinfoId; ?>
				</div>
				
				<div class="col-md-2">
					<?php //echo "<br>sm_postinfo postcheck: ".$postInfoCheck; ?>
				</div>
				
				<div class="col-md-2">
					<?php //echo "<br>Image check: ".$imageCheck; ?>
				</div>
				
				<div class="col-md-2">
					<?php //echo "<br>poststatus: ".$postStatus; ?>
				</div>
				
			</div>
		</div>
	</div>
</div>

-->


<div class="container">
	
	
<!-- **** KUULUTUSTE LEHE ALAMMENÜÜ **** -->
	
	<ul class="nav nav-tabs">
		<li role="presentation" class="active"><a href="#">Uus kuulutus</a></li>
		<li role="presentation"><a href="myposts.php">Minu kuulutused</a></li>
		<li role="presentation" class="disabled"><a href="#">Kuulutuse muutmine</a></li>
	</ul>
	
	<div>
		<h3></h3>
	</div>
	
<!-- **** KUULUTUSE PÕHIANDMETE SISESTAMISVÄLJAD **** -->
	
	<div class="row">
		<div class="col-md-4">
			<div class="panel <?php echo $dataPanelStatus; ?>">
				<div class="panel-heading">
					<h3 class="panel-title">Salvesta kuulutuse andmed</h3>
				</div>
				<div class="panel-body">
					<form method="POST">
						<fieldset <?php echo $submitBtn; ?>>
						
							<div class="form-group <?php echo $formHeadingError; ?>">
								<label class="control-label" for="heading">Pealkiri</label>
								<input type="text" name="heading" class="form-control" placeholder="Kuulutuse pealkiri" id="heading" value="<?php if($postStatus == 9) {echo $postHeading;} else {echo $recentPostHeading;} ?>">
							</div>
							
							<div class="form-group <?php echo $formBrandError; ?>">
								<label class="control-label" for="brand">Bränd</label>
								<input type="text" name="brand" class="form-control" placeholder="Bränd" id="brand" value="<?php if($postStatus == 9) {echo $postBrand;} else {echo $recentPostBrand;} ?>">
							</div>
						
							<div class="form-group <?php echo $formModelError; ?>">
								<label class="control-label" for="model">Mudel</label>
								<input type="text" name="model" class="form-control" placeholder="Mudeli nimi" id="model" value="<?php if($postStatus == 9) {echo $postModel;} else {echo $recentPostModel;} ?>">
							</div>
							
							<div class="form-group <?php echo $formSizeError; ?>">
								<label class="control-label" for="size">Suurus</label>
								<input type="integer" name="size" class="form-control" placeholder="Jalanumbrile" id="size" value="<?php if($postStatus == 9) {echo $postSize;} else {echo $recentPostSize;} ?>">
							</div>
						
							
							<div class="<?php echo $formTypeError; ?>">
								<label class="control-label">Tüüp</label>
								<div class="radio">
									<label>
										<input type="radio" name="type" id="type1" value="male" <?php echo $maleShoesType; ?><?php echo $maleShoes; ?>> Meeste jalanõud
									</label>
								</div>
								<div class="radio">
									<label>
										<input type="radio" name="type" id="type2" value="female" <?php echo $femaleShoesType; ?><?php echo $femaleShoes; ?>> Naiste jalanõud
									</label>
								</div>
							</div>
							
							
							<div class="<?php echo $formConditionError; ?>">
								<label class="control-label">Seisukord</label>
								<div class="radio">
									<label>
										<input type="radio" name="condition" id="condition1" value="used" <?php echo $usedShoesType; ?><?php echo $usedShoes; ?>> Kasutatud
									</label>
								</div>
								<div class="radio">
									<label>
										<input type="radio" name="condition" id="condition2" value="new" <?php echo $newShoesType; ?><?php echo $newShoes; ?>> Uued
									</label>
								</div>
							</div>
							

							<div class="form-group <?php echo $formPriceError; ?>">	
								<label class="control-label" for="price">Hind</label>
								<input type="integer" name="price" class="form-control" placeholder="€" id="price" value="<?php if($postStatus == 9) {echo $postPrice;} else {echo $recentPostPrice;} ?>">
							</div>
							
							<div class="form-group <?php echo $formDescriptionError; ?>">
								<label class="control-label" for="description">Kirjeldus</label>
								<textarea type="text" name="description" cols="40" rows="2" maxlength="50" placeholder="Lühikirjeldus" class="form-control" id="description"><?php if($postStatus == 9) {echo $postDescription;} else {echo $recentPostDescription;} ?></textarea>
							</div>
							
							<div class="form-group">
								<input type="submit" name="submit" value="Salvesta andmed" class="btn <?php echo $dataPanelSubmitBtn; ?> btn-lg btn-block">
							</div>
							
						</fieldset>
					</form>
					
					
					<form method="POST">
						<div class="form-group">
							<button type="submit" name="backToData" class="btn <?php echo $dataPanelModifyBtn; ?>" <?php echo $modifyDataBtn; ?>>Muuda andmeid</button>
							<button type="submit" name="cancelModifyData" class="btn <?php echo $dataPanelCancelBtn; ?>" <?php echo $cancelModifyDataBtn; ?>>Loobu</button>
						</div>
					</form>		


				</div>
			</div>
		</div>
		
		
<!-- **** VIIMATI LISATUD KUULUTUSE PREVIEW **** -->
		
		<div class="col-md-4">
			<div class="panel <?php echo $finishPostPanelStatus; ?>">
				<div class="panel-heading">
					<h3 class="panel-title">Sinu loodava kuulutuse eelvaade</h3>
				</div>
				<div class="panel-body">
					<form method="POST" class="form-horizontal">
						<fieldset <?php echo $finishPostBtn; ?>>
							
							<div class="form-group">
								<label class="col-md-2 control-label">Pealkiri</label>
								<div class="col-md-9 col-md-offset-1">
									<p class="form-control-static"><?php echo $recentPostHeading; ?></p>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-md-2 control-label">Bränd</label>
								<div class="col-md-9 col-md-offset-1">
									<p class="form-control-static"><?php echo $recentPostBrand; ?></p>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-md-2 control-label">Mudel</label>
								<div class="col-md-9 col-md-offset-1">
									<p class="form-control-static"><?php echo $recentPostModel; ?></p>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-md-2 control-label">Suurus</label>
								<div class="col-md-9 col-md-offset-1">
									<p class="form-control-static"><?php echo $recentPostSize; ?></p>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-md-2 control-label">Tüüp</label>
								<div class="col-md-9 col-md-offset-1">
									<p class="form-control-static"><?php if($recentPostType == "male") {echo "Meeste jalanõud";} else {if($recentPostType == "female") {echo "Naiste jalanõud";} else {echo "";}} ?></p>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-md-2 control-label">Seisukord</label>
								<div class="col-md-9 col-md-offset-1">
									<p class="form-control-static"><?php if($recentPostCondition == "used") {echo "Kasutatud";} else {if($recentPostCondition == "new") {echo "Uued";} else {echo "";}} ?></p>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-md-2 control-label">Hind</label>
								<div class="col-md-9 col-md-offset-1">
									<p class="form-control-static"><?php echo $recentPostPrice; ?></p>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-md-2 control-label">Kirjeldus</label>
								<div class="col-md-9 col-md-offset-1">
									<p class="form-control-static"><?php echo $recentPostDescription; ?></p>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-md-1 control-label">Pilt</label>
								<div class="col-md-8 col-md-offset-1">
									<p class="form-control-static"><img src="../uploads/<?php echo $displayedImage; ?>" class="img-thumbnail"></p>
								</div>
							</div>
							
							<div class="form-group">
								<div class="col-md-12">
									<input type="submit" name="finishPostSubmit" value="Loo uus kuulutus" class="btn <?php echo $finishPostPanelSubmitBtn; ?> btn-lg btn-block">
								</div>
							</div>
							
						</fieldset>						
					</form>
					
					<form method="POST" class="form-horizontal">					
						<div class="form-group">
							<div class="col-md-12">
								<input type="submit" name="cancelPostSubmit" value="Loobu kuulutuse loomisest" class="btn <?php echo $finishPostPanelDeleteBtn; ?>" <?php echo $cancelPostSubmitBtn; ?>>
							</div>
						</div>
					</form>

					
				</div>
			</div>		
		</div>		
		
		
<!-- **** KUULUTUSELE PEAMISE (ESILEHE) PILDI LISAMISE PANEL **** -->
		
		<div class="col-md-4">
			<div class="panel <?php echo $uploadPanelStatus; ?>">
				<div class="panel-heading">
					<h3 class="panel-title">Lisa kuulutuse esilehe pilt</h3>
				</div>
				<div class="panel-body">
					<form action="createpost.php?id=<?php echo $_GET["id"]; ?>" method="post" enctype="multipart/form-data">
						<fieldset <?php echo $submitUploadBtn; ?>>
						
							<div class="form-group">
								<div>
									<?php echo $alertMsg; ?>
								</div>
								
								<label for="fileToUpload">Uploadi pilt:</label><br>
								<label class="btn btn-default btn-file" for="fileToUpload">
									<span class="glyphicon glyphicon-folder-open"></span>
									&nbsp;Vali&hellip;<input type="file" name="fileToUpload" id="fileToUpload" style="display: none;">
								</label>
							</div>

							<div class="form-group">
								<div class="row">
									<div class="col-md-12">
										<input type="submit" name="submitUpload" value="Lisa pilt" class="btn <?php echo $uploadPanelSubmitBtn; ?> btn-lg btn-block">
									</div>
								</div>
							</div>
						
						</fieldset>
					</form>
					
					<form method="POST">
						<div class="form-group">	
							<input type="submit" name="backToUpload" value="Muuda pilti" class="btn <?php echo $uploadPanelModifyBtn; ?>" <?php echo $modifyUploadBtn; ?>>
							<input type="submit" name="submitDefaultPic" value="Eemalda pilt" class="btn <?php echo $uploadPanelDeleteBtn; ?>" <?php echo $submitDefaultPicBtn; ?>>
							<input type="submit" name="cancelModifyUpload" value="Loobu" class="btn <?php echo $uploadPanelCancelBtn; ?>" <?php echo $cancelModifyUploadBtn; ?>>
						</div>
					</form>
					
				</div>
			</div>
		</div>
	</div>
</div>














<?php require("../footer.php"); ?>