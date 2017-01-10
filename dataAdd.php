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
	
	var_dump($_POST);
	

?>



<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>WasteChase</title>
		<link type="text/css" rel="stylesheet" href="stylesheet.css" />
		<link rel="stylesheet" href="jquery/jquery-ui.min.css">
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
				  <li><a href="dataItems.php">data Items</a></li>
				  <li><a class="active" href="dataAdd.php">data Add</a></li>
				  <li><a href="dataEdit.php">data Edit</a></li>
				  <li id="logout"><a href="?logout=1" >logi välja</a></li>
				</ul>
			
			</div><!--.menu-->
		
			<div class="insert box" >
			
				<p>Ostu sisestamiseks täitke järgnevad väljad</p>
				
				<form method="POST" >
	
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
								<input name="category[]" type="text" >
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