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
	
	if(!isset($_GET["id"])) {
		header("Location: sneakermarket.php");
		exit();
	}
	
	if($_GET["id"] == "") {
		header("Location: sneakermarket.php");
		exit();
}






// georg















// karl-erik




$postData = $Sneakers->getSinglePostData($_GET["id"]);
$postId = $postData->postid;

if($_GET["id"] != $postId) {
	header("Location: sneakermarket.php");
	exit();
}

//echo $postId;


if(isset($_POST["comments"]) && !empty($_POST["comments"])) {
	$Sneakers->postComment($_GET["id"], $Helper->cleanInput($_POST["comments"]));
}


if(isset($_POST["report"])) {
	$Sneakers->flagPost($_GET["id"]);
}












require("../header.php");
?>





<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title"><?php echo $postData->heading; ?></h3>
				</div>
				
				<div class="panel-body">
					<div class="row">
					
						<div class="col-md-6">
							<div class="form-group">								
								<p class="form-control-static"><img src="../uploads/<?php echo $postData->name; ?>" class="img-thumbnail"></p>
							</div>
						</div>

						
						<div class="col-md-6">
							<form method="POST" class="form-horizontal">
								<div class="form-group">
									<label class="col-md-2 control-label">Bränd</label>
									<div class="col-md-9 col-md-offset-1">
										<p class="form-control-static"><?php echo $postData->brand; ?></p>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-2 control-label">Mudel</label>
									<div class="col-md-9 col-md-offset-1">
										<p class="form-control-static"><?php echo $postData->model; ?></p>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-2 control-label">Suurus</label>
									<div class="col-md-9 col-md-offset-1">
										<p class="form-control-static"><?php echo $postData->size; ?></p>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-2 control-label">Tüüp</label>
									<div class="col-md-9 col-md-offset-1">
										<p class="form-control-static"><?php if($postData->type == "male") {echo "Meeste jalanõud";} else {if($postData->type == "female") {echo "Naiste jalanõud";} else {echo "";}} ?></p>
									</div>
								</div>
								
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
									<label class="col-md-2 control-label">Kirjeldus</label>
									<div class="col-md-9 col-md-offset-1">
										<p class="form-control-static"><?php echo $postData->description; ?></p>
									</div>
								</div>
							</form>
							
						</div>
					</div>
						
					<div class="row">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h3 class="panel-title">Kommentaarid</h3>
							</div>
								<div class="col-md-6">
									<div>
										<h3></h3>
									</div>
								
									<form method="POST">
										<div class="form-group">
											<textarea type="text" name="comments" cols="40" rows="5" maxlength="200" placeholder="Kirjuta kommentaar" class="form-control"></textarea>
										</div>
										
										<div class="form-group">
											<input type="submit" name="submitComment" value="Kommenteeri" class="btn btn-primary">
										</div>
									</form>
									
									<form method="POST">
										<input type="submit" name="report" value="Teavita kohatust kuulutusest" class="btn btn-danger">
									</form>		
									
								</div>
								
								<div class="col-md-6">
									<div>
										<h3></h3>
									</div>
									
<?php

$allComments = $Sneakers->getAllComments($_GET["id"]);


	$html = "<div class='row'><div class='col-md-12'>";
		
	foreach($allComments as $ac) {
		$html .= "<div class='panel panel-default'>";
			$html .= "<form method='POST' class='form-horizontal'>";
				$html .= "<div class='form-group'>";
				$html .= "<label class='col-md-2 control-label'>".$ac->userid."</label>";
					$html .= "<div class='col-md-9 col-md-offset-1'>";
						$html .= "<p class='form-control-static'>".$ac->comment."</p>";
					$html .= "</div>";
				$html .= "</div>";
			$html .= "</form>";
		$html .= "</div>";
	}
	
	$html .= "</div></div>";
	
	echo $html;



?>									

								</div>							
						</div>						
					</div>
					
					
					
				
			
			
			
			
			
			
				</div>
			</div>
		</div>
	</div>
</div>


























<?php require("../footer.php"); ?>