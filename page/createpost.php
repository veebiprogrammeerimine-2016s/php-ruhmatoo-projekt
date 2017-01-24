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
	if(!isset($_GET["id"])) {
		header("Location: data.php");
		exit();
	}
	
$postStatus = "";
$currentId = $_GET["id"];
$alertMsg = "";

$pcheck = $Products->ifUserHasCreatedPostInfo($currentId);
$postInfoCheck = $pcheck->postcheck;

$sm_postsId = $Products->getNewPostId();
$postsId = $sm_postsId->id;
	
	if($postInfoCheck == 0) {
		$postinfoId = 0;
		
	} else {
		$sm_postinfoId = $Products->getRecentPostId($currentId);
		$postinfoId = $sm_postinfoId->postid;
		
	}

	/* kuulutus on alustatud */
	if($postsId > $postinfoId) {
		
		$recentPostHeading = "";
		$recentPostCondition = "";
		$recentPostPrice = "";
		$recentPostDescription = "";
		
		
	} else {
		
		$recentPostData = $Products->getRecentPostInfo($_GET["id"]);
		$postStatus = $recentPostData->status;
		$recentPostHeading = $recentPostData->heading;
		$recentPostCondition = $recentPostData->condition;
		$recentPostPrice = $recentPostData->price;
		$recentPostDescription = $recentPostData->description;
		
	}

/* id ei klapi siis suunatakse tagasi */
	if($_GET["id"] != $postsId) {
		header("Location: createpost.php?id=".$postsId);
		exit();
	}

	
	/*Pilid üleslaadimine*/

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
	
// unikaalsuse kontroll
	if(file_exists($target_file)) {
		echo "<br>Sellise nimega fail on juba olemas";
		$uploadOk = 0;
	}
	
// pildiformaatide kontroll
	if($imageFileType != "jpg" && $imageFileType != "JPG" &&
		$imageFileType != "png" && $imageFileType != "PNG" &&
		$imageFileType != "jpeg" && $imageFileType != "JPEG" ) {
			echo "<br> .jpg, .jpeg, .png formaadid on lubatud";
			$uploadOk = 0;
		}
	
//  uploadib pildi
	if($uploadOk == 0) {
		echo "<br>Faili ei ole üles laetud.";
		$alertMsg = "<div class='alert alert-default' role='alert'>Faili ei ole üles laetud</div>";
		
	} else {
		if (move_uploaded_file($uploadTmp, $target_file)) {
			echo "<br>Pilt nimega ".basename($uploadName)." on üles laetud</div>";
			$alertMsg = "<div class='alert alert-primary' role='alert'>Pilt on üles laetud!</div>";
			$Products->uploadImages($uploadName, $currentId);
		} else {
			echo "<br>Üleslaadimisel ilmnes tõrge.";
			$alertMsg = "<div class='alert alert-default' role='alert'>Üleslaadimisel ilmnes tõrge</div>";
		}
	}
}
	
	
	$imageInfo = $Products->ifUserUploadedImage($currentId);
$imageCheck = $imageInfo->imagecheck;
$updateStatus = "";

	if(isset($_POST["submitUpload"])) {
		
		if($imageCheck == 0) {
		
		$updateStatus = 2;
		$Products->updatePostStatus($updateStatus, $currentId);
		$Products->uploadImages("Untitled.png", $currentId);

		$recentImageInfo = $Products->getImageData($currentId);
		$recentImageId = $recentImageInfo->id;
		
		$Products->deletePreviousImages($currentId, $recentImageId);
		
		header("Location: createpost.php?id=".$currentId);
		exit();	
			
		} else {
		
		$updateStatus = 2;
		$Products->updatePostStatus($updateStatus, $currentId);
		
		$recentImageInfo = $Products->getImageData($currentId);
		$recentImageId = $recentImageInfo->id;
		
		$Products->deletePreviousImages($currentId, $recentImageId);
		header("Location: createpost.php?id=".$currentId);
		exit();	
			
		}
	}
	if(isset($_POST["backToData"])) {
		
		$updateStatus = 0;
		$Products->updatePostStatus($updateStatus, $currentId);
		
		header("Location: createpost.php?id=".$currentId);
		exit();
	}
	
	if(isset($_POST["cancelModifyData"]) && $imageCheck == 0) {
		
		$updateStatus = 1;
		$Products->updatePostStatus($updateStatus, $currentId);
		
		header("Location: createpost.php?id=".$currentId);
		exit();
	}
	
	if(isset($_POST["backToUpload"])) {
		
		$updateStatus = 3;
		$Products->updatePostStatus($updateStatus, $currentId);
		
		header("Location: createpost.php?id=".$currentId);
		exit();
	}
	
	
	if(isset($_POST["cancelModifyUpload"])) {
		
		if($postStatus == 3) {
			
			$updateStatus = 2;
			$Products->updatePostStatus($updateStatus, $currentId);
			header("Location: createpost.php?id=".$currentId);
			exit();
		} else {
			$updateStatus = 2;
			$Products->updatePostStatus($updateStatus, $currentId);
			
			$Products->uploadImages("Untitled.png", $currentId);
			
			header("Location: createpost.php?id=".$currentId);
			exit();
			
		}
	}
	
	
	if(isset($_POST["submitDefaultPic"])) {
		$updateStatus = 2;
		$Products->updatePostStatus($updateStatus, $currentId);
		$Products->uploadImages("Untitled.png", $currentId);
		$recentImageInfo = $Products->getImageData($currentId);
		$recentImageId = $recentImageInfo->id;
		$Products->deletePreviousImages($currentId, $recentImageId);
		header("Location: createpost.php?id=".$currentId);
		exit();
	}
	
	
	if(isset($_POST["cancelModifyData"]) && $imageCheck == 1) {
		$updateStatus = 2;
		$Products->updatePostStatus($updateStatus, $currentId);
		header("Location: createpost.php?id=".$currentId);
		exit();
	}
	
	
	/*andmete salvestamine vormi*/
	
	if(isset($_POST["description"]) && isset($_POST["price"]) && isset($_POST["heading"]) && isset($_POST["condition"])  &&
		 !empty($_POST["description"]) && !empty($_POST["price"]) && !empty($_POST["heading"]) && !empty($_POST["condition"]) 
		) {
		
		if($imageCheck != 1) {
			
			$updateStatus = 1;
			$Products->saveproduct($_GET["id"], $Helper->cleanInput($_POST["heading"]), $Helper->cleanInput($_POST["condition"]), $Helper->cleanInput($_POST["description"]), $Helper->cleanInput($_POST["price"]),  $updateStatus);
		
			$recentPostData = $Products->getRecentPostInfo($_GET["id"]);
			$postStatus = $recentPostData->status;
			$recentId = $recentPostData->id;
			
			$Products->deletePreviousPostVersions($currentId, $recentId);
			
			header("Location: createpost.php?id=".$currentId);
			exit();
			
		} else {
			
			$updateStatus = 2;
			$Products->saveproduct($_GET["id"], $Helper->cleanInput($_POST["heading"]), $Helper->cleanInput($_POST["condition"]), $Helper->cleanInput($_POST["description"]), $Helper->cleanInput($_POST["price"]), $updateStatus);
		
			$recentPostData = $Products->getRecentPostInfo($_GET["id"]);
			$postStatus = $recentPostData->status;
			$recentId = $recentPostData->id;
			
			$Products->deletePreviousPostVersions($currentId, $recentId);
			
			header("Location: createpost.php?id=".$currentId);
			exit();
		}
	}
	
	if(isset($_POST["finishPostSubmit"])) {
		$Products->finishPost($_GET["id"]);
		header("Location: data.php");
		exit();
	}
	
	if(isset($_POST["cancelPostSubmit"])) {
		
		$Products->deleteUnfinishedPost($currentId);
		$Products->finishDeletedPost($currentId);
		
		header("Location: data.php");
		exit();
	}

	if($imageCheck == 0) {
		$imageData = "";
	} else {
		$imageData = $Products->getImageData($currentId);
		$imageName = $imageData->name;
		echo "Image name: ".$imageName."<br>";
	}
echo "Image check: ".$imageCheck."<br>";
$displayedImage = "";

	if($imageCheck == 0) {
		$displayedImage = "../uploads/Untitled.png";
	} else {
		$displayedImage = "../uploads/".$imageName;
	}
	
$usedProducts = "";
$newProducts = "";
	
	if($recentPostCondition == "used") {
		$usedProducts = "checked";
	} else {
		if($recentPostCondition == "new") {
			$newProducts = "checked";
		}
	}
	
	$postHeading = "";
$postCondition = "";
$postPrice = "";
$postDescription = "";


