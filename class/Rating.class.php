<?php
class Rating {
	
	private $connection;
	
	//funktsioon k�ivitatakse siis kui on 'new User(see j�uab siia)'
	function __construct($mysqli){
		//'this' viitab sellele klassile ja klassi muutujale
		$this->connection=$mysqli;
	}

	

}
?>