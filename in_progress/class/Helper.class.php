<?php 
class Helper {
		
    
    function cleanInput ($input) {
		
		// "   tere tulemast    "
		$input = trim($input);
		// "tere tulemast"
		
		// "tere \\tulemast"
		$input = stripslashes($input);
		// "tere tulemast"
		
		// "<"
		$input = htmlspecialchars($input);
		// "&lt;"
		
		return $input;
	}
    
} 
?>