<?php

//HTML
require("messages.php");

// MUUTUJAD


$title = "";
$book_id = "";
$receiver_name = "";
$msg = "";
$note = "Saada kiri";
$error = "";


?>


<?php 
if(!isset($_SESSION["userId"])){
	header("Location:login.php");
}
if(isset($_GET["form"]) AND $_GET["form"] == 0){ 
	$note = 'Kiri saadetud!<br><a href="outbox.php">Saadetud kirjade</a> alt on näha, kui kiri on kätte saadud ja avatud.<br><br><br><a href="new_pm.php">Saada uus kiri! </a>';
}
//kui saan aadressirealt saaja id, siis vormi eeltäidetud kasutajanimi... VASTAMINE v UUS kiri
if(isset($_GET["contact"])){
	$receiver_id = $Helper->cleanInput($_GET["contact"]);
	$receiver_name = $User->getUsername($receiver_id);
}
//kui saan aadressirealt raamatu id, siis vormi eeltäidetud pealkiri raamatu pealkirjaga ...UUS kiri
if(isset($_GET["book"])){
	$book_id = $Helper->cleanInput($_GET["book"]);
	$title = $Book->getSingle($book_id)->title;
}
//kui saan aadressirealt kirja pealkirja, siis vastuses sama pealkiri.... VASTAMINE kirjale
if(isset($_GET["title"])){
	$title = $Helper->cleanInput($_GET["title"]);
	
}
if(isset($_POST["title"])){
	$receiver_name = $Helper->cleanInput($_POST["receiver_name"]);
	$title = $Helper->cleanInput($_POST["title"]);
	if(!empty($_POST["title"]) AND !empty($_POST["msg"]) AND !empty($_POST["receiver_name"])){
		$sender = $Helper->cleanInput($_SESSION["userId"]);
		$receiver_name = $Helper->cleanInput($_POST["receiver_name"]);  //vaja id-ks
		$receiver_id = $User->getUserId ($receiver_name);  //$book->user  antud raamatu sisestaja
		$title = $Helper->cleanInput($_POST["title"]);
		$msg = $Helper->cleanInput($_POST["msg"]);
		$note = $Messages->newMessage($sender, $receiver_id, $title, $msg);
		if($note == "Kiri saadetud!"){
			header ("Location:new_pm.php?form=false");
		}
	}else{
		$error = "Täida kõik väljad";
		
	}
	
}


?>





<?php
if(!isset($_GET["form"])){ ?>
	<td>
	<h4><?=$note?></h4>
	</td>
	</tr>
	<tr>
	<td></td>
	<td>
	<form method="post" class="form-inline">
	<div class="table-responsive">
	<table>
		<tr>
			<td>Pealkiri<span class="text-danger"> * </span></td>
			<td><input type="text" value="<?php echo $title; ?>" name="title" class="form-control focusedInput"></td>
		</tr>
		<tr>
			<td>Saaja<span class="text-danger"> * </span></td>
			<td><input type="text" placeholder="Kasutajanimi" value="<?php echo $receiver_name; ?>" name="receiver_name" class="form-control focusedInput"></td>
		</tr>
		<tr>
			<td>Sõnum<span class="text-danger"> * </span></td>
			<td><textarea cols="40" rows="5" name="msg" class="form-control focusedInput"></textarea></td>			
		</tr>	
		<tr>
		<td></td>
			<td><input type="submit"  value="Saada" class="btn btn-default"></td>
		</tr>
		<tr>
		    <td colspan="2"><div class="text-danger"><?=$error?></div></td>
		</tr>
	
	</table>
	</div>
	</form>
	</td>
	</tr>
</table>
	
<?php 
;} ?>

<?php require("../footer.php");?>
