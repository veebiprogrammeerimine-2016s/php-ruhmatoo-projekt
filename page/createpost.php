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
$postStatus = "";

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
		$recentPostModel = "";
		$recentPostPrice = "";
		$recentPostDescription = "";
		
	} else {
		
		$recentPostData = $Sneakers->getRecentPostInfo($_GET["id"]);
		$postStatus = $recentPostData->status;
		
		$recentPostHeading = $recentPostData->heading;
		$recentPostModel = $recentPostData->model;
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


/*** KUULUTUSE ANDMETE SALVESTAMISVORMI PHP ***/
	
	if(isset($_POST["model"]) && isset($_POST["description"]) && isset($_POST["price"]) && isset($_POST["heading"]) &&
		!empty($_POST["model"]) && !empty($_POST["description"]) && !empty($_POST["price"]) && !empty($_POST["heading"])
		) {
		
		if($imageCheck != 1) {
			
			$updateStatus = 1;
			$Sneakers->savesneaker($_GET["id"], $Helper->cleanInput($_POST["heading"]), $Helper->cleanInput($_POST["model"]), $Helper->cleanInput($_POST["description"]), $Helper->cleanInput($_POST["price"]), $updateStatus);
		
			$recentPostData = $Sneakers->getRecentPostInfo($_GET["id"]);
			$postStatus = $recentPostData->status;
			$recentId = $recentPostData->id;
			
			$Sneakers->deletePreviousPostVersions($currentId, $recentId);
			
			header("Location: createpost.php?id=".$currentId);
			exit();
			
		} else {
			
			$updateStatus = 2;
			$Sneakers->savesneaker($_GET["id"], $Helper->cleanInput($_POST["heading"]), $Helper->cleanInput($_POST["model"]), $Helper->cleanInput($_POST["description"]), $Helper->cleanInput($_POST["price"]), $updateStatus);
		
			$recentPostData = $Sneakers->getRecentPostInfo($_GET["id"]);
			$postStatus = $recentPostData->status;
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

<!-- AJUTINE KONTROLLPANEEL

<div class="container">
	<div class="panel panel-default">
		<div class="panel-body">
			<div class="row">
			
				<div class="col-md-2">
					<?php echo "sm_posts id: ".$postsId; ?><br>
					<?php echo "sm_postinfo id: ".$postinfoId; ?>
				</div>
				
				<div class="col-md-2">
					<?php echo "<br>sm_postinfo postcheck: ".$postInfoCheck; ?>
				</div>
				
				<div class="col-md-2">
					<?php echo "<br>Image check: ".$imageCheck; ?>
				</div>
				
				<div class="col-md-2">
					<?php echo "<br>poststatus: ".$postStatus; ?>
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
						
							<div class="form-group">
								<label for="heading">Pealkiri</label>
								<input type="text" name="heading" class="form-control" placeholder="kuulutuse pealkiri" id="heading" value="<?php echo $recentPostHeading; ?>">
							</div>
						
							<div class="form-group">
								<label for="model">Mudel</label>
								<input type="text" name="model" class="form-control" placeholder="mudeli nimi" id="model" value="<?php echo $recentPostModel; ?>">
							</div>
						
							<div class="form-group">	
								<label for="price">Hind</label>
								<input type="integer" name="price" class="form-control" placeholder="ex. 490" id="price" value="<?php echo $recentPostPrice; ?>">
							</div>

							<div class="form-group">
								<label for="description">Kirjeldus</label>
								<textarea type="text" name="description" cols="40" rows="2" maxlength="50" placeholder="ex. Air Jordan X Retro 'OVO', size 43" class="form-control" id="description"><?php echo $recentPostDescription; ?></textarea>
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
								<label class="col-md-2 control-label">Mudel</label>
								<div class="col-md-9 col-md-offset-1">
									<p class="form-control-static"><?php echo $recentPostModel; ?></p>
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




<!--
	<h2>Market</h2>
	<form>
		<input type="search" name="q" value="<?=$q;?>">
		<input type="submit" value="Search"><br><br>
	</form>
-->










<?php require("../footer.php"); ?>