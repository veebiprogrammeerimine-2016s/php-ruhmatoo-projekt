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
			
			if ( strlen($_POST["comment"])>3) {
				$Comment->insertComment($topic,$_SESSION["userId"],$Helper->cleanInput($_POST["comment"]));

			}
		} else {
			   echo "<script>";
			   echo "alert('php else');";
			   echo "</script>";
		}
		
	}
	$feedBack="";
	if (($_GET["posted"])=="true") {
			$feedBack="   <span style='visibility: hidden;'>tühi</span><div  id='teavitus' style='display:inline;' class='alert alert-success fade in'><strong>Postitatud!</strong></div>";
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
	$userId=$_SESSION["userId"];
	if (isset($_POST["reportC"])){
		
		$reportedCID=$_POST["commentId"];
		$Comment->reportComment($reportedCID,$userId,$topic);
		
	}
	
	if (isset($_GET["dup"])) {
		
		$postError="Oled juba teatanud selle kommentaari kohta!";
		
	}
	
	if (isset($_GET["suc"])) {
		
		$postError="Täname teavituse eest!";
		
	}
	
	
	//pre echob koodina
	//echo "<pre>";
	//var_dump($people);
	//echo "</pre>";
	

	
?>

<?php require("../header.php"); ?>
<div class="container">
	<div class="page-header">
		<h1>Teema #<?php echo $topic; ?></h1>
	</div>


	
	
	<p class="lead">
	<div class='container'>
	<div class='row'><div class='col-lg-4'>
	<?php
	foreach ($results as $r) {
			
			
			
		
			$html .= '<div style="padding-bottom:15px;" ><table>';
				$html .= "<tr><h2>".$r->name."</h2></tr>";
				$html .= "<td><img src=".$r->message."></td></table>";
				//$html .= " <a href='user.php?username=".$r->author."'>". $r->author.'</a>';

			$html .= "</div>";
		
		}
	
	echo $html;
	?>
	</div></div>
	</p>
	<div>
		<form class="form-inline" method="post">
		<input class="form-control input-sm" type="text" name="comment" placeholder="Kirjuta kommentaar" />  
		<button type="submit" class="btn btn-default btn-xs" id="postita"> Postita  </button>     <?php echo $feedBack; ?>

		</form>
		
	</div>
	<br>

	<br>
	<script >
			
			$(document).ready(function(){
				
				$("#teavitus").delay(1000).fadeOut('slow')
				
				$("form").submit(function(event){
				
					

				if ($('input').val() < 3) {
					alert("Kommentaar peab olema vähemalt 4 tähemärki pikk!");
					event.preventDefault();
				}
				});
			});

</script>
	<?php
	foreach ($results2 as $r2) {
			
			
			
		

				$html2 .= "<div class='well well-sm'><b>".$r2->userid."</b><span class='hidden'>".$r2->commentid."</span><small style='float:right;'class='text-muted'>".$r2->aeg."</small><br><br>";
				$html2 .= $r2->comment."<br>";
				$html2 .= "<small style='float:right;'class='text-muted'>"."<a class='report' href='#myModal' data-toggle='modal'><span class='glyphicon glyphicon-ban-circle'></a>"."</small><br></div>";
		
		}
	
	echo $html2;
	?>
	
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
	    <div class="modal-content">
			<div class="modal-header" style="padding:50px 50px;">
				<h2>Kas tegemist on ebasobiliku kommentaariga?</h2><br>
				<form method="post">
				<div class="row">
					<button type="submit" name="reportC" class="btn btn-block btn-default">Jah</button>
					<button type="button" class="btn btn-block btn-primary" data-dismiss="modal">Ei</button>
					<input type="hidden" name="commentId" value="<?php  echo $r2->commentid; ?>">
				</form>
				</div>
			</div>
		</div>
	</div>
</div> 
	
	

	<br><br>
	

	

	
</div>
</div>






<?php //echo$_SESSION["userEmail"];?>

<?//=$_SESSION["userEmail"];?>




<?php require("../footer.php"); ?>