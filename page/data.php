<?php 
	
	
	require("../functions.php");
	
	$plant="";
	$wateringInterval="";
	$plantError="";
	$wateringIntervalError="";
	
	
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
	if(isset($_SESSION["message"])) {
		
		$msg = $_SESSION["message"];
		
		//kustutan ära, et pärast ei näitaks
		unset($_SESSION["message"]);
	}
	
	if (isset($_POST["user_plant"]) &&
		(isset($_POST["waterings"]) &&
		!empty($_POST["user_plant"]) &&
		!empty($_POST["waterings"])
		)) {
			
			$Plant->save($Helper->cleanInput($_POST["user_plant"]), $Helper->cleanInput($_POST["waterings"]));
			
			header("Location: data.php");
		    exit();
		}
		
		
	if(isset($_GET["sort"]) && isset($_GET["direction"])){
		$sort=$_GET["sort"];
		$direction=$_GET["direction"];
	} else {
		//kui ei ole määratud siis vaikimisi id ja ASC
		$sort="id";
		$direction="ascending";
		
	}
	
	if(isset($_GET["q"])){
		$q = $Helper->cleanInput($_GET["q"]);
		$plantData = $Plant->getAll($q, $sort, $direction);
	} else {
		$q="";
		$plantData = $Plant->getAll($q,$sort,$direction);
		
	}	
		
	
	
	
	
		
		//echo"<pre>";
		//var_dump($plantData);
		//echo"</pre>";
		
	

	if( isset($_POST["user_plant"] )){

	

		if( empty($_POST["user_plant"])) {

			$plantError = "Sisesta taime nimetus!  ";
			
		}else{
			
			
			$plant=$_POST["user_plant"];



			}
	}
	
	if( isset($_POST["waterings"])) {
		
		if( empty($_POST["waterings"]))
        {
			$wateringIntervalError = "  Sisesta kastmisintervall!  ";
			
			} else { 
			
			$wateringInterval = $_POST["waterings"];
		
		}		
	}
	
?>

<?php require("../header.php");?>

<title>Kalender</title>
<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div id="logo" class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="login.php">FacePlänt</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="navbar-main">
      <ul class="nav navbar-nav">
        <li class="col-sm-8"><a href="#">Taimehooldus<span class="sr-only"></span></a></li>
        
        
      </ul><ul class="nav navbar-nav navbar-right">
		<li class="col-sm-8"><a href="?logout=1"> Logi välja <span class="sr-only"></span></a></li>
           </ul>         
                
      
      
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<center>
<br><br><br>
 <h4>Tere tulemast     <?=$_SESSION["firstName"];?>!</h4>
<div id="plantsForm" class="col-lg-4 col-sm-offset-8" style="background-color:rgba(0, 0, 0, 0.5)";>
		<h3> Toataimede sisestamine </h3>

		<div >
			<form id="insertPlants" method=POST>
				<?php echo $plantError;  ?>
				<?php echo $wateringIntervalError;  ?>

				  
			 <h3>Sisesta taime nimetus</h3>
				<input  class="form-control" name="user_plant" placeholder="taime nimetus"  type="text" value="<?=$plant;?>" > 

			<br>

				<h3>Sisesta taime kastmisintervall</h3>
				<input  class="form-control" name="waterings" placeholder="mitme päeva tagant"  type ="number"> 

			<br>

				<input class="btn btn-default" type="submit" value="Salvesta">
			<br>
			
			</form>
			</div>
			
			

			<div class="col-sm-6 col-sm-offset-6">
			<h3>Taime otsing</h3>
			<form>
				<input type="search" name="q" value="<?=$q;?>">
				<input class="btn btn-default" type="submit" value="Otsi">
			</form></div>
	</div>
	
	<?php
	
	$direction = "ascending";
	if (isset($_GET["direction"])){
		if($_GET["direction"]=="ascending"){
			$direction="descending";
		}
		
	}
	
	$html = "<table class='table table-striped table-hover table-condensed table-bordered  ' style='background-color:white'>";
	$html .= "<tr>";
		$html .= "<th><a href='?q=".$q."&sort=id&direction=".$direction."'>nr</a></th>";
		$html .= "<th><a href='?q=".$q."&sort=id&direction=".$direction."'>id</a></th>";
		$html .= "<th><a href='?q=".$q."&sort=plant&direction=".$direction."'>plant</a></th>";
		$html .= "<th><a href='?q=".$q."&sort=interval&direction=".$direction."'>interval</a></th>";
	$html .= "</tr>";
	
	$i = 1;
	//iga liikme kohta massiivis
	foreach($plantData as $p) {
		//iga taim on $p
		//echo $p->taim."<br>";
	
		
		$html .= "<tr>";
			$html .= "<td>".$i."</td>";
			$html .= "<td>".$p->id."</td>";
			$html .= "<td>".$p->taim."</td>";
			$html .= "<td>".$p->intervall."</td>";
			$html .= "<td><a href='edit.php?id=".$p->id."'>muuda</a></td>";
		$html .= "</tr>";
		
		$i += 1;
	}
	
	$html .= "</table>";
	
	echo $html;
	
	$listHtml="<br><br>";
	
	
	
	echo $listHtml;
	?></div></div><br><br>
	

<style>

    #plantsForm
{	-moz-border-radius:10px;
	-webkit-border-radius:10px;
	padding-top:30px;
	padding-right:30px;
	padding-left:30px;
	height:400px;
}

h3{
	color:white;
}
h4{
	
	color:white;
	
}


p {
	padding:10px;
}
a {
	
	width: 120px;
	margin-left:auto;
	margin-right:auto;
}

#logo{
	padding-top:20px;
	padding-left:20px;
	padding-right:20px;
	
}



div#insertPlants{
	padding-left:20px;
	padding-right:20px;
	
	
}

body{
	font-family:helvetica;
	
	
}
ul {
    list-style-type: none;
    margin: 0px;
    padding: 0px;
	
}

li {
	padding-top:20px;
	padding-left:20px;
	padding-right:20px;
	
}

</style>

<?php require("../footer.php");?>

