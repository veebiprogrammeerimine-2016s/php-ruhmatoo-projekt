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
	

$currentId = $_GET["id"];


$recentPostData = $Sneakers->getRecentPostInfo($currentId);

$recentPostHeading = $recentPostData->heading;
$recentPostModel = $recentPostData->model;
$recentPostPrice = $recentPostData->price;
$recentPostDescription = $recentPostData->description;


	if(isset($_POST["model"]) && isset($_POST["description"]) && isset($_POST["price"]) && isset($_POST["heading"]) &&
		!empty($_POST["model"]) && !empty($_POST["description"]) && !empty($_POST["price"]) && !empty($_POST["heading"])) {
			
			$updateStatus = 3;
			$Sneakers->savesneaker($currentId, $Helper->cleanInput($_POST["heading"]), $Helper->cleanInput($_POST["model"]), $Helper->cleanInput($_POST["description"]), $Helper->cleanInput($_POST["price"]), $updateStatus);
			
			$recentPostData = $Sneakers->getRecentPostInfo($currentId);
			$recentId = $recentPostData->id;
			$Sneakers->deletePreviousPostVersions($currentId, $recentId);
			
			header("Location: editpost.php?id=".$currentId);
			exit();
		}
		
		if(isset($_POST["delete"])) {
			
			$Sneakers->deleteUnfinishedPost($currentId);
			
			header("Location: myposts.php");
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
								<input type="submit" name="submit" value="Salvesta muudatused" class="btn btn-success btn-lg btn-block">
							</div>

					</form>
					
					<form method="POST">
						<div class="form-group">
							<input type="submit" name="delete" value="Kustuta kuulutus" class="btn btn-danger btn-block">
						</div>
					</form>
					
				</div>
			</div>
		</div>
	</div>
</div>






















<?php require("../footer.php"); ?>