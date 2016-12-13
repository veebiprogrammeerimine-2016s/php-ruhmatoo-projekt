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


?>

<?php
//HTML
require("../header.php");
?>
<div class="new">
<script type="text/javascript">
$(document).ready(function($) {
    $(".table-row").click(function() {
        window.document.location = $(this).data("href");
    });
});
</script>
<br>

<table style="width: 80%;">
	<tr>
		<td style="vertical-align: center; height: 100px;">
			<ul>
				<li><a href="new_pm.php">Saada kiri</li></a>
			
				<li><a href="inbox.php">Saabunud kirjad</li></a>

				<li><a href="outbox.php">Saadetud kirjad</li></a>
			</ul>
		</td>
	
