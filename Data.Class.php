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
					
						for($i=0;$i<count($toode);$i++){
						$stmt->close();
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
								PurchaseID,
								AddedBY
								)
								VALUES (?, ?, ?, ?, ?)
								
								");
								
							$stmt->bind_param("sdiii", $Sisestatavtoode, $Sisestatavhind, $Sisestatavkategooria, $purchaseID, $_SESSION["userId"]);
								
							$stmt->execute();
											
							} 
							
							echo "edukalt sisestatud";
						
						
						
					} else { 
					echo "ei suutnud Ostu ID-d kätte saada";
				
					}				
			} else {
				
				echo "ei saanud sisestada ostu infot";
				
			}
	
		}
		
				function showPurchases() {
				
		
			$stmt = $this->connection->prepare("
			
				SELECT FromShop, Date, Checknumber, ID
				FROM WasteChase_Purchases
				Where AddedBY = ?
				");
			
			$stmt->bind_param("i", $_SESSION["userId"]);
			
			$stmt->bind_result($Shop, $Date, $Check, $PurchaseID);
		
			$stmt->execute();
			
			$table1 = array();
			
			// tsüklit tehakse nii mitu korda, mitu rida sql lausega tuleb.			
			while ($stmt->fetch()) {
				
				$purchase = new StdClass();
				$purchase->shop = $Shop;
				$purchase->shopdate = $Date;
				$purchase->check = $Check;
				$purchase->id = $PurchaseID;
			
					
					array_push($table1, $purchase);
					
			}

			return $table1;
			
		}
	
		
		function showPurchaseContents($id) {
			$stmt = $this->connection->prepare("
			
				SELECT ProductName, ProductPrice, CategoryID
				FROM WasteChase_PurchaseContents
				Where AddedBY = ? AND PurchaseID = $id
				");
			
			$stmt->bind_param("i", $_SESSION["userId"]);
			
			$stmt->bind_result($Product, $Price, $Category);
		
			$stmt->execute();
			
			$table2 = array();
			

			
			while ($stmt->fetch()) {
				
				$purchaseContents = new StdClass();
				$purchaseContents->product = $Product;
				$purchaseContents->price = $Price;
			
					//echo $color."<br>";
					array_push($table2, $purchaseContents);
					
			}
			
			return $table2;
			
			$stmt->close();
		}	
		
		
		function getCategoryName() {

			
				$stmt = $this->connection->prepare("
				
				SELECT  CategoryID
				FROM WasteChase_PurchaseContents
				Where AddedBY = ?
				
				");
				
			$stmt->bind_param("i", $_SESSION["userId"]);
				
				$stmt->bind_result($CategoryID);
				
				$stmt->execute();
				
				$Categories = array();
				
				while ($stmt->fetch()) {
				
				$CategoryTable = new StdClass();
				$CategoryTable->categoryid = $CategoryID;
			
					//echo $color."<br>";
					array_push($Categories, $CategoryTable);
					
			}
				
				$stmt->close();
				
				//var_dump($categories);
				
				foreach($Categories as $ct){
					$stmt = $this->connection->prepare("
				
					SELECT  Category
					FROM WasteChase_Categories
					Where ID = ?
					
					");
				
				$stmt->bind_param("i", $ct->categoryid);
				
				$stmt->bind_result($CategoryName);
				
				$stmt->execute();
				
				$nimed = array();
			
				while ($stmt->fetch()) {
				$Categooriad = new StdClass();
				$Categooriad->categoryname = $CategoryName;
			
					//echo $color."<br>";
					array_push($nimed, $Categooriad);
					
			}
				}
			
			return $nimed;
			
		}
		
}//classi lõpp
?>