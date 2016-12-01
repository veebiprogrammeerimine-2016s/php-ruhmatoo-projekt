<?php
require("header.php");
$aboutUser = "Tere! Olen lihtsalt suvaline tegelane. Elan vanas majas ja minu juhtmed ja torud lähevad pidevalt katki ja umbe, seega jõlgun siin saidil tihti.";
?>
<style>
.top {
	height: 2.5em;
	background: white;
	width: 100%;
	margin: 0;
	padding: .5em;
	border-bottom: 2px solid gray;
}
.left {
	float: left;
	width: 20%;
	height: 80%;
	background: white;
	border-right: 2px solid gray;
	padding: 1em;
	border-bottom: 2px solid gray;
	margin: 0;
}

.right {
	float: left;
	width: 80%;
	height: 80%;
	background: white;
	padding: 1em;
	padding-left: 2em;
	border-bottom: 2px solid gray;
	margin: 0;
}
.bottom {
	overflow: hidden;
	height: 16em;
	width: 100%;
	background: white;
	margin: 0;
	padding: 0.5em;
}

.third {
	width: 50%;
	height: 100%;
	border-bottom: 1px solid gainsboro;
	padding: 1em;
	margin-bottom: 1em;
	margin-right: auto;
}

h5 {
	margin-top: 0;
	margin-bottom: 1em;
}
@media only screen and (max-width: 768px) {
	.left {
	clear: both;
	width: 100%;
	}
	.right {
	clear: both;
	width: 100%;}
	.third {
	clear: both;
	width: 100%;
	}

}
</style>
<title>Kasutaja && profiil</title>
<div class="mdl-layout mdl-js-layout">
<header class="mdl-layout__header">
<div class="mdl-layout-icon"></div>
<div class="mdl-layout__header-row">
<span class="mdl-layout__title"><?php echo $appName; ?></span>
<div class="mdl-layout-spacer"></div>
<nav class="mdl-navigation">
</nav>
</div>
</header>
</div>
<div style="clear: both;"></div>
<div class="left">
<h2>Profiil</h2>
<p><b>Nimi:</b> <?php echo "NULL";?></p>
</div>

<div class="right"">
<h2>Kasutajast</h2>
<h3>Natuke endast</h3>
<p><?php echo $aboutUser;?></p>
</div>

<div class="bottom">
<div class="third">
<h5 style="margin-top: 0em; margin-bottom: 1em;"><?php echo $appName;?></h5>
<p>Abi | Privaatsus</p>
</div>
<div class="third">
<h5>Tagasiside</h5>
</div>
<div class="third">
<h5>Kontakt</h5>
<p>Elle: <br>Kristel: <br>Mihkel:</p>
</div>
<div style="clear: both; height: 2.5em; width: 100%;">
<p>Veebiprogrammeerimine 2016</p>
</div>
</div>

<?php require("footer.php"); ?>
