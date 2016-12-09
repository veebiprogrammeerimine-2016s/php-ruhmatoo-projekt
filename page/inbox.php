<?php

//HTML
require("messages.php");

//MUUTUJAD
$note = "Saabunud kirjad";

?>

<?php 
if(!isset($_SESSION["userId"])){
	header("Location:login.php");
}

?>

<table style="width:100%;">
	<tr >
	    <td style="text-align: center;"><?=$note?><br><br></td>
	</tr>
</table>



<?php require("../footer.php");?>