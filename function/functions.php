<?php

function cleanInput ($string) {
	$string = trim(stripslashes(htmlspecialchars($string)))
}


?>
