<?php

//HTML
require("messages.php");

//MUUTUJAD
$note = "Saadetud kirjad";

?>
<div class="notleft">
<?php 
if(!isset($_SESSION["userId"])){
	header("Location:login.php");
}
//saan kõik kasutaja saadetud kirjad
$outbox = $Messages->allSent($_SESSION["userId"]);

//kutsun funktsiooni, et iga märgitud checkboxiga kiri kustutada
	if(!empty($_POST['to_delete'])) {
		foreach($_POST['to_delete'] as $checked) {
            //echo $checked;
			$Messages->deleteSentMessage($checked, $_SESSION["userId"]);
			header("Location:outbox.php");   //sama lehe värskendus, et kustutatud oleks kustututatud
		}
	}
?>

<td>
	<h4><?=$note?></h4>
	</td>
	</tr>
</table>
<form method="post">
<?php
//kõik kasutaja saadetud kirjad
if(!isset($_GET["id"])){
	$htmlTable = '<table class="table table-bordered table-striped table-hover" style="width:100%;">';
		
		$htmlTable .= '<tr>';
			$htmlTable .= '<th style="text-align: center; color:#999;"><input type="submit" value="Kustuta"></th>';
			$htmlTable .= '<th style="text-align: center; color:#999;">Saaja</th>';
			$htmlTable .= '<th style="text-align: center; color:#999;">Pealkiri</th>';
			$htmlTable .= '<th style="text-align: center; color:#999;">Saadetud</th>';
			$htmlTable .= '<th style="text-align: center; color:#999;">Kätte saanud</th>';
		$htmlTable .= '</tr>';
	
	//terve tabeli rida lingiks: https://www.tutorialsplane.com/bootstrap-make-table-row-clickable/
		//'kustuta' tulbale linki ei taha
		foreach($outbox as $message){
		//reale klikkides saab avada konkreetse kirja, aadressireale message id
				$htmlTable .= '<tr style="cursor:pointer;">';
				//http://stackoverflow.com/questions/4997252/get-post-from-multiple-checkboxes
				//kõik check'itud message_id ühte massiivi to_delete[]
					$htmlTable .= '<td><input type="checkbox" name="to_delete[]" value="'.$message->message_id.'" ></td>';
					$htmlTable .= '<td class="table-row" data-href="outbox.php?id='.$message->message_id.'" style="text-align: center;">'.$User->getUsername($message->receiver_id).'</td>';
					$htmlTable .= '<td class="table-row" data-href="outbox.php?id='.$message->message_id.'" style="text-align: center;">'.$message->title.'</td>';
					$htmlTable .= '<td class="table-row" data-href="outbox.php?id='.$message->message_id.'" style="text-align: center;">'.$message->sent.'</td>';
					if(empty($message->received)){
						$htmlTable .= '<td class="table-row" data-href="outbox.php?id='.$message->message_id.'" style="text-align: center;">Avamata</td>';
					} else {
						$htmlTable .= '<td class="table-row" data-href="outbox.php?id='.$message->message_id.'" class="table-row" style="text-align: center;">'.$message->received.'</td>';
					}
				$htmlTable .= '</tr>';	
		}
	$htmlTable .= '</table>';
	echo $htmlTable;
}
?>
</form>
<?php
//kasutaja avab enda saadetud kirja
if(isset($_GET["id"])){
	$htmlTable = '<table style="width: 100%;">';
	foreach($outbox as $message){
		if($message->message_id == $_GET["id"]){ 
			$htmlTable .= '<tr>';
				$htmlTable .= '<td colspan="2" style="text-align: right;">Kellele: '.$User->getUsername($message->receiver_id).'</td>';
				$htmlTable .= '<td style="text-align: right;">Saadetud: '.$message->sent.'</td>';
				
			$htmlTable .= '</tr>';
			$htmlTable .= '</table>';
			$htmlTable .= '<br><br><br>';
			$htmlTable .= '<table style="width: 50%;">';
				$htmlTable .= '<tr>';
				$htmlTable .= '<td  style="text-align: left;">'.$message->content.'</td>';
			$htmlTable .= '</tr>';
		}	
	}
	$htmlTable .= '</table>';
	echo $htmlTable;
	
}
?>
</div>
<?php require("../footer.php");?>