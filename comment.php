<?php

	require("functions.php");
	
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
			
			echo "Õnnestus!","<br>";			
		}
	}
	
	if (isset ($_POST["feedback"]) &&
		!empty ($_POST["feedback"])
		)
	
	{
	send_comment($_POST["feedback"],$_SESSION["userEmail"],$_GET["id"]);
	}

?>

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
<center>
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
</center>