<?php
require("header.php");
$sendFeedback = 0;
$feedbackSuccessful = 0;
$feedbackFailed = 0;
$feedbackSent = 0;
if (!empty($_POST["title"])) {
	if (!empty($_POST["content"])) {
		$title = cleanInput($_POST["title"]);
		$content = cleanInput($_POST["content"]);
		$sendFeedback = 1;
	} {
		$feedbackSent = 1;
		$feedbackFailed = 1;
	}
} else {
	$feedbackSent = 1;
	$feedbackFailed = 1;
}
if ($sendFeedback == 1) {
	$feedbackSent = 1;
	$conn = new mysqli($server, $user, $pass, $db);
	if ($conn->connect_error) {
		echo "SHIT HAPPENED";
	}
	if ($conn->connect_error) {
		die("Connection failed: ".$conn->connect_error);
	}
	$sql = "INSERT INTO feedback (title, content) values ('".$title."','". $content."')";
	if ($conn->query($sql) == TRUE) {
		$feedbackSuccessful = 1;
		$feedbackFailed = 0;
	} else {
		$feedbackFailed = 1;
	}
	mysqli_close($conn);
}
?>
<head>
<title>Tagasiside lehe kohta</title>
</head>

<header>
<div class="row">
<div class="header c-12">Tagasiside</div>
</div>
</header>

<body>
<div class="row">
<div class="c-6">
<h2>Saada tagasisidet</h2>
<form method="post">
<input type="text" name="title" placeholder="Pealkiri" style="width: 100%;"><br>
<textarea name="content" placeholder="Tagasiside" style="width: 100%; font-family: Roboto; font-size: 1em; padding: 4px;" rows=5></textarea><br><br>
<input type="submit" value="Saada tagasisidet">
</form>
<br><br>
<?php
if ($feedbackSent == 1) {
	if ($feedbackFailed == 1) {
		echo "Tagasiside saatmine ebaõnnestus";
	}
	if ($feedbackSuccessful == 1) {
		echo "Täname tagasiside eest!";
	}
}
?>
</div>
</div>
</body>


<?php
require("footer.php");
?>
