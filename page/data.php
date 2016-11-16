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
		
		$plantData=$Plant->getAll();
		
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
	
	
	<?php
	
	$html = "<table class='table table-striped table-hover table-condensed table-bordered  '>";
	$html .= "<tr>";
		$html .= "<th>nr</th>";
		$html .= "<th>id</th>";
		$html .= "<th>taim</th>";
		$html .= "<th>intervall</th>";
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
<center><iframe src="https://calendar.google.com/calendar/embed?height=600&amp;wkst=1&amp;bgcolor=%23009900&amp;src=mreintop%40gmail.com&amp;color=%231B887A&amp;ctz=Europe%2FTallinn" style="border-width:0" width="800" height="600" frameborder="0" scrolling="no"></iframe>
	
	
	
		
		 
	
</center>


<?php require("../footer.php");?>

