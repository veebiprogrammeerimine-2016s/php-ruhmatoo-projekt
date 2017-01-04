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






// georg















// karl-erik




$postData = $Sneakers->getSinglePostData($_GET["id"]);






require("../header.php");
?>





<div class="container">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Kuulutus</h3>
		</div>
		
		<div class="panel-body">
			
			<form method="POST" class="form-horizontal">
				<div class="form-group">
					<label class="col-md-2 control-label">Pealkiri</label>
					<div class="col-md-9 col-md-offset-1">
						<p class="form-control-static"><?php echo $postData->heading; ?></p>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-md-2 control-label">Mudel</label>
					<div class="col-md-9 col-md-offset-1">
						<p class="form-control-static"><?php echo $postData->model; ?></p>
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
			
			<div>
				<img src="../uploads/<?php echo $postData->name; ?>">
			</div>
			
			
			
			
			
			
			
			
			
		</div>
	</div>
</div>


























<?php require("../footer.php"); ?>