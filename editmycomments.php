<?php

	//FUNKTSIOONID
	require("functions.php");
	require("style/style.php");
	require("style/pagestyle.php");
	
	//LOG OUT
	if (isset($_GET["logout"])) {
		session_destroy();
		header("Location: loginpage.php");
		exit();
	}
	
	//UPDATE
	if(isset($_POST["update_comments"])){	
		updateComments(cleanInput($_POST["feedback"]) );
		exit();	
	}

	$p = editcomment($_GET["id"]);

?>

<html>
	<style>

	</style>

<body>
	<ul>
		<li><a class="active1" href="homepage.php">AVALEHT</a></li>
		<li><a class="active1" href="forumpage.php">FOORUM</a></li>
		<li><a class="active" href="userpage.php">MINU KASUTAJA</a></li>
		<li><a class="active1" href="?logout=1">LOGI VÄLJA</a></li>
	</ul>

<div style="page">

<p class="down"> <a href="forumpage.php"> FORUM </a> / <a href="userpage.php"> MINU KASUTAJA</a> / <a href="viewmycomments.php"> MINU KOMMENTAARID </a> / MUUDA KOMMENTAARI </p>
 <center>
	
	<form method= "POST" >
	
	<label for="feedback" >Kommentaar:</label><br>
	<input id="feedback" name="feedback" class="text" value="<?php echo $p->feedback;?>" required> <br>
	
	<input type="submit" name="update_comments"  class="submit submit1" value="Salvesta">
	
	</form>
	
 </center>
 
<br><br>
<p class="down"></p>
 
</div>

</body>
</html>