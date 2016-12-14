<?php

require("../../../config.php");
require("../functions.php");

if(isset($_SESSION["userID"])){
	
	header("Location:data.php");
	exit();
}

	
	
	//MUUTUJAD
$signupEmailError = "";
$signupPasswordError = "";
	

if (isset($_GET["logout"])) {
		
		session_destroy();
		header("Location: login.php");
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
		
		
	
	if (isset($_GET["logout"])) {
		
		session_destroy();
		header("Location: login.php");
		exit();
		
	}
	
//var_dump($_POST);
$error="";

if( isset($_POST["signupEmail"]) && isset($_POST["signupPassword"])&& 
			!empty($_POST["signupEmail"]) && !empty($_POST["signupPassword"])
			){
				
				$error = $User->login($Helper->cleanInput($_POST["signupEmail"]),($Helper->cleanInput($_POST["signupPassword"])));
			}
if( isset($_POST["signupEmail"] )){
	
		if( empty($_POST["signupEmail"])) {
			$signupEmailError = "see väli on kohustuslik";
			
		} else {
			
			//email olemas
			$signupEmail=$_POST["signupEmail"];
			}
	}
	if( isset($_POST["signupPassword"])) {
		if( empty($_POST["signupPassword"])) {
			$signupPasswordError = "see väli on kohustuslik";
		}else{
		//Siia jõuan siis, kui parool oli olemas ja parool ei olnud tühi. !ELSE!
			if(strlen($_POST["signupPassword"])<8) {
				$signupPasswordError = "Parool peab olema vähemalt 8 märki pikk";
			}
	}
	}
	
	
	$pageName = "userCare";
?>
<?php require("../header.php");?>
<br><br><br><br>

<div class="container" id ="para2">
		  <ul class="nav nav-tabs" role="tablist">
			<li role="presentation" class="active"><a<li role="presentation" style="float:right;"><a href="#Otsing" arial-controls="Otsing" role="tab" data-toggle="tab"><h1>PLÄNTS</h1></p></a></li>
		  </ul>
	<div class="tab-content">
		<div role="tabpanel" class="tab-pane active" id="plantsTab">
			
			<div id="plantCare" class="row col-md-8">
			  <p>Siia tulevad Pländid!!</p> <form class="form-inline" >
												<input class="form-control" type="search" name="q" value="<?=$q;?>">
												<input class="btn btn-default" type="submit" value="Otsi">
										</form>
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
							$html .= "<th><a href='?q=".$q."&sort=name&direction=".$direction."'>plant</a></th>";
							$html .= "<th><a href='?q=".$q."&sort=watering_days&direction=".$direction."'>interval</a></th>";
						$html .= "</tr>";
						
						$i = 1;
						//iga liikme kohta massiivis
						foreach($plantData as $p) {
							//iga taim on $p
							//echo $p->taim."<br>";
						
							
							$html .= "<tr>";
								$html .= "<td>".$i."</td>";
								$html .= "<td>".$p->id."</td>";
								$html .= "<td>".$p->name."</td>";
								$html .= "<td>".$p->intervals."</td>";
								$html .= "<td><a href='edit.php?id=".$p->id."'>muuda</a></td>";
							$html .= "</tr>";
							
							$i += 1;
						}
						
						$html .= "</table>";
						
						echo $html;
						
						$listHtml="<br><br>";
						
						
						
						echo $listHtml;?>
						
						
			</div>

					
		</div>
      
	</div>	
</div>
	

<?php require("../footer.php");?>