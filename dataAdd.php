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
<script src="Lisaväljad.js" language="Javascript" type="text/javascript"></script>


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
				  <li><a href="dataItems.php">data Items</a></li>
				  <li><a class="active" href="dataAdd.php">data Add</a></li>
				  <li><a href="dataEdit.php">data Edit</a></li>
				  <li id="logout"><a href="?logout=1" >logi välja</a></li>
				</ul>
			
			</div><!--.menu-->
		
			<div class="insert box" >
			
				<p>Siin lehel toimub sissekannete lisamine</p>
				
				<form method="POST" >
	
					<label>Pood</label><br>
					<input name="storeName" type="text" >
					<br><br>
						<div id="inputs">
							<div class="single-item">
							<div id="dynamicInput">
								Toode 1<br><input type="text" name="myInputs[]">
							</div>

							<div id="dynamicInput2">
								Hind 1<br><input type="text" name="myInputs[]">
							</div>
							
							<div id="dynamicInput3">
								Kategooria 1<br><input type="text" name="myInputs[]">
							</div>
							<br>
							<a href="#" onclick="remove(this.parentElement);">Kustuta</a>
							</div>
						</div>
					<input type="button" value="Lisa toode" onClick="addInput('inputs');">
					<br>
					<?php
					/*
					<label>Kategooria</label><br>
					<input name="category" type="text" >
					<br><br>
					
					<label>Toode</label><br>
					<input name="productName" type="text" >
					<br><br>
					
					<label>Hind</label><br>
					<input name="productPrice" type="number" step="0.01" min="0">
					<br><br>
					*/
					?>
					<label>Ostukuupäev</label><br> <!--üks võimalik variant kalendri tegemiseks: http://stackoverflow.com/questions/24975667/html-input-type-date-open-calendar-by-default-->
					<input name="shoppingDate" type="number" >
					<br><br>
					
					<label>Tsekinumber</label><br>
					<input name="receiptNumber" type="number" >
					<br><br>
					
					<input type="submit" value="Sisesta">
					

				</form>
				
			</div><!--.insert box-->
			
		
		</div><!--.wrapper-->
		<footer>Footer</footer>
	</body>
</html>