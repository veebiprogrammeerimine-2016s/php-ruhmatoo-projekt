<?php
	
	require("functions.php");
	require("style/style.php");
	require("style/pagestyle.php");

	if (!isset ($_SESSION["userId"])) {
		header("Location: loginpage.php");
		exit();	
	}
	
	//LOG OUT
	if (isset($_GET["logout"])) {
		session_destroy();
		header("Location: loginpage.php");
		exit();
	}
	
	$people = allinfo();
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

<p class="down"> FOORUM </p>

<table class="table1">
	
	<td>
		<form action="post">
		<input type="button" onclick="location.href='createnewpost.php';" value="UUS POSTITUS " class="submit2">
		</form>
	</td>
	<td>
		<form method="POST">
		<input type="button" value="MINU POSTITUSED" class="submit2" onclick="location.href='viewmypost.php';">
		</form>
	</td>
	<td>
		<form method="POST">
		<input type="button" value="MINU KOMMENTAARID" class="submit2" onclick="location.href='viewmycomments.php';">
		</form>
	</td>

</table>

<p class="down"></p>

<?php 
$html = "<table>";
	
	$html .= "<tr>";
		$html .= "<th>Kasutaja</th>";
		$html .= "<th>Pealkiri</th>";
		$html .= "<th>Kategooria</th>";
		$html .= "<th>Kellaaeg</th>";
		$html .= "<th></th>";
	$html .= "</tr>";

	
	foreach ($people as $p) {
	$html .= "<tr>";
		$html .= "<td>".$p->email."</td>";
		$html .= "<td>".$p->headline."</td>";
		$html .= "<td>".$p->category."</a></td>";
		$html .= "<td>".$p->created."</td>";
		$html .= "<td><a href='comment.php?id=".$p->id."'>Vasta</a></td>";
	$html .= "</tr>";
	}

	$html .= "</table>";
	
echo $html
?>

	</div>
</body>
</html>	