<?php 
	
	
	require("../functions.php");
	
	$plant="";
	$wateringInterval="";
	$plantError="";
	$wateringIntervalError="";
    $emailFromDb=$_SESSION["userEmail"];
	
	
	//kui ei ole kasutaja id'd
	if (!isset($_SESSION["userId"])){
		//suunan sisselogimise lehele
		header("Location: login.php");
		exit();
	}
		


    if (isset($_GET["deleted"])){
		$Plant->delete($_GET["id"]);
			header("Location: data.php");
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
			
			$Plant->save($Helper->cleanInput($_POST["user_plant"]), $Helper->cleanInput($_POST["waterings"]),$_SESSION["userEmail"]);
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
		$plantData = $Plant->getAllUserPlants($q, $sort, $direction);
	} else {
		$q="";
		$plantData = $Plant->getAllUserPlants($q,$sort,$direction);
		
	}	
    
    /* Sisesta andmebaasist save */
    if (isset($_POST["plant"]) &&
 	  (isset($_POST["watering"]) &&
       !empty($_POST["plant"]) &&
       !empty($_POST["watering"])
      )) {
        
        $Plant->saveUserPlants($Helper->cleanInput($_POST["plant"]), $Helper->cleanInput($_POST["watering"]));
        $Plant->saveSecond($Helper->cleanInput($_POST["plant"]), $Helper->cleanInput($_POST["watering"]));
        exit();
    }
		
	
	$options = $Plant->getOptions();
		
	
	if( isset($_POST["user_plant"] )){
		if( empty($_POST["user_plant"])) {
			$plantError = "Sisesta taime nimetus!  ";
		}else{
			$plant=$_POST["user_plant"];
        }
	}
	
	if( isset($_POST["waterings"])) {
		if( empty($_POST["waterings"])) {
			$wateringIntervalError = "  Sisesta kastmisintervall!  ";
			} else { 
			$wateringInterval = $_POST["waterings"];
		}		
	}
	
	
	$pageName="data"
?>

<?php require("../header.php");?>



<div class="container"><br><br><br>
 <h3>Tere tulemast     <?=$_SESSION["firstName"];?>   <?=$_SESSION["lastName"];?>!</h3>
<div id="plantsForm" class="col-lg-6 col-sm-offset-6" style="background-color:rgba(0, 0, 0, 0.5)";>

		<ul class="nav nav-tabs" role="tablist">
			<li role="presentation" class="active"><a href="#MyPlänts" aria-controls="MyPlänts" role="tab" data-toggle="tab">Minu Pländid</a></li>
			<li role="presentation"><a href="#Muutmine" aria-controls="Muutmine" role="tab" data-toggle="tab">Lisa taim</a></li>
			<li role="presentation"><a href="#Soovitustest" aria-controls="Soovitustest" role="tab" data-toggle="tab">Vali meie taimedest</a></li>
		  </ul>
	
		<div class="tab-content"> <!----TABI ALGUS  --->
		
		
			<div role="tabpanel" class="tab-pane active" id="MyPlänts"><!--- TABI ESIMESE PANEELI SISU ALGUS --->
			
					<?php
						
						$direction = "ascending";
						if (isset($_GET["direction"])){
							if($_GET["direction"]=="ascending"){
								$direction="descending";
							}
							
						}
						
						$html = "<table class='table table-striped table-hover table-condensed table-bordered  ' style='background-color:white'>";
						$html .= "<tr>";
							$html .= "<th style='width:30px'><a href='?q=".$q."&sort=plantID&direction=".$direction."'>id</a></th>";
							$html .= "<th style='width:300px'><a href='?q=".$q."&sort=name&direction=".$direction."'>plant</a></th>";
							$html .= "<th style='width:50px'><a href='?q=".$q."&sort=interval&direction=".$direction."'>kasta</a></th>";
						$html .= "</tr>";
						
						$i = 1;
						//iga liikme kohta massiivis
						foreach($plantData as $p) {
							//iga taim on $p
							//echo $p->taim."<br>";
						
							
							$html .= "<tr>";
								$html .= "<td>".$p->id."</td>";
								$html .= "<td>".$p->name."</td>";
								$html .= "<td>".$p->intervals."</td>";
								$html .= "<td> 
                                <a href='edit.php?id=".$p->id."'>Edit</a>
                                <br>
                                <a href='?id=".$p->id."&deleted=true'>Kustuta</a>
                                </td>";
							$html .= "</tr>";
							
							$i += 1;
						}
						
						$html .= "</table>";
						
						echo $html;
						
						$listHtml="<br><br>";
						
						
						
						echo $listHtml;
				?>
							
			</div><!---TABI ESIMESE PANEELI SISU LÕPP-->
			
			
			<div role="tabpanel" class="tab-pane" id="Muutmine"><!---TABI TEISE PANEELI SISU ALGUS--->
					<div>		
							<h3> Toataimede sisestamine </h3>

					
							<form  class="form-group form-group-sm" id="insertPlants" method=POST>
								<?php echo $plantError;  ?>
								<?php echo $wateringIntervalError;  ?>

								  
										<h3>Sisesta taime nimetus</h3>
								<input  class="form-control" name="user_plant" placeholder="taime nimetus"  type="text" value="<?=$plant;?>" > 

										<h3>Sisesta taime kastmisintervall</h3>
								<input  class="form-control" name="waterings" placeholder="mitme päeva tagant"  type ="number"> 

								<input class="btn btn-default" type="submit" value="Salvesta">
							</form>
					</div>
							
							

							
							
			
			</div><!--- TABI TEISE PANEELI SISU LÕPP --->
			
			<div role="tabpanel" class="tab-pane" id="Soovitustest"> <!---Kolmanda tab-i algus--->
				<div id="plantFromPlantsDiv">
					<h3>Andmebaasist taime lisamine</h3>
					<script>
						window.onload = function(){
							var optionsList = document.getElementById("options");
							optionsList.addEventListener("change", function() {
								document.getElementById("watering").disabled = false;
								var water = document.querySelectorAll("#options option")[optionsList.selectedIndex].dataset.water;
								document.getElementById("watering").value = water;
							});
						}
					</script>
						<form class="form-group form-group-sm" id="plantsFromPlantsForm" method=post >
				 					<select name="plant" id="options">
									<option value="" disabled selected>Select your option</option>
									<?php foreach($options as $option): ?>
									  <option data-water="<?=$option->intervals?>" value="<?=$option->id?>"><?=$option->plants?></option>
									 <?php endforeach; ?>
									</select>
									<h3>Sisesta taime kastmisintervall</h3>
								<input disabled id="watering" class="form-control" name="watering" placeholder="mitme päeva tagant"  type ="number"> 

								<input class="btn btn-default" type="submit" value="Salvesta">
						</form>
					
				</div>
			</div><!---Kolmanda tab-i lõpp--->
		  </div>

		
		
		
	</div>
	
	</div><br><br>

 

<?php require("../header.php"); ?>


<div class="container col-lg-6" style="background-color:rgba(0, 0, 0, 0.5);">
			 <?php
						
						if(isset($_POST['color']))
{
echo "The Color you have selected ".$_POST['color'];
} 
    
						$html = "<table style='color: white; table;'>";
						
						//iga liikme kohta massiivis
						foreach($plantData as $p) {
							//iga taim on $p
							//echo $p->taim."<br>";
						
                            
							$html .= "<tr>";
								$html .= '<td>
                                <form action="" method="post">
                                <input type="checkbox" name="color" onclick="javascript: submit()" value="'.$p->id.'"</form>
                                </td>';
								$html .= "<td>".$p->id."</td>";
								$html .= "<td>".$p->name."</td>";
								$html .= "<td>".$p->intervals."</td>";
                                
								
							$html .= "</tr>";
                            
						}
						
						$html .= "</table>";
						
						echo $html;
						
						$listHtml="<br><br>";
						
						
						
						echo $listHtml;?>
           
						
</div>	

<?php require("../footer.php");?>

