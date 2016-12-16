<?php 
	//ühendan sessiooniga
	//kuradi git ma ütlen!
	require("../functions.php");

	require("../class/Helper.class.php");
	$Helper = new Helper($mysqli);
	
	require("../class/User.class.php");
	$User = new User($mysqli);
	
	require("../class/Comment.class.php");
	$Comment = new Comment($mysqli);
	
	require("../class/Post.class.php");
	$Post = new Post($mysqli);
	
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
	
	$topic=$_GET["topicid"];
	
	if (isset($_POST["comment"])) {
		
		if(!empty($_POST["comment"])) {
			
			$Comment->insertComment($topic,$_SESSION["userId"],$Helper->cleanInput($_POST["comment"]));
		}
		
	}
	
	$postError="";
	$postedTrue="";
	
	$postedTrue=$_GET['posted'];
	
	if ($postedTrue=="true") {
		
		$postError= "Your post was submitted!";
	}
	elseif ($postedTrue=="false") {
			
			$postError= "Something went wrong...";
	}
	
	
	if (isset($_GET["searchPost"]) && !empty($_GET["searchPost"])){
		
		//header("Location: data.php?search=".$_GET["searchPost"]);
		//echo "test";
		$search= $_GET["searchPost"];
		
	}
	$html="";
	$html2="";
	if (isset($_GET["topicid"])){
		
		$topic = $_GET["topicid"];
		$results=$Post->getTopicPost($topic);
		$results2=$Comment->getComments($topic);
		
	}
	
	
	//pre echob koodina
	//echo "<pre>";
	//var_dump($people);
	//echo "</pre>";
	

	
?>
<?php require("../header.php"); ?>
<div class="container">
	<div class="page-header">
		<h1>Thread #<?php echo $topic; ?></h1>
	</div>


	
	
	<p class="lead">
	<div class='container'>
	<div class='row'><div class='col-lg-4'>
	<?php
	foreach ($results as $r) {
			
			
			
		
			$html .= "<div><table>";
				$html .= "<tr><h2>".$r->name."</h2></tr>";
				$html .= "<td><img src=".$r->message."></td></table>";
				$html .= "Posted by <a href='user.php?username=".$r->author."'>". $r->author.'</a>';

			$html .= "</div>";
		
		}
	
	echo $html;
	?>
	</div></div>
	</p>
	
	
	
	
	
	
	<?php
	foreach ($results2 as $r2) {
			
			
			
		

				$html2 .= "	<div class='well well-sm'><b>".$r2->userid."</b><br><br>";
				$html2 .= $r2->comment;
				$html2 .= "<br><br><small class='text-muted'>Postitatud ".$r2->aeg."</small></div>";
		
		}
	
	echo $html2;
	?>
	

	
	
	
	
	<form class="form-inline" role="form" method="post">
		<input class="form-control input" type="text" name="comment" placeholder="Kirjuta kommentaar" />
			<div class="form-group">
				<button class="btn btn-default">Postita</button>
			</div>
	</form>
	<br><br>
	
	<h3><?php echo $postError;?></h3>
	

	
</div>
</div>

<?php //echo$_SESSION["userEmail"];?>

<?//=$_SESSION["userEmail"];?>




<?php require("../footer.php"); ?>