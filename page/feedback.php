<?php
require("header.php");
require("../class/class_feedback.php");
require("../class/class_general.php");
$fback = new feedback($dbconn);
$input = new input();

$sendFeedback = 0;
$feedbackSuccessful = 0;
$feedbackFailed = 0;
$feedbackSent = 0;

if (!empty($_POST["title"]) && !empty($_POST["content"])) {
	$title = $input->clean($_POST["title"]);
	$content = $input->clean($_POST["content"]);
	$sendFeedback = true;
	$feedbackSent = true;
	if ($fback->send($title, $content)) {
			$feedbackSuccessful = true;
		} else {
			$feedbackFailed = true;
		}
}


?>
<head>
<title>Tagasiside lehe kohta</title>
</head>

<header>
<div class="row">
<div class="header c-12"><a class="hbutton" href="home.php">< </a>Tagasiside</div>
</div>
</header>

<body>
<div class="row">
<div class="c-6">
<h2 style="color: burlywood;">Saada tagasisidet</h2>
<form method="post">
<input type="text" name="title" placeholder="Pealkiri" style="width: 100%; color: black;" required><br>
<textarea name="content" placeholder="Tagasiside" style="width: 100%; font-family: Roboto; font-size: 1em; padding: 4px;" rows=5 required></textarea><br><br>
<input type="submit" class="button" style="color: white;" value="Saada tagasisidet">
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
