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
	
	
	
	
	//echo "<pre>";
	//var_dump($carData);
	//echo "</pre>";
?>

<h1>Data</h1>
<?=$msg;?>
<p>
	<form align = "center">Welcome <a href="user.php"><?=$_SESSION["userEmail"];?>!</a>
	<a href="?logout=1">Logout</a></form>
</p>


<h2>Please add your idea!</h2>
<form method="POST" align = "center">
			
			<p><label for="idea">Idea:</label><br>
					<input name= "idea" type="text" id="idea" required>
			<p><label for="description">Idea description:</label><br>
					<input name= "decsription" type="text" id="description" required>

			
			<input type="submit" value="Complete">
			
</form>

<h2>Users</h2>

<form align = "center">
	
	<input type="search" name="q" value="<?=$q;?>">
	<input type="submit" value="Search">

</form>

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
					<a href='?q=".$q."&sort=level&order=".$levelOrder."'>
						level
					</a>
				 </th>";
		$html .= "<th>
					<a href='?q=".$q."&sort=description'>
						description
					</a>
				 </th>";
	$html .= "</tr>";
	
	//iga liikme kohta massiivis
	foreach($finishData as $f){
		
		//echo $c->plate."<br>";
		
		$html .= "<tr>";
			$html .= "<td>".$f->id."</td>";
			$html .= "<td>".$f->level."</td>";
			$html .= "<td>".$f->description."</td>";
			$html .= "<td><a class='btn btn-default btn-sm' href='edit.php?id=".$f->id."'><span class='glyphicon glyphicon-pencil'></span> Edit</a></td>";
			
		$html .= "</tr>";
	}
	
	$html .= "</table>";
	
	echo $html;
	
	
	$listHtml = "<br><br>";
	
	foreach($finishData as $f){
		
		
		$listHtml .= "<h1 style='description:".$f->finishDescription."'>".$f->level."</h1>";
		$listHtml .= "<p>level = ".$f->finishDescription."</p>";
	}
	
	//echo $listHtml;
	
	
	

?>