$formHeadingError = "";
$formConditionError = "";
$formPriceError = "";
$formDescriptionError = "";



	if(isset($_POST["heading"] )) {
		if(empty($_POST["heading"] )) {
			$formHeadingError = "errorror";
		} else {
			$postHeading = $_POST["heading"];
		}
	}
	
	
	
	if(isset($_POST["type"] )) {
		if(empty($_POST["type"] )) {
			$formTypeError = "error";
		} else {
			$postType = $_POST["type"];
		}
	}
	
	if(isset($_POST["condition"] )) {
		if(empty($_POST["condition"] )) {
			$formConditionError = "error";
		} else {
			$postCondition = $_POST["condition"];
		}
	}
	
	if(isset($_POST["price"] )) {
		if(empty($_POST["price"] )) {
			$formPriceError = "error";
		} else {
			$postPrice = $_POST["price"];
		}
	}
	
	if(isset($_POST["description"] )) {
		if(empty($_POST["description"] )) {
			$formDescriptionError = "error";
		} else {
			$postDescription = $_POST["description"];
		}
	}
	
	if($postCondition == "" && isset($_POST["submit"])) {
		$formConditionError = "error";
	}
	
$usedProductType = "";
$newProductType = "";
	
	if($postCondition == "used") {
		$usedProductType = "checked";
	} else {
		if($postCondition == "new") {
			$newProductType = "checked";
		}
	}

	
	
	
	
?>


<div class="container">

<!-- *kuulutuse andmete sisestamine* -->
	
	<div class="row">
		<div class="col-md-12">
			<div class="panel <?php echo $dataPanelStatus; ?>">
				<div class="panel-heading">
					<h3 class="panel-title">Salvesta kuulutuse andmed</h3>
				</div>
				<div class="panel-body">
					<form method="POST">
						<fieldset <?php echo $submitBtn; ?>>
							<div class="form-group <?php echo $formHeadingError; ?>">
								<label class="control-label" for="heading">Toote Nimi</label>
								<input type="text" name="heading" class="form-control" placeholder="Kuulutuse nimi" id="heading" value="<?php if($postStatus == 9) {echo $postHeading;} else {echo $recentPostHeading;} ?>">
							</div>	
							
							<div class="<?php echo $formConditionError; ?>">
								<label class="control-label">Kasutatud/Uus</label>
								<div class="radio">
									<label>
										<input type="radio" name="condition" id="condition1" value="used" <?php echo $usedProductType; ?><?php echo $usedProducts; ?>> Kasutatud
									</label>
									<label>
										<input type="radio" name="condition" id="condition2" value="new" <?php echo $newProductType; ?><?php echo $newProducts; ?>> Uus
									</label>
								</div>
								
							</div>
							
							<div class="form-group <?php echo $formPriceError; ?>">	
								<label class="control-label" for="price">Hind</label>
								<input type="integer" name="price" class="form-control" placeholder="€" id="price" value="<?php if($postStatus == 9) {echo $postPrice;} else {echo $recentPostPrice;} ?>">
							</div>
							
							<div class="form-group <?php echo $formDescriptionError; ?>">
								<label class="control-label" for="description">Toote Lühikirjeldus ja kontakteerumisviis</label>
								<textarea type="text" name="description" cols="40" rows="2" maxlength="50" placeholder="Lühikirjeldus" class="form-control" id="description"><?php if($postStatus == 9) {echo $postDescription;} else {echo $recentPostDescription;} ?></textarea>
							</div>
						
							
							<div class="form-group">
								<input type="submit" name="submit" value="Salvesta andmed" class="btn <?php echo $dataPanelSubmitBtn; ?> btn-lg btn-block">
							</div>
							
						</fieldset>
					</form>
					
					<form method="POST">
						<div class="form-group">
							<button type="submit" name="backToData" class="btn-lg btn-block <?php echo $dataPanelModifyBtn; ?>" <?php echo $modifyDataBtn; ?>>Muuda andmeid</button><br>
							<button type="submit" name="cancelModifyData" class=" btn-lg btn-block <?php echo $dataPanelCancelBtn; ?>" <?php echo $cancelModifyDataBtn; ?>>Loobu</button>
						</div>
					</form>		


				</div>
			</div>
		</div>
<!-- Pildi lisamine -->
		
		<div class="col-md-12">
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
									&nbsp;Pildi lisamine&hellip;<input type="file" name="fileToUpload" id="fileToUpload" style="display: none;">
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
						
						</div>
					</form>
					
				</div>
			</div>
			<div class="col-md-12">
			<div class="panel <?php echo $finishPostPanelStatus; ?>">
				<div class="panel-heading">
					<h3 class="panel-title">Sinu loodava kuulutuse eelvaade</h3>
				</div>
				<div class="panel-body">
					<form method="POST" class="form-horizontal">
						<fieldset <?php echo $finishPostBtn; ?>>
							
	
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
		</div>
	</div>
</div>
















