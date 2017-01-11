<?php 
	require("../functions.php");
	
	if (isset($_GET["logout"])) {
		
		session_destroy();
		header("Location: login.php");
		exit();
		
	}
?>

<html>
	<style>
		#container {
			width:100%;
			text-align:center;
		}

		#left {
			float:left;
		}

		#center {
			display: inline-block;
			margin:0 auto;
		}
		
		#center1 {
			display: inline-block;
			margin:0 auto;
			padding-right: 3cm;
		}

		#right {
			float:right;
		}
		
		ul {
			list-style-type: none;
			margin: 0;
			padding: 0;
			overflow: hidden;
			background-color: #FFFFFF;
		}

		li {
			float: left;
		}

		li a, .dropbtn {
			display: inline-block;
			color: black;
			text-align: center;
			padding: 14px 16px;
			text-decoration: none;
			font-family: 'Open Sans', sans-serif;
		}

		li a:hover, .dropdown:hover .dropbtn {
			background-color: #fafafa;
		}

		li.dropdown {
			display: inline-block;
		}

		.dropdown-content {
			display: none;
			position: absolute;
			background-color: #ffffff;
			min-width: 160px;
		}

		.dropdown-content a {
			color: black;
			padding: 12px 16px;
			text-decoration: none;
			display: block;
			text-align: left;
		}

		.dropdown-content a:hover {background-color: #fafafa}

		.dropdown:hover .dropdown-content {
			display: block;
		}
		
		.button {
			background-color: #4CAF50;
			border: none;
			color: white;
			padding: 8px 20px;
			text-align: center;
			text-decoration: none;
			display: inline-block;
			font-size: 14px;
			margin: 4px 2px;
			-webkit-transition-duration: 0.4s;
			transition-duration: 0.4s;
			cursor: pointer;
			font-family: 'Open Sans', sans-serif;
		}
		
		.button1 {
			background-color: white;
			color: black;
			border: 1px solid #000000;
		}

		.button1:hover {
			background-color: #555555;
			color: white;
		}
	</style>
	<body>
		<div id="container">
			<div id="left">
				<img src="../thelogo.png">
			</div>
			<div id="center">
				<img src="../tri.gif"><img src="../fuse.gif"><br>
			</div>
			<div id="right">
				<a href="data.php" class="button button1">Upload</a>
				<a href="?logout=1" class="button button1">Logout</a>
			</div>

		</div>
		<div id="container">
			<div id="center1">
				<ul>
					<li><a href="home.php">Home</a></li>
					<li class="dropdown">
						<a href="javascript:void(0)" class="dropbtn">Pictures</a>
						<div class="dropdown-content">
							<a href="pictures_animals_listImages.php">Animals</a>
							<a href="pictures_nature_listImages.php">Nature</a>
						</div>
					</li>
					<li class="dropdown">
						<a href="javascript:void(0)" class="dropbtn">Gifs</a>
						<div class="dropdown-content">
							<a href="gifs_animals_listImages.php">Animals</a>
							<a href="gifs_art_listImages.php">Art</a>
							<a href="gifs_nature_listImages.php">Nature</a>
						</div>
					</li>
				</ul>
			</div>
		</div>
		<div id="container">
			<div id="center">
				<img src="../line.png">
			</div>
		</div>
	</body>
</html>