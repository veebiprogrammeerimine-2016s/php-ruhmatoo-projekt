<?php
Class Data {

		private $connection;
		
			function __construct($mysqli) {
				$this->connection = $mysqli;
			}
	
		function DataAdd($pood, $kuup2ev, $tsekinumber, $kategooria, $toode, $hind) {
					
			$stmt = $this->connection->prepare("INSERT INTO WasteChase_Purchases ( AddedBY, Date, FromShop, Checknumber) VALUE (?, ?, ?, ?) ");
				
			$stmt->bind_param("issi", $_SESSION["userId"], $kuup2ev, $pood, $tsekinumber);
				 
			if($stmt->execute()){
				
				$stmt->close();
				
				$stmt = $this->connection->prepare("
				
					SELECT ID 
					FROM WasteChase_Purchases
					WHERE Checknumber = ? 
					
				");
				
				$stmt->bind_param("i", $tsekinumber);
				
				$stmt->bind_result($purchaseID);
				
				$stmt->execute();
				
					if($stmt->fetch()){
					$stmt->store_result();
					$stmt->close();
						for($i=0;$i<count($toode);$i++){
					 
							$Sisestatavtoode = $toode[$i];
					 
							$Sisestatavhind = str_replace(",",".",$hind[$i]);
						
							$Sisestatavhind = floatval($Sisestatavhind);
						
							$Sisestatavhind = $Sisestatavhind + 0;
							
							$Sisestatavkategooria = $kategooria[$i];
							
							$Sisestatavkategooria = $Sisestatavkategooria + 0;
							
							$stmt = $this->connection->prepare("
							
								INSERT INTO WasteChase_PurchaseContents(
								ProductName,
								ProductPrice,
								CategoryID,
								PurchaseID
								)
								VALUES (?, ?, ?, ?)"
								
								);
								
							$stmt->bind_param("sdii", $Sisestatavtoode, $Sisestatavhind, $Sisestatavkategooria, $purchaseID);
								
							$stmt->execute();
											
							var_dump(count($toode));
							} 
							
							echo "edukalt sisestatud";
						
						

						
					} else { 

					echo "ei suutnud Ostu ID-d kätte saada";
				
					}				

			} else {
				
				echo "ei saanud sisestada ostu infot";
				
			}
	
		}
}
?>