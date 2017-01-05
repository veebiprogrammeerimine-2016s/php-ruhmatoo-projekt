<?php
	require("../functions.php");
	
	require("../class/Finish.class.php");
	$Finish = new Finish($mysqli);
	
	require("../class/Helper.class.php");
	$Helper = new Helper();
	
	//kui ei ole kasutaja id'd
	if (!isset($_SESSION["userId"])){
		
		//suunan sisselogimise lehele
		header("Location: login.php");
		exit();
	}
	
	
	//kui on ?logout aadressireal siis login välja
	if (isset($_GET["logout"])) {
		
		session_destroy();
		header("Location: login.php");
		exit();
	}
	
	$msg = "";
	if(isset($_SESSION["message"])){
		$msg = $_SESSION["message"];
		
		//kui ühe näitame siis kustuta ära, et pärast refreshi ei näitaks
		unset($_SESSION["message"]);
	}
	
	
	if ( isset($_POST["idea"]) && 
		isset($_POST["idea"]) && 
		!empty($_POST["description"]) && 
		!empty($_POST["description"])
	  ) {
		  
		$Finish->save($Helper->cleanInput($_POST["idea"]), $Helper->cleanInput($_POST["description"]));
		
	}

?>

<?php require("../header.php"); ?>
<div class="navbar navbar-inverse navbar-static-top">
	<div class="container">
		<div class="navbar-header">
			 <a class="navbar-brand" href="data.php"><i class="fa fa-home" aria-hidden="true"></i>Homepage</a> 
		</div>
			<ul class="nav navbar-nav">
				<li><a href="#myModal" data-toggle="modal"><span class="glyphicon glyphicon-plus"></span>Add idea</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="user.php"><i class="fa fa-user-circle" aria-hidden="true"></i><?=$_SESSION["userEmail"];?></a></li>
				<li><a href="?logout=1"><span class="glyphicon glyphicon-log-out"></span>Logout</a></li>
			</ul>
	</div>
</div>

<?=$msg;?>
<div class="container">
	<form method="POST">
		<label for="idea" class="col-md-0 control-label"> <h3>Idea name:</h3></label>
		<div class="row">
				<div class="col-md-4">
					<input type="text" class="form-control" name="idea" id="idea" placeholder="Biggest bridges" required>
				</div>
		</div>
		<label for="description" class="col-md-0 control-label"><h3>Idea description:</h3></label>
		<div class="row">
				<div class="form-group">
					<div class="col-md-4">
						<textarea class="form-control" rows="5" id="description" name= "description" placeholder="This idea is about..." required></textarea>
					</div>
				</div>
		</div>
		<br>
		<div class="row">
				<div class="col-sm-2">
					<button href="data.php" type="submit" class = "btn btn-success btn-sm btn-block"><span class="glyphicon glyphicon-search"></span> Complete</button>
				</div>
		
		</div>
	</form>

	

</div>
<?php require("../footer.php"); ?>