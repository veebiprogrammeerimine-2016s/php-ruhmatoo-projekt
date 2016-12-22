<?php

require("../../../config.php");
require("../functions.php");

if(isset($_SESSION["userID"])){
	
	header("Location:data.php");
	exit();
}

	
	
	//MUUTUJAD
$signupEmail = "";
$signupPassword = "";
$signupEmailError = "";
$signupPasswordError = "";

if (isset($_GET["deleted"])){
		
		$Plant->deleteOne($_GET["id"]);
        $Plant->deleteTwo($_GET["id"]);
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
		
		if(isset($_GET["sort"]) && isset($_GET["direction"])){
		$sort=$_GET["sort"];
		$direction=$_GET["direction"];
	} else {
		//kui ei ole määratud siis vaikimisi id ja ASC
		$sort="id";
		$direction="ascending";
		
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
	
	
	$pageName = "care";
?>
<?php require("../header.php");?>
<br><br><br><br>

<div class=container>
		              <h3>Pländid ja hooldus</h3>  
    <form>
                
				<input type="search" name="q" value="<?=$q;?>">
				<input class="btn btn-success" type="submit" value="Otsi">
    </form>
</div>
<div class="container" id="para2TableHolder">
			 <div id="para2Table" class="container col-lg-9 sm-offset-6"> <?php
						
						$direction = "ascending";
						if (isset($_GET["direction"])){
							if($_GET["direction"]=="ascending"){
								$direction="descending";
							}
							
						}
						
						$html = "<table  class='table  table-hover'>";
						$html .= "<tr>";
							
                            $html .= "<th><a href='?q=".$q."&sort=id&direction=".$direction."'>pilt</a></th>";
							$html .= "<th style='width:20px'><a href='?q=".$q."&sort=id&direction=".$direction."'>id</a></th>";
							$html .= "<th style='width:250px'><a href='?q=".$q."&sort=name&direction=".$direction."'>taime nimetus</a></th>";
							$html .= "<th style='width:100px'><a href='?q=".$q."&sort=watering_day&direction=".$direction."'>kastmine</a></th>";
                            $html .= "<th style='width:300px''>nõuanded</th>";
						$html .= "</tr>";
						
						$i = 1;
						//iga liikme kohta massiivis
						foreach($plantData as $p) {
							//iga taim on $p
							//echo $p->taim."<br>";
						
                            $image="<img src'$p->url' width='175' height='200'/>";
                            
							$html .= "<tr>";
								
                                $html .= '<td><img src="'.$p->url. '" style= "width:128px" ></td>';
								$html .= "<td>".$p->id."</td>";
								$html .= "<td>".$p->name."</td>";
								$html .= "<td>".$p->intervals."</td>";
                                $html .= "<td>".$p->tip."</td>";
								
							$html .= "</tr>";
							
							$i += 1;
						}
						
						$html .= "</table>";
						
						echo $html;
						
						$listHtml="<br><br>";
						
						
						
						echo $listHtml;?>
                </div>	
						
</div>	

					


<?php require("../footer.php");?>