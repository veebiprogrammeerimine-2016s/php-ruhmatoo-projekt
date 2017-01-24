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
$recentPostData = $Products->getRecentPostInfo($currentId);
$recentPostHeading = $recentPostData->heading;
$recentPostCondition = $recentPostData->condition;
$recentPostPrice = $recentPostData->price;
$recentPostDescription = $recentPostData->description;

if(isset($_POST["description"]) && isset($_POST["price"]) && isset($_POST["heading"]) && isset($_POST["condition"]) &&
	 !empty($_POST["description"]) && !empty($_POST["price"]) && !empty($_POST["heading"])  &&  !empty($_POST["condition"])) {
		
		$updateStatus = 4;
		$Products->saveproduct($currentId, $Helper->cleanInput($_POST["heading"]), $Helper->cleanInput($_POST["condition"]), $Helper->cleanInput($_POST["description"]), $Helper->cleanInput($_POST["price"]), $updateStatus);
		
		$recentPostData = $Products->getRecentPostInfo($currentId);
		$recentId = $recentPostData->id;
		$Products->deletePreviousPostVersions($currentId, $recentId);
		
		header("Location: editpost.php?id=".$currentId);
		exit();
	}
	
	if(isset($_POST["delete"])) {
		
		$Products->deleteUnfinishedPost($currentId);
		
		header("Location: myposts.php");
		exit();
	}
	
$usedProduct = "";
$newProduct = "";
	
	if($recentPostCondition == "used") {
		$usedProduct = "checked";
	} else {
		if($recentPostCondition == "new") {
			$newProduct = "checked";
		}
	}

$checkPostId = $Products->checkModifiedPost($currentId);
$checkId = $checkPostId->postcheck;

if($checkId == 0) {
	header("Location: myposts.php");
	exit();
}

require("../header.php");

?>



<div class="container">

	<ul class="nav nav-pills nav-stacked">
		<li role="presentation"><a href="createpost.php">Uue kuulutuse loomine</a></li>
		<li role="presentation"><a href="myposts.php">Minu üleslaetud kuulutuste vaatamine</a></li>
	
	</ul>
	
	<div>
		<h3></h3>
	</div>


	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-body">
				
					<form method="POST">
						
						<div class="form-group">
							<label for="heading">Pealkiri</label>
							<input type="text" name="heading" class="form-control" placeholder="Kuulutuse pealkiri" id="heading" value="<?php echo $recentPostHeading; ?>">
						</div>
						<div>
							<label>Kasutatud / Uus</label>
							<div class="radio">
								<label>
									<input type="radio" name="condition" id="condition1" value="used" <?php echo $usedProduct; ?>> Kasutatud
								</label>
								<label>
									<input type="radio" name="condition" id="condition2" value="new" <?php echo $newProduct; ?>> Uus
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
							<input type="submit" name="submit" value="Salvesta muudatused" class="btn btn-primary btn-lg btn-block">
						</div>

					</form>
					
					<form method="POST">
						<div class="form-group">
							<input type="submit" name="delete" value="Kustuta kuulutus" class="btn btn-warning btn-lg btn-block">
						</div>
					</form>
					
				</div>
			</div>
		</div>		
	</div>
</div>













