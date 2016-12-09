<?php

//FUNKTSIOONIDEGA FAILID
require("../functions.php"); 
    
require("../class/User.class.php");      //peab olema ENNE ojekti loomist
$User = new User($mysqli);               //objekt  
        
require("../class/Book.class.php");      
$Book = new Book($mysqli); 
              
require("../class/Messages.class.php");      
$Messages = new Messages($mysqli);               

//MUUTUJAD
$message = "";

?>

<?php
//HTML
require("../header.php");
?>

<br>

<table style="width: 100%;">
	<tr>
		<td style="vertical-align: top; height: 100px;" onclick="<?=$message = 'Saada sõnum'?>">
			<ul>
				<li><a href="new_pm.php">Saada kiri</li></a>
			
				<li>Saabunud kirjad</li>

				<li>Saadetud kirjad</li>
			</ul>
		</td>
	</tr>
</table>	
<br>