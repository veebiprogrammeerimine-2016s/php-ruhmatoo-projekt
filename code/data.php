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
<head>
<link rel="stylesheet" href="pikaday.css">
<link rel="stylesheet" href="site.css">
<link rel="stylesheet" href="theme.css">
<link rel="stylesheet" href="triangle.css">
</head>
<link rel="stylesheet" href="pikaday.css">

<h1><a href="about.php"> About</a> Home</a> <a href="user.php"> Contacts</a> <?=$_SESSION["userEmail"];?>!</a>
	<a href="?logout=1">Logout</a></h1>

<?=$msg;?>

<h2>What do you need to get done?</h2>
<form method="POST">
	
	<label>Task</label><br>
	<input name="task" type="text"> 
	<br><br>
	
	<label>Deadline</label><br>
	<input name="date" type="text" id="datepicker">
	<br><br>
	
	<input type="submit" value="Save">
	
	
</form>

<h2>Tasks</h2>
<?php 
	
	$html = "<table>";
	
	$html .= "<tr>";
		$html .= "<th>id</th>";
		$html .= "<th>task</th>";
		$html .= "<th>date</th>";
	$html .= "</tr>";
	
	//iga liikme kohta massiivis
	foreach($taskData as $c){
		// iga auto on $c
		//echo $c->plate."<br>";
		
		$html .= "<tr>";
			$html .= "<td>".$c->id."</td>";
			$html .= "<td>".$c->task."</td>";
			$html .= "<td>".$c->date."</td>";
		$html .= "</tr>";
	}
	
	$html .= "</table>";
	
	echo $html;
	
	
	$listHtml = "<br><br>";
	
	
	
?>

<br>
<br>
<br>
<br>
<br>
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