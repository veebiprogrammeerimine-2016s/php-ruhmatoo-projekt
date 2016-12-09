<?php

//HTML
require("messages.php");

// MUUTUJAD

$form = true;
$title = "";
$book_id = "";
$receiver_name = "";



?>


<?php 
if(!isset($_SESSION["userId"])){
	header("Location:login.php");
}

//kui saan aadressirealt saaja id, siis vormi eeltäidetud kasutajanimi
if(isset($_GET["contact"])){
	$receiver_id = $Helper->cleanInput($_GET["contact"]);
	$receiver_name = $User->getUsername($receiver_id);
}
//kui saan aadressirealt raamatu id, siis vormi eeltäidetud pealkiri raamatu pealkirjaga
if(isset($_GET["book"])){
	$book_id = $Helper->cleanInput($_GET["book"]);
	$title = $Book->getSingle($book_id)->title;
}
if(isset($_POST["title"])){
	if(!empty($_POST["title"]) AND !empty($_POST["msg"]) AND !empty($_POST["receiver_name"])){
		$form = false;
		$message = "Sõnum saadetud";
		$sender = $Helper->cleanInput($_SESSION["userId"]);
		$receiver_name = $Helper->cleanInput($_POST["receiver_name"]);  //vaja id-ks
		$receiver_id = $User->getUserId ($receiver_name);  //$book->user  antud raamatu sisestaja
		$title = $Helper->cleanInput($_POST["title"]);
		$msg = $Helper->cleanInput($_POST["msg"]);
		$Messages->newMessage($sender, $receiver_id, $title, $msg);
	}
	
}


?>
<table style="width:100%;">
	<tr >
	    <td style="text-align: center;"><?=$message?><br><br></td>
	</tr>
</table>
<?php
if($form){ ?>


<form method="post">
<table>
	<tr>
		<td style="width: 300px;"></td>
		<td style="text-align: left; height: 100px;">
			<div>
			
					<label for="title">Pealkiri</label><input type="text" value="<?php echo $title; ?>" name="title" /><br />
					
					<label for="receiver_name">Saaja</label><input type="text" value="<?php echo $receiver_name; ?>" name="receiver_name" /><br />
					
					<label for="msg">Sõnum</label><textarea cols="40" rows="5" name="msg"></textarea><br />
					<input type="submit"  value="Saada" />
				
			</div>
		</td>
	</tr>
<?php 
;}
?>
</table>
</form>
<?php require("../footer.php");?>
