<?php
	//edit.php
	require("../functions.php");
	
    require("../class/Helper.class.php");
	$Helper = new Helper();

	require("../class/Note.class.php");
	$Note = new Note($mysqli);
	
	/// kas aadressireal on delete
	if(isset($_GET["delete"])){
		// saadan kaasa aadressirealt id
		$Note->deleteNote($_GET["id"]);
		header("Location: data.php");
		exit();
		
	}
	
	//kas kasutaja uuendab andmeid
	if(isset($_POST["update"])){
		
		$Note->updateNote($Helper->cleanInput($_POST["id"]), $Helper->cleanInput($_POST["firstname"]), $Helper->cleanInput($_POST["lastname"]), $Helper->cleanInput($_POST["notebook"]),$Helper->cleanInput($_POST["serialnumber"]),
		$Helper->cleanInput($_POST["priority"]), $Helper->cleanInput($_POST["comment"]));
		
		header("Location: edit.php?id=".$_POST["id"]."&success=true");
        exit();	
		
	}
	
	//saadan kaasa id
	$c = $Note->getSingleNoteData($_GET["id"]);
	//var_dump($c);

	
?>
<?php require("../header.php"); ?>

<br><br>
<a href="data.php"> Back </a>

<h2>Edit</h2>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
	<input type="hidden" name="id" value="<?=$_GET["id"];?>" > 
  	<label for="note" >Notes</label><br>
	<textarea  id="firstname" name="firstname"><?php echo $c->firstname;?></textarea><br>
	<textarea  id="lastname" name="lastname"><?php echo $c->lastname;?></textarea><br>
	<textarea  id="notebook" name="notebook"><?php echo $c->notebook;?></textarea><br>
	<textarea  id="serialnumber" name="serialnumber"><?php echo $c->serialnumber;?></textarea><br>
	<textarea  id="priority" name="priority"><?php echo $c->priority;?></textarea><br>
	<textarea  id="comment" name="comment"><?php echo $c->comment;?></textarea><br>
  	<!--<label for="color" >värv</label><br>
	<input id="color" name="color" type="color" value="<?//=$c->color;?>"><br><br>
  	-->
	<input type="submit" name="update" value="Save">
  </form>
  
<br>
<br>
<a href="?id=<?=$_GET["id"];?>&delete=true">Clean</a>
  
  
  
  
  
<?php require("../footer.php"); ?>
