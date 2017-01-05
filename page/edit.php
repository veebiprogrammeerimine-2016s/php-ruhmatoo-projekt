<?php
	//edit.php
	require("../functions.php");
	
	require("../class/Finish.class.php");
	$Finish = new Finish($mysqli);
	
	require("../class/Helper.class.php");
	$Helper = new Helper();
	
	//var_dump($_POST);
	
	//kas kasutaja uuendab andmeid
	if(isset($_POST["update"])){
		
		$Finish->update($Helper->cleanInput($_POST["id"]), $Helper->cleanInput($_POST["level"]), $Helper->cleanInput($_POST["description"]));
		
		header("Location: edit.php?id=".$_POST["id"]."&success=true");
        exit();	
		
	}
	
	//kustutan
	if(isset($_GET["delete"])){
		
		$Finish->delete($_GET["id"]);
		
		header("Location: data.php");
		exit();
	}
	
	
	
	// kui ei ole id'd aadressireal siis suunan
	if(!isset($_GET["id"])){
		header("Location: data.php");
		exit();
	}
	
	//saadan kaasa id
	$f = $Finish->getSingle($_GET["id"]);
	//var_dump($c);
	
	if(isset($_GET["success"])){
		echo "Success!";
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

<div class="container">
<h2>Edit</h2>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
	<input type="hidden" name="id" value="<?=$_GET["id"];?>" > 
  	<label for="number_idea" >Idea</label><br>
	<input id="number_idea" name="idea" type="text" value="<?php echo $f->idea;?>" ><br><br>
  	<label for="description" >Description</label><br>
	<input id="description" name="description" type="text" value="<?=$f->description;?>"><br><br>
  	<div class="row">
				<div class="col-md-4">
					<input type="text" class="form-control" name="idea" id="idea" value="<?php echo $f->idea;?>" >
				</div>
		</div>
		<label for="description" class="col-md-0 control-label"><h3>Idea description:</h3></label>
		<div class="row">
			<div class="form-group">
				<div class="col-md-4">
					<textarea class="form-control" rows="5" id="description" name= "description" value="<?=$f->description;?>"></textarea>
				</div>
			</div>
		</div>
		<div class="row">
				<div class="col-sm-2">
					<button type="submit" name="update" class = "btn btn-success btn-sm">Save</button>
				</div>
		</div>
		<div class="row">
				<div class="col-sm-2">
					<a href="?id=<?=$_GET["id"];?>&delete=true">Delete</a>
				</div>
		</div>
<input type="submit" name="update" value="Save">
 <a href="?id=<?=$_GET["id"];?>&delete=true">Delete</a>
 </form>
</div>
<?php require("../footer.php"); ?>