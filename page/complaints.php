<?php
require("header.php")
$sendFeedback = 0;
$feedbackSuccessful = 0;
$feedbackFailed = 0;
$feedbackSent = 0;
?>
<head>
  <title>Saada kaebus kasutaja kohta</title>
</head>

<header>
  <div class="row">
    <div class="header c-12"><a class="hbutton" href="home.php">< </a>Saada kaebus</div>
  </div>
</header>

<body>
  <div class="row">
    <div class="c-6">
      <h2>Saada kaebus kasutaja kohta</h2>
      <input type="text" name="title" placeholder="Pealkiri" style="width: 100%;"><br>
      <textarea name="contect" placeholder="Kaebus" style="width: 100%;" rows=5></textarea><br><br>
      <input type="submit" value="Saada kaebus">
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


<?php require("footer.php") ?>
