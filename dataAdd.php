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
	
	//var_dump();
	
	if (isset($_POST["storeName"])) {
	
		if (isset($_POST["shoppingDate"])){
			
			$date = date_create($_POST["shoppingDate"]);
			
			$date = date_format($date, "Y-m-d");
			
			if (isset($_POST["receiptNumber"])){
				
				if (isset($_POST["Category"])){
					
					if (isset($_POST["productName"])){
						
						if (isset($_POST["productPrice"])){
					
							$Data->DataAdd($_POST["storeName"], $date, $_POST["receiptNumber"], $_POST["Category"], $_POST["productName"], $_POST["productPrice"]);
						
						}
					}
				}
			}
		}
		
	}


	
	
?>



<!DOCTYPE html>
<html ng-app="plunker">
	<head>
		<meta charset="utf-8">
		<title>WasteChase</title>
		<link type="text/css" rel="stylesheet" href="stylesheet.css" />
		<link rel="stylesheet" href="jquery/jquery-ui.min.css">
	</head>
	
	<body ng-controller="MainCtrl">
		<header>
			<h1>WasteChase</h1>
			<p> Chasing your Spending</p>
		</header>
		
		<div class="wrapper">
		
			<div class="menu"> 
		
				<ul>
				  <li><a href="data.php">Data</a></li>
				  <li><a href="dataItems.php">data Items</a></li>
				  <li><a class="active" href="dataAdd.php">data Add</a></li>
				  <li><a href="dataEdit.php">data Edit</a></li>
				  <li id="logout"><a href="?logout=1" >logi välja</a></li>
				</ul>
			
			</div><!--.menu-->
		
			<div class="insert box" >
			
				<p>Ostu sisestamiseks täitke järgnevad väljad</p>
				
				<form method="POST" action="dataAdd.php" >
	
					<div class="storeName" >
						<label for="storeName" >Pood</label><br>
						<input name="storeName" type="text" id="storeName" >
					</div>
					
					<div class="shoppingDate" >
						<label for="date" >Ostukuupäev</label><br>
						<input name="shoppingDate" type="text" id="date" > <!-- id siin teises stiilis kuna jQuery datepicker kasutab sellist id'd -->
					</div>
					
					<div class="receiptNumber" >
						<label for="receiptNumber" >Tsekinumber</label><br>
						<input name="receiptNumber" type="text" id="receiptNumber" >
					</div>
				
					<div class="dynamicFields">
					
						<div class="singleField">
					
							<div class="singleInput">
								<label>Kategooria</label><br>
									<select name = "Category[]">
										<option value="1">Saiad ja leivad</option>
										<option value="2">Lihatooted</option>
										<option value="3">Jahutooted</option>
										<option value="4">Köögiviljad</option>
										<option value="5">Kohv, tee ja kakao</option>
										<option value="6">Kokkamismaterjalid</option>
										<option value="7">Tervisetooted</option>
										<option value="8">Köögitarbed</option>
										<option value="9">Rämpstoit</option>
										<option value="10">Hügieenitarbed</option>
										<option value="14">Alkohol</option>
										<option value="15">Tubakas</option>
										<option value="16">Koduhooldus</option>
									</select>
							</div>
							
							<div class="singleInput">
								<label>Toode</label><br>
								<input name="productName[]" type="text" >
							</div>
							
							<div class="singleInput">
								<label>Hind</label><br>
								<input name="productPrice[]" type="number" step="0.01" min="0" >
							</div>
						
						</div>
						
					</div>
					
					<input type="button" value="Lisa väli" id="add" >
					
					<input type="submit" value="Sisesta" >
					

				</form>
				
			</div><!--.insert box-->
			
		
		</div><!--.wrapper-->
		<footer>Footer</footer>
		
		<script src="jquery/jquery-3.1.1.js"></script>
		<script src="jquery/external/jquery/jquery.js"></script>
		<script src="jquery/jquery-ui.min.js"></script>
		<script src="jquery/custom.js"></script>
		
	</body>
</html>