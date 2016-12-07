<?php 
	//ühendan sessiooniga
	//kuradi git ma ütlen!
	require("../functions.php");

	require("../class/Helper.class.php");
	$Helper = new Helper($mysqli);
	
	require("../class/User.class.php");
	$User = new User($mysqli);
	
	//kui ei ole sisseloginud, suunan login lehele
	if (!isset($_SESSION["userId"])) {
		header("Location: index.php");
		exit();
	}
	
	//kas aadressireal on logout
	if (isset($_GET["logout"])) {
		
		session_destroy();
		
		header("Location: ../index.php");
		exit();
		
	}
	$search ="";
	
	if (isset($_GET["searchPost"]) && !empty($_GET["searchPost"])){
		
		//header("Location: data.php?search=".$_GET["searchPost"]);
		//echo "test";
		$search= $_GET["searchPost"];
		
	}
	$topic=$_GET["topicid"];
	
	$results = $mysqli->prepare("SELECT submissions.id, caption, imgurl, username 
		FROM submissions 
		join user_sample on submissions.author=user_sample.id
		where submissions.id = $topic");
	

	$results->execute(); //Execute prepared Query
	$results->bind_result($id, $name, $message, $author); //bind variables to prepared statement
	//pre echob koodina
	//echo "<pre>";
	//var_dump($people);
	//echo "</pre>";
	
?>
<?php require("../header.php"); ?>
<div class="container">
	<div class="page-header">
		<h1>Topic nr x</h1>
	</div>
	<p class="lead">
	
	
	
	<?php
	while($results->fetch()){ //fetch values
		echo '<div>';
		echo '<table>';
		echo '<tr><h2>'.$name.'</h2></tr>';
		echo '<td>'."<img src=".$message." >".'</td>';
		echo '</table>';
		echo "Posted by: "."<a href='user.php?username=$author';?>$author</a>";
		echo '<br><br><br><br>';
		echo '</div>';
	}
	?>
	
	
	
	
	
	</p>
	
	

</div>
<?php //echo$_SESSION["userEmail"];?>

<?//=$_SESSION["userEmail"];?>




<?php require("../footer.php"); ?>