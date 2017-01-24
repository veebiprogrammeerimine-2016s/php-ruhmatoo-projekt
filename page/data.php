<?php

require("../functions.php");

	if(!isset($_SESSION["userId"])) {
		header("Location: login.php");
		exit();
	}

	if(isset($_GET["logout"])) {
		session_destroy();
		header("Location: productselect.php");
		exit();
	}

	if(isset($_POST["newpost"])) {
	
		$Products->createNewPost();
		$newPostData = $Products->getNewPostId();
		$newPostId = $newPostData->id;
		header("Location: createpost.php?id=".$newPostId);
		exit();
	}

$newPostBtn = "";
$modifyPostBtn = "disabled";
$pc = $Products->ifUserHasCreatedPost();
$upc = $pc->postcheck;

	if($upc == 0) {
		$newPostData = "";
	} else {
		$newPostData = $Products->getNewPostId();
		$newPostStatus = $newPostData->status;
		$newPostId = $newPostData->id;
		
		if($newPostStatus == 0) {
		$newPostBtn = "disabled";
		$modifyPostBtn = "";
		} else {
			$newPostBtn = "";
			$modifyPostBtn = "disabled";
		}
	}
require("../header.php"); 
?>


<div class="container">
	
	
<!-- MenÜÜ -->
	
		<ul class="nav nav-pills nav-stacked">
			<li role="presentation" class="active" ><a href="">Uus toote lisamine</a></li>
			<li role="presentation"><a href="myposts.php">Minu üleslaetud kuulutuste vaatamine</a></li>
		</ul>
	
	<div class="col-md-12 col-md-offset-0">
		<div>
			<h3></h3>
		</div>
		<div>
			<form method="POST">
				<fieldset <?php echo $newPostBtn; ?>>
					<label class="btn btn-primary btn-lg btn-block">
						Loo uus kuulutus<input type="submit" name="newpost" value="true" style="display: none;">
					</label>
				</fieldset>
			</form>
			<div>
				<br>
			</div>
			<fieldset <?php echo $modifyPostBtn; ?>>
				<a href="createpost.php?id=<?php echo $newPostId; ?>" class="btn btn-info btn-lg btn-block" role="button">Jätka oma kuulutuse loomist</a>
			</fieldset>
		</div>
	</div>

</div>

<?php require("../footer.php"); ?>