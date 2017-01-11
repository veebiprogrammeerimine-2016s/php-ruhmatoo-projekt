<?php 
	///https://github.com/dbushell/Pikaday
	require("functions.php");
	
	//kui ei ole kasutaja id'd
	if (!isset($_SESSION["userId"])){
		
		//suunan sisselogimise lehele
		header("Location: login.php");
		exit();
	}
	
	
	// MUUTUJAD
	$newTask = "";
	$newTaskError = "";
	
	//kui on ?logout aadressireal siis login välja
	if (isset($_GET["logout"])) {
		
		session_destroy();
		header("Location: login.php");
		exit();
	}
	
	$msg = "";
	if(isset($_SESSION["message"])){
		$msg = $_SESSION["message"];
		
		//kui ühe näitame siis kustuta ära, et pärast refreshi ei näitaks
		unset($_SESSION["message"]);
	}
	
	
	if ( isset($_POST["task"]) && 
		isset($_POST["task"]) && 
		!empty($_POST["date"]) && 
		!empty($_POST["date"])
	  ) {
		  
		saveTask(cleanInput($_POST["task"]), cleanInput($_POST["date"]));
		
	}
	
	//saan kõik ülesannete andmed
	$taskData = getAllTasks();
	//echo "<pre>";
	//var_dump($taskData);
	//echo "</pre>";
	
///<link rel="stylesheet" href="site.css">
///<link rel="stylesheet" href="theme.css">
///<link rel="stylesheet" href="triangle.css">
///järgmisele reale kui soovin teisiti
?>

<!DOCTYPE HTML>
<link rel="stylesheet" href="pikaday.css">
<html>
	<head>
		<title>e-Diary | Home</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body>

		<!-- Header -->
			<header id="header">
				<div class="inner">
					<a href="index.html" class="logo">e-Diary</a>
					<nav id="nav">
<a href="about.php"> About</a> <a href="data.php"> Home</a> <a href="user.php"> Contacts</a> <?=$_SESSION["userEmail"];?>!</a>
	<a href="?logout=1">Logout</a>
					</nav>
				</div>
			</header>
			<a href="#menu" class="navPanelToggle"><span class="fa fa-bars"></span></a>

		<!-- Main -->
			<section id="main">
				<div class="inner">
					<header class="major special">
						<h1>YOUR SCHEDULED TASKS</h1>
						<?php 
	
	$html = "<table>";
	
	$html .= "<tr>";
		$html .= "<th>id</th>";
		$html .= "<th>task</th>";
		$html .= "<th>date</th>";
	$html .= "</tr>";
	
	//iga liikme kohta massiivis
	foreach($taskData as $c){

		
		$html .= "<tr>";
			$html .= "<td>".$c->id."</td>";
			$html .= "<td>".$c->task."</td>";
			$html .= "<td>".$c->date."</td>";
			$html .= "<td><a href='edit.php?id=".$c->id."'><span class='glyphicon glyphicon-pencil'></span> Change</a></td>";
	
		$html .= "</tr>";
	}
	
	$html .= "</table>";
	
	echo $html;
	
	
	$listHtml = "<br><br>";
	
	
	
?>
						
					</header>

					<!-- Text -->
						<section>
							<h3>IS THERE ANYTHING MISSING? ADD!</h3>
							<form method="POST">
	
				<input type="hidden" name="id" value="<?=$_GET["id"];?>" > 
				<label>Task</label><br>
				<input name="task" type="text"> 
				<br>
	
				<label>Deadline</label><br>
				<input name="date" type="text" id="datepicker">
				<br>			
				<input a href="data.php" type="submit" name="update" value="Save">
</form>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>
			<script src="moment.js"></script>
<script src="pikaday.js"></script>
<script>
    var picker = new Pikaday({
        field: document.getElementById('datepicker'),
        format: 'YYYY-MM-D',
        onSelect: function() {
            console.log(this.getMoment().format('Do MMMM YYYY'));
        }
    });
</script>

	</body>
</html>