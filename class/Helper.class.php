<?php
class Helper {
	
	private $connection;
	
	//funktsioon käivitatakse siis kui on 'new User(see jõuab siia)'
	function __construct($mysqli){
		//'this' viitab sellele klassile ja klassi muutujale
		$this->connection=$mysqli;
	}

	function cleanInput($input) {
	
		return htmlspecialchars(stripslashes(trim($input)));
		
	}

}
?>