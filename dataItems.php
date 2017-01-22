<?php
	require("functions.php");
	
	if (!isset($_SESSION["userId"])) {
		
		header("Location: login.php");
		exit();
	}
	
	
	if (isset($_GET["logout"])) {
		
		session_destroy();
		
		header("Location: login.php");
		exit();
	}

	$purchases = $Data->showPurchases();

	
	

	//$Categories = $Data->showCategories();
	
?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>WasteChase</title>
		<link type="text/css" rel="stylesheet" href="stylesheet.css" />
	</head>
	
	<body>
		<header>
			<h1>WasteChase</h1>
			<p> Chasing your Spending</p>
		</header>
		
		<div class="wrapper">
		
			<div class="menu"> 
		
				<ul>
				  <li><a href="data.php">Data</a></li>
				  <li><a class="active" href="dataItems.php">data Items</a></li>
				  <li><a href="dataAdd.php">data Add</a></li>
				  <li><a href="dataEdit.php">data Edit</a></li>
				  <li id="logout"><a href="?logout=1" >logi välja</a></li>
				</ul>
			
			</div><!--.menu-->
		
			<div class="box">
				<p><?php echo "Siia lehele tuleb üksikute sissekannete list koos selle sorteerimisega";
				
					$html = "<table border ='1' align = 'center'>";
						$html .= "<tr >";
							$html .= "<th>Pood</th>";
							$html .= "<th>Kuupäev</th>";
							$html .= "<th>Tšekinumber</th>";
							$html .= "<th>Toode</th>";
							$html .= "<th>Hind</th>";
							$html .="</tr>";
					
					
					foreach ($purchases as $p) {
						
						$html .= "<tr>";
							$html .= "<td>".$p->shop."</td>";
							$html .= "<td>".$p->shopdate."</td>";
							$html .= "<td>".$p->check."</td>";
							//$html .= "<td><a href='edit.php?id=".$p->id."'>edit.php</a></td>";
							$html .= "<td>";
							
							$purchaseContents = $Data->showPurchaseContents($p->id);
							
							foreach ($purchaseContents as $pc) {
								
						
							$html .= $pc->product."<br>";
							//$html .= "<td>".$pc->price."</td>"."<br>";
							//$html .= "<td>".$pc->categoryname."</td>";
							
							}
							$html .= "</td>";
							$html .= "<td>";
							
							foreach ($purchaseContents as $pc) {
								
						
							$html .= $pc->price."<br>";
							//$html .= "<td>".$pc->price."</td>"."<br>";
							//$html .= "<td>".$pc->categoryname."</td>";
							
							}
							$html .= "</td>";
						
							
						$html .= "</tr>";
					
						}
					
					$html .= "</table>";			
				
				echo $html;					
					
				?></p>
			</div><!--.BOX-->
			
		</div><!--.wrapper-->
		<footer>Footer</footer>
	</body>
</html>
