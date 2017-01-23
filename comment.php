<?php

	require("functions.php");
	require("style/style.php");
	require("style/pagestyle.php");
	
	//LOGOUT
	if (isset($_GET["logout"])) {
		session_destroy();
		header("Location: loginpage.php");
		exit();
	}
	
	
	//REGISTREERIMISE ANDMED
	function send_comment($feedback){
	
		$mysqli = new mysqli($GLOBALS["serverHost"], 
		$GLOBALS["serverUsername"], 
		$GLOBALS["serverPassword"], 
		$GLOBALS["database"]);
		
		$feedback = $_POST["feedback"];
		
		$stmt = $mysqli ->prepare("INSERT INTO grupp_comment ( feedback, email_id, comment_id) VALUE(?, ?, ?)");
		echo $mysqli->error;
		$stmt->bind_param("ssi", $feedback, $_SESSION["userEmail"],$_GET["id"]);
	
		if($stmt->execute() ) {			
		}
	}
	
	//KOMMENTAARIDE NÄITAMINE
	function show_comment(){
		
		$mysqli = new mysqli($GLOBALS["serverHost"], 
		$GLOBALS["serverUsername"], 
		$GLOBALS["serverPassword"], 
		$GLOBALS["database"]);
		
		$stmt = $mysqli->prepare("
		SELECT feedback, email_id
		FROM grupp_comment
		WHERE comment_id = ?
		");
		
		$stmt->bind_param("s", $_GET["id"]);
		$stmt->bind_result($feedback, $email );
		$stmt->execute();
		$results = array();
		
		while ($stmt->fetch()) {
			$human = new StdClass();
			$human->feedback = $feedback;
			$human->email = $email;
			array_push($results, $human);	
		}
		return $results;
	}

	//SALVESTAMINE
	if (isset ($_POST["feedback"]) &&
		!empty ($_POST["feedback"])
		)
	
	//KOMMENTAARI SAAMINE
	{
	send_comment($_POST["feedback"],$_SESSION["userEmail"],$_GET["id"]);
	}
	
	$people = show_comment();
	
	$p = getsingleId($_GET["id"]);
	
?>

<html>

<body>
	<ul>
		<li><a class="active1" href="homepage.php">AVALEHT</a></li>
		<li><a class="active" href="forumpage.php">FOORUM</a></li>
		<li><a class="active1" href="userpage.php">MINU KASUTAJA</a></li>
		<li><a class="active1" href="?logout=1">LOGI VÄLJA</a></li>
	</ul>
	
<div style="page">


<p class="down"> <a href="forumpage.php"> FOORUM </a> / KOMMENTAARID </p>

<br><br>

<?php 
$html = "<table>";

	$html .= "<tr>";
		$html .= "<td>".$p->email."</td>";
		$html .= "<td>".$p->headline."</td>";
		$html .= "<td>".$p->comment."</td>";
		
	$html .= "</tr>";

$html .= "</table>";
echo $html
?>

<br><br>	
	
<?php 
$html1 = "<table>";
	foreach ($people as $p) {
	$html1 .= "<tr>";
		$html1 .= "<td>".$p->email."</td>";
		$html1 .= "<td>".$p->feedback."</a></td>";
	$html1 .= "</tr>";
	}
$html1 .= "</table>";
echo $html1
?>

<center>
	<form method="POST">
	
	<!--FEEDBACK-->
	<input name="feedback" class="text" placeholder="Jäta kommentaar">
	
	<br><input type="submit"  class="submit submit1" value="Saada"></br>

	</form>
</center>

<br><br>
<p class="down"></p>


</div>
</body>
</html>