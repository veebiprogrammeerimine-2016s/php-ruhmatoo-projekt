<?php 
	
	//FUNKTSIOONID
	require("functions.php");
	require("style/style.php");
	require("style/pagestyle.php");
	
	//UPDATING
	if(isset($_POST["update_posts"])){	
		updatePosts(cleanInput($_POST["category"]), cleanInput($_POST["headline"]), cleanInput($_POST["comment"]) );
		exit();	
	}
	
	//LOGOUT
	if (isset($_GET["logout"])) {
		session_destroy();
		header("Location: loginpage.php");
		exit();
	}

	$p = editpost($_GET["id"]);

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

<p class="down"> <a href="forumpage.php"> FORUM </a> / <a href="userpage.php"> MINU KASUTAJA</a> / <a href="viewmypost.php">MINU POSTITUSED</a> / MUUDA POSTITUSE </p>
 <center>
  
  <form method= "POST" >
	
	<br>
	<label for="category">Eriala:</label><br>
	<select name="category" id="category" required>
	<option value="<?php echo $p->category;?>"> <?php echo $p->category;?> </option>
	<option value="Balti filmi, meedia, kunstide ja kommunikatsiooni instituut">Balti filmi, meedia, kunstide ja kommunikatsiooni instituut</option>
	<option value="Digitehnoloogiate instituut">Digitehnoloogiate instituut</option>
	<option value="Haridusteaduste instituut">Haridusteaduste instituut</option>
	<option value="Huminaarteaduste instituut">Huminaarteaduste instituut</option>
	<option value="Loodus- ja terviseteaduste instituut">Loodus- ja terviseteaduste instituut</option>
	<option value="Ühiskonnateaduste instituut">Ühiskonnateaduste instituut</option>
	<option value="Haapsalu Kolledž">Haapsalu Kolledž</option>
	<option value="Rakvere Kolledž">Rakvere Kolledž</option>
	</select>

	
	<br><label for="headline" >Pealkiri:</label></br>
	<input class="text" name="headline" value="<?=$p->headline;?>" required> <br>

	<label for="comment" >Kommentaar:</label><br>
	<input id="comment" name="comment" class="text" value="<?php echo $p->comment;?>" required> <br>
  	
	<input type="submit" name="update_posts"  class="submit submit1" value="Salvesta">
  </form>
 
 </center>

<br><br>
<p class="down"></p>
 
</div>	
 

</body>
</html>
</html>