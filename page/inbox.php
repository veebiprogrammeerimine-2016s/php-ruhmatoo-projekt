<?php

//HTML
require("messages.php");

//MUUTUJAD
$note = "";

?>

<?php 
if(!isset($_SESSION["userId"])){
	header("Location:login.php");
}
//saan kõik kasutajale saabunud kirjad
$inbox = $Messages->allReceived($_SESSION["userId"]);
?>

<table style="width:100%;">
	<tr >
	    <td style="text-align: center;"><?=$note?><br><br></td>
	</tr>
</table>

<?php
//kasutaja avab kirja, mille message id aadressireal
if(isset($_GET["id"])){
	$htmlTable = '<table style="width: 100%;">';
	foreach($inbox as $message){
		if($message->message_id == $_GET["id"]){ 
			$htmlTable .= '<tr>';
				$htmlTable .= '<td colspan="2" style="text-align: right;">Saatja: '.$User->getUsername($message->sender_id).'</td>';
				$htmlTable .= '<td style="text-align: right;">Saadetud: '.$message->sent.'</td>';
				$htmlTable .= '<td style="text-align: right;"><a href="new_pm.php?contact='.$message->sender_id.'&title='.$message->title.'">Vasta kirjale</a></td>';
			$htmlTable .= '</tr>';
			$htmlTable .= '</table>';
			$htmlTable .= '<br><br><br>';
			$htmlTable .= '<table style="width: 50%;">';
				$htmlTable .= '<tr>';
				$htmlTable .= '<td style="text-align: left;">'.$message->content.'</td>';
			$htmlTable .= '</tr>';
		}	
	}
	$htmlTable .= '</table>';
	echo $htmlTable;
	
	//kutsun funktsiooni, et tabelis 'received' alla läheks avamise aeg
	$Messages->messageOpened($Helper->cleanInput($_GET["id"]), $_SESSION["userId"]);
	
} 
//algne vaade tabelina, kus kõik saabunud kirjad
if(!isset($_GET["id"])){
	$htmlTable = '<table class="table table-bordered table-striped table-hover" style="width:100%;">';
		
		$htmlTable .= '<tr>';
			$htmlTable .= '<th style="text-align: center; color:#999;">Saatja</th>';
			$htmlTable .= '<th style="text-align: center; color:#999;">Pealkiri</th>';
			$htmlTable .= '<th style="text-align: center; color:#999;">Saadetud</th>';
		$htmlTable .= '</tr>';
	
	//terve tabeli rida lingiks: https://www.tutorialsplane.com/bootstrap-make-table-row-clickable/
		
		foreach($inbox as $message){
			if(empty($message->received)){  //reale klikkides saab avada konkreetse kirja, aadressireale message id
				$htmlTable .= '<tr style="cursor:pointer;" class="table-row" data-href="inbox.php?id='.$message->message_id.'">';
					$htmlTable .= '<td style="text-align: center; font-weight: bold;">'.$User->getUsername($message->sender_id).'</td>';
					$htmlTable .= '<td style="text-align: center; font-weight: bold;">'.$message->title.'</td>';
					$htmlTable .= '<td style="text-align: center; font-weight: bold;">'.$message->sent.'</td>';
				$htmlTable .= '</tr>';
			} else {
				$htmlTable .= '<tr>';
					$htmlTable .= '<td style="text-align: center;">'.$User->getUsername($message->sender_id).'</td>';
					$htmlTable .= '<td style="text-align: center;">'.$message->title.'</td>';
					$htmlTable .= '<td style="text-align: center;">'.$message->sent.'</td>';
				$htmlTable .= '</tr>';	
			}
		}
	$htmlTable .= '</table>';
	echo $htmlTable;
}
?>



<?php require("../footer.php");?>