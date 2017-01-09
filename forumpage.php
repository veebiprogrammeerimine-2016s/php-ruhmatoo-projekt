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
	
	//KOMMENTAARI SALVESTAMINE
	if (isset($_POST["category"])&&
		isset($_POST["headline"]) &&
		isset($_POST["comment"]) &&
		!empty($_POST["category"])&&
		!empty($_POST["headline"])&&
		!empty($_POST["comment"])
		)
	{
	comment($_POST["category"],$_POST["headline"], $_POST["comment"], $_SESSION["userEmail"]);
	}
	
	$people = allinfo();
?>

<html>

<body>
	<ul>
		<li><a class="active1" href="homepage.php">HOME</a></li>
		<li><a class="active" href="forumpage.php">FORUM</a></li>
		<li><a class="active1" href="userpage.php">MY ACCOUNT</a></li>
		<li><a class="active1" href="?logout=1">LOG OUT</a></li>
	</ul>

<div style="page">

<p class="down"> FORUM </p>

<table class="table1">
	
	<td>
		<form action="post">
		<input type="button" onclick="location.href='userpages/createnewpost.php';" value="CREATE NEW POST " class="submit submit2">
		</form>
	</td>
	<td>
		<form method="POST">
		<input type="button" value="VIEW MY POSTS" class="submit submit2" onclick="location.href='userpages/viewmypost.php';">
		</form>
	</td>
	<td>
		<form method="POST">
		<input type="button" value="VIEW MY COMMENTS" class="submit submit2" onclick="location.href='userpages/viewmycomments.php';">
		</form>
	</td>

</table>

<p class="down"></p>

<?php 
$html = "<table>";
	
	$html .= "<tr>";
		$html .= "<th>User</th>";
		$html .= "<th>Title</th>";
		$html .= "<th>Category</th>";
		$html .= "<th>Posted</th>";
		$html .= "<th></th>";
	$html .= "</tr>";

	
	foreach ($people as $p) {
	$html .= "<tr>";
		$html .= "<td>".$p->email."</td>";
		$html .= "<td>".$p->headline."</td>";
		$html .= "<td>".$p->category."</a></td>";
		$html .= "<td>".$p->created."</td>";
		$html .= "<td><a href='comment.php?id=".$p->id."'>Reply</a></td>";
	$html .= "</tr>";
	}

	$html .= "</table>";
	
echo $html
?>

	</div>
</body>
</html>	