<?php

	require("functions.php");
	require("style/style.php");
	
	$p = getsingleId($_GET["id"]);
	
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
?>

<a href="homepage.php">back</a>

<?php 
$html = "<table>";
	
	$html .= "<tr>";
		$html .= "<th>Category</th>";
		$html .= "<th>Pealkiri</th>";
		$html .= "<th>Kommentaar</th>";
		$html .= "<th>Postitud</th>";
		$html .= "<th>Kasutaja</th>";	
	$html .= "</tr>";

	$html .= "<tr>";
		$html .= "<td>".$p->category."</a></td>";
		$html .= "<td>".$p->headline."</td>";
		$html .= "<td>".$p->comment."</td>";
		$html .= "<td>".$p->created."</td>";
		$html .= "<td>".$p->email."</td>";	
	$html .= "</tr>";

$html .= "</table>";
echo $html
?>


<html>
	<body>
	
	<form method="POST">
	
	<!--FEEDBACK-->
	<label for="feedback">Your feedback:</label><br>
	<input name="feedback" type="text1" placeholder="Leave your feedback">
	
	<br><input type="submit" value="Send your comment"></br>
	
	</form>
	
	</body>
</html>

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