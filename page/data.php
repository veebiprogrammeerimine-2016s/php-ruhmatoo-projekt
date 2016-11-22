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

<center>
<br><br>
 Tere tulemast     <?=$_SESSION["firstName"];?>!

<h2><font face="verdana" color="#006600"> Toataimede sisestamine</font> </h2></center>
<div class = "form-group col-sm-8  col-sm-offset-0">
<div class="form-group col-sm-6 col-sm-offset-6" >
	<form method=POST>
		<?php echo $plantError;  ?>
		<?php echo $wateringIntervalError;  ?>

          
	 <p><font face="verdana" color="#006600">Sisesta taime nimetus</font></p>
		<input  class="form-control" name="user_plant" placeholder="taime nimetus"  type="text" value="<?=$plant;?>" > 

	<br><br>

        <p><font face="verdana"color="#006600">Sisesta taime kastmisintervall</font></p>
		<input  class="form-control" name="waterings" placeholder="mitme päeva tagant"  type ="number"> 

	<br>

		<input class="btn btn-success" type="submit" value="Salvesta">
	<br><br>
	
	</form>
	</div>
	
    

	<div class="col-sm-6 col-sm-offset-6">
	<div >
	<form>
		<input type="search" name="q" value="<?=$q;?>">
		<input class="btn btn-success" type="submit" value="Otsi">
	</form></div>
	
	<?php
	
	$direction = "ascending";
	if (isset($_GET["direction"])){
		if($_GET["direction"]=="ascending"){
			$direction="descending";
		}
		
	}
	
	$html = "<table class='table table-striped table-hover table-condensed table-bordered  '>";
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
	<a class="btn btn-default btn-success" href="?logout=1" role="button">Logi välja</a>



<?php require("../footer.php");?>

