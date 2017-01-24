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
		header("Location: productselect.php");
		exit();
	}
	
	if($_GET["id"] == "") {
		header("Location: productselect.php");
		exit();
}

$postData = $Products->getSinglePostData($_GET["id"]);
$postId = $postData->postid;

if($_GET["id"] != $postId) {
	header("Location: productselect.php");
	exit();
}

if(isset($_POST["comments"]) && !empty($_POST["comments"])) {
	$Products->postComment($_GET["id"], $Helper->cleanInput($_POST["comments"]));
}


require("../header.php");
?>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-success">
				<div class="panel-heading">
					<h3 class="panel-title"><?php echo $postData->heading; ?></h3>
				</div>
				
				<div class="panel-body">
					<div class="row">
					
						
						<div class="col-md-12 col-md-offset-3">
							<form method="POST" class="form-horizontal">
				
								<div class="form-group">
									<label class="col-md-2 control-label">Seisukord</label>
									<div class="col-md-9 col-md-offset-1">
										<p class="form-control-static"><?php if($postData->condition == "used") {echo "Kasutatud";} else {if($postData->condition == "new") {echo "Uued";} else {echo "";}} ?></p>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-2 control-label">Hind</label>
									<div class="col-md-9 col-md-offset-1">
										<p class="form-control-static"><?php echo $postData->price." €"; ?></p>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-2 control-label">Kirjeldus & Kontakt</label>
									<div class="col-md-9 col-md-offset-1">
										<p class="form-control-static"><?php echo $postData->description; ?></p>
									</div>
								</div>
							</form>
							
						</div>
						<div class="col-md-6 col-md-offset-3">
							<div class="form-group">								
								<p class="form-control-static"><img src="../uploads/<?php echo $postData->name; ?>" class="img-thumbnail"></p>
							</div>
						</div>
					</div>
						
					<div class="row">
						<div class="panel panel-primary">
							<div class="panel-heading">
								<h3 class="panel-title">Kommentaarid</h3>
							</div>
								<div class="col-md-12">
									<div>
										<h3></h3>
									</div>
								
									<form method="POST">
										<div class="form-group">
											<textarea type="text" name="comments"  rows="10" placeholder="Kirjuta kommentaar" class="form-control"></textarea>
										</div>
										<br><br>
										<div class="form-group">
											<input type="submit" name="submitComment" value="Kommenteeri" class="btn btn-primary btn-lg btn-block">
										</div>
									</form>
									
								</div>				
						</div>						
					</div>
					
								
				</div>
			</div>
		</div>
	</div>
</div>
<?php

$allComments = $Products->getAllComments($_GET["id"]);
	$html = "<div class='col-md-12'><div class='row'>";
		
	foreach($allComments as $allc) {
		$html .= "<div class='panel panel-default'>";
			$html .= "<form method='POST' class='form-horizontal'>";
				$html .= "<div class='form-group'>";
				$html .= "<label class='col-md-1 control-label'>".$allc->username."</label>";
					$html .= "<div class='col-md-6 col-md-offset-1'>";
						$html .= "<p class='form-control-static'>".$allc->comment."</p>";
					$html .= "</div>";
				$html .= "</div>";
			$html .= "</form>";
		$html .= "</div>";
	}
	
	$html .= "</div></div>";
	
	echo $html;

?>

<?php require("../footer.php"); ?>









