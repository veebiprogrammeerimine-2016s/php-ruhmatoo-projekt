<?php
class Helper {
	
	private $connection;
	
	function __construct($mysqli){
	
		$this->connection=$mysqli;
	
	}
	
	/*TEISED FUNKTSIOONID*/
	
	function cleanInput($input){
		
		//T�kestame sisestusel pahatahtlike k�skude rakendumist.
		$input=trim($input);
		$input=htmlspecialchars($input);
		$input=stripslashes($input);
		
		return $input;
		
	}
	
	
}?>