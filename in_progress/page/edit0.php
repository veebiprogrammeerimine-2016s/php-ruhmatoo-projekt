  <?php 
	// et saada ligi sessioonile
	require("../functions.php");
	
    require("../class/Helper.class.php");
	$Helper = new Helper();
	
	require("../class/Note.class.php");
	$Note = new Note($mysqli);
	
	require("../header.php"); 
	
	//ei ole sisseloginud, suunan login lehele
	if(!isset ($_SESSION["userId"])) {
		header("Location: login.php");
		exit();
	}
	
	//kas kasutaja tahab vдlja logida
	// kas aadressireal on logout olemas
	if (isset($_GET["logout"])) {
		
		session_destroy();
		
		header("Location: login.php");
		exit();
	}
	
	
	$q = "";
	
	// otsisхna aadressirealt
	if(isset($_GET["q"])){
		$q = $Helper->cleanInput($_GET["q"]);
	}
	
	//vaikimisi
	$sort = "id";
	$order = "ASC";
	
	if(isset($_GET["sort"]) && isset($_GET["order"])){
		$sort = $_GET["sort"];
		$order = $_GET["order"];
	}
	
	
	$notes = $Note->getAllNotes($q, $sort, $order); 
	
	
	
	?>
<a href="index.php"> Back </a>
	
  <?php 
	$html = "<table class='table'>";
		
		$html .= "<tr>";
			
		
			$orderId = "ASC";
			
			if (isset($_GET["order"]) && 
				$_GET["order"] == "ASC" && 
				$_GET["sort"] == "id" ){
				
				$orderId = "DESC";
			}
		
			$html .= "<th>
			
						<a href='?q=".$q."&sort=id&order=".$orderId."'>
							id
						</a>
					</th>";
			
				
		$html .= "</tr>";
			$html .= "<th>id";
			$html .= "<th>paid_warranty";
			$html .= "<th>serialnumber";
			$html .= "<th>device";
			$html .= "<th>manufacturer";
			$html .= "<th>model";
			$html .= "<th>date_of_purchase";
			$html .= "<th>first_lastname";
			$html .= "<th>country";
			$html .= "<th>city";
			$html .= "<th>address";
			//$html .= "<th>postcode";
			$html .= "<th>email";
			$html .= "<th>number";
			$html .= "<th>problem";
			//$html .= "<th>add_info";
			$html .= "<th>rma";
			$html .= "<th>status";
			
	foreach ($notes as $note) {
		$html .= "<tr>";
			$html .= "<td>".$note->id."</td>";
			$html .= "<td>".$note->paid_warranty."</td>";
			$html .= "<td>".$note->serialnumber."</td>";
			$html .= "<td>".$note->device."</td>";
			$html .= "<td>".$note->manufacturer."</td>";
			$html .= "<td>".$note->model."</td>";
			$html .= "<td>".$note->date_of_purchase."</td>";
			$html .= "<td>".$note->first_lastname."</td>";
			$html .= "<td>".$note->country."</td>";
			$html .= "<td>".$note->city."</td>";
			$html .= "<td>".$note->address."</td>";
			//$html .= "<td>".$note->postcode."</td>";
			$html .= "<td>".$note->email."</td>";
			$html .= "<td>".$note->number."</td>";
			$html .= "<td>".$note->problem."</td>";
			//$html .= "<td>".$note->add_info."</td>";
			$html .= "<td>".$note->rma."</td>";
			$html .= "<td>".$note->status."</td>";
			$html .= "<td><a href='edit.php?id=".$note->id."'> <span class='glyphicon glyphicon-pencil'><span></a></td>";
		$html .= "</tr>";
	}
	
	$html .= "</table>";
	
	echo $html;
?>