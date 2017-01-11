<?php
	
	//FUNKTSIOONID
	require("functions.php");
	require("style/style.php");
	require("style/pagestyle.php");
	
	//LOGOUT
	if (isset($_GET["logout"])) {
		session_destroy();
		header("Location: loginpage.php");
		exit();
	}
	
	//UPDATING
	if(isset($_POST["update_nickname"])){	
		updateUsername(cleanInput($_POST["nickname"]));
		header("Location: userpage.php?id=".$_POST["id"]."&success=true");
		exit();	
	}
	
	//UPDATING
	if(isset($_POST["update_gender"])){	
		updateGender(cleanInput($_POST["gender"]));
		header("Location: userpage.php?id=".$_POST["id"]."&success=true");
		exit();	
	}
	
	$userprofile = profile();
	
?>
<html>
<body>
	<ul>
		<li><a class="active1" href="homepage.php">AVALEHT</a></li>
		<li><a class="active1" href="forumpage.php">FOORUM</a></li>
		<li><a class="active" href="userpage.php">MINU KASUTAJA</a></li>
		<li><a class="active1" href="?logout=1">LOGI VÄLJA</a></li>
	</ul>
<div style="page">
<p class="down"> <a href="userpage.php"> MINU KASUTAJA</a> </p>
<?php
$html = "<table>";
	
	foreach ($userprofile as $u) {
	$html .= "<tr>";
		$html .= "<th>Epost</th>";
		$html .= "<tr>";
		$html .= "<td>".$u->email."</a></td>";
		$html .= "<tr>";
		$html .= "<th>Nickname</th>";
		$html .= "<tr>";
		$html .= "<td>".$u->nickname."</td>";
		$html .= "<tr>";
		$html .= "<th>Sugu</th>";
		$html .= "<tr>";
		$html .= "<td>".$u->gender."</td>";
	$html .= "</tr>";
	}
$html .= "</table>";
echo $html
?>
<br><br>
<p class="down">UUENDA OMA ANDMEID</p>
<table class="table1">
	
	<tr>
	
	<form method="POST">
	<!--Username-->
	<label for="nickname">Uuenda oma kasutajanime:</label><br>
	<input name="nickname" class="text" placeholder="username" required>
	<input type="submit" name="update_nickname" class="submit submit1" value="Uuenda">
	<br><br>
	</form>
	</tr>
		
	
</table>
<p class="down">TEISED ANDMED</p>
<br><br>
<table class="table1">
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
<br><br>
<p class="down"></p>
</div>
</body>
</html>