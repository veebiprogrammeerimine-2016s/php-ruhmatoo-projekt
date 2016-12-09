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
	$htmlTable = '<table style="width:100%;">';
		$htmlTable .= '<tr>';
			$htmlTable .= '<th style="text-align: center; color:#999;">Saatja</th>';
			$htmlTable .= '<th style="text-align: center; color:#999;">Pealkiri</th>';
			$htmlTable .= '<th style="text-align: center; color:#999;">Saadetud</th>';
		$htmlTable .= '</tr>';
		
		foreach($inbox as $message){
			if(empty($message->receive)){
				$htmlTable .= '<tr>';
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

?>



<?php require("../footer.php");?>