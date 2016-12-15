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
		
		$Note->updateNote($Helper->cleanInput($_POST["id"]), $Helper->cleanInput($_POST["note"]), $Helper->cleanInput($_POST["color"]));
		
		header("Location: edit.php?id=".$_POST["id"]."&success=true");
        exit();	
		
	}
	
	//saadan kaasa id
	$c = $Note->getSingleNoteData($_GET["id"]);
	//var_dump($c);

	
?>
<?php require("header3.php");?>
<br><br>
<a href="data.php"> tagasi </a>

<h2>Muuda kirjet</h2>
<br>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
	<input type="hidden" name="id" value="<?=$_GET["id"];?>" > 
  	<label for="kirjeldus" >Märkus</label><br>
	<textarea  id="kirjeldus" name="kirjeldus"><?php echo $c->description;?></textarea><br>
  	<label for="asukoht" >asukoht</label><br>
	<input  id="asukoht" name="asukoht"><?php echo $c->location;?></input><br>
  	<label for="kuupaev" >kuupäev</label><br>
	<input  id="kuupaev" name="kuupaev"><?php echo $c->date;?></input><br>
  	<label for="url" >url</label>
	<br>
	<img width='300' src="<?=$c->url;?>">
	<textarea  id="url" name="url"><?php echo $c->url;?></textarea><br>
  	
	<input type="submit" name="update" value="Salvesta">
  </form>
  
<br>
<br>
<a href="?id=<?=$_GET["id"];?>&delete=true">kustuta</a>
  
  <?php require("../booter.php");?>
  
  
  
  