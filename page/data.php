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
	
	//var_dump($_POST);
	if ( isset($_POST["idea"]) && 
		isset($_POST["description"]) && 
		!empty($_POST["idea"]) && 
		!empty($_POST["description"])
	  ) {
		  //echo "siin";
		$Finish->save($Helper->cleanInput($_POST["idea"]), $Helper->cleanInput($_POST["description"]));
		
	}
	
	//saan kõik auto andmed
	
	//kas otsib
	if(isset($_GET["q"])){
		
		// kui otsib, võtame otsisõna aadressirealt
		$q = $_GET["q"];
		
	}else{
		
		// otsisõna tühi
		$q = "";
	}
	
	$sort = "id";
	$order = "ASC";
	
	if(isset($_GET["sort"]) && isset($_GET["order"])) {
		$sort = $_GET["sort"];
		$order = $_GET["order"];
	}
	
	//otsisõna fn sisse
	$finishData = $Finish->get($q, $sort, $order);
	

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

<div id="myModal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
		<form id="Ideas" method="post" role="form">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h4 class="modal-title">Add your idea</h4>
		  </div>
		  <div class="modal-body">
				<label for="idea" class="col-md-0 control-label"> <h3>Idea name</h3></label>
			<div class="row">
				<div class="col-md-4">
					<input type="text" class="form-control" name="idea" id="idea" placeholder="This idea name is..." required>
				</div>
			</div>
				<label for="description" class="col-md-0 control-label"><h3>Idea description</h3></label>
			<div class="row">
				<div class="form-group">
					<div class="col-md-12">
						<textarea class="form-control" rows="5" id="description" name= "description" placeholder="This idea is about..." required></textarea>
					</div>
				</div>
			</div>
		  </div>	
		  <div class="modal-footer">
			<button type="submit" class = "btn btn-success btn-sm ">Complete</button>
			<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancel</button>
		  </div>
		 </form>
    </div>
  </div>
</div>

<?=$msg;?>
<div class="container">
	<div class="row">
		<div class="col-md 5 text-center">
			<h3 class="text center">Looking for ideas?</h3>
		</div>
	</div>
	<div class="row">
		<form>
			<div class="col-md-offset-4 col-md-4">
				<input type="search" class="form-control input-sm" name="q" value="<?=$q;?>" placeholder="Type in keyword...">
			</div>
			<div class="col-sm-2">
				<button type="submit" class = "btn btn-success btn-sm btn-block"><span class="glyphicon glyphicon-search"></span> Search</button>
			</div>
		</form>
	</div>
	<br>

<?php 

	$html = "<table class='table table-striped'>";
	

	
	$html .= "<tr>";
	
		$idOrder = "ASC";
		$arrow = "&darr;";
		if (isset($_GET["order"]) && $_GET["order"] == "ASC"){
			$idOrder = "DESC";
			$arrow = "&uarr;";
		}
	
		$html .= "<th>
					<a href='?q=".$q."&sort=id&order=".$idOrder."'>
						id ".$arrow."
					</a>
				 </th>";
				 
				 
		$levelOrder = "ASC";
		$arrow = "&darr;";
		if (isset($_GET["order"]) && $_GET["order"] == "ASC"){
			$levelOrder = "DESC";
			$arrow = "&uarr;";
		}
		$html .= "<th>
					<a href='?q=".$q."&sort=idea&order=".$levelOrder."'>
						idea
					</a>
				 </th>";
		$html .= "<th>
					<a href='?q=".$q."&sort=description'>
						description
					</a>
				 </th>";
		$html .= "<th>
					<a href='?q=".$q."&sort=user&order=".$levelOrder."'>
						user
					</a>
				 </th>";
	$html .= "</tr>";
	
	//iga liikme kohta massiivis
	foreach($finishData as $f){
		
		//echo $c->plate."<br>";
		
		$html .= "<tr>";
			$html .= "<td>".$f->id."</td>";
			$html .= "<td>".$f->idea."</td>";
			$html .= "<td>".$f->description."</td>";
			$html .= "<td>".$f->user."</td>";
			
		$html .= "</tr>";
	}
	
	$html .= "</table>";
	
	echo $html;
	
	
	$listHtml = "<br><br>";
	
	foreach($finishData as $f){
		
		
		$listHtml .= "<h1>".$f->idea."</h1>";
		$listHtml .= "<p>idea = ".$f->description."</p>";
	}
	
	//echo $listHtml;
	
	
	

?>
</div>
<?php require("../footer.php"); ?>
