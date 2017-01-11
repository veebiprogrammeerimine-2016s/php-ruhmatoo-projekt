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
		
				function showPurchases() {
				 
		
			$stmt = $this->connection->prepare("
			
				SELECT FromShop, Date, Checknumber
				FROM WasteChase_Purchases
				Where AddedBY = ?
				");
			
			$stmt->bind_param("i", $_SESSION["userID"]);
			
			$stmt->bind_result($Shop, $Date, $Check);
		
			$stmt->execute();
			
			$table1 = array();
			
			// tsüklit tehakse nii mitu korda, mitu rida sql lausega tuleb.			
			while ($stmt->fetch()) {
				
				$purchase = new StdClass();
				$purchase->shop = $Shop;
				$purchase->shopdate = $Date;
				$purchase->check = $Check;
			
					//echo $color."<br>";
					array_push($table1, $purchase);
					
			}

			return $table1;
			
		}
	
		
		function showPurchaseContents() {
			$stmt = $this->connection->prepare("
			
				SELECT ProductName, ProductPrice, CategoryID
				FROM WasteChase_PurchaseContents
				Where AddedBY = ?
				");
			
			$stmt->bind_param("i", $_SESSION["userID"]);
			
			$stmt->bind_result($Product, $Price, $Category);
		
			$stmt->execute();
			
			$table2 = array();
			
			$Categories = array();
			
			while ($stmt->fetch()) {
				
				$purchaseContents = new StdClass();
				$CategoryTable = new StdClass();
				$purchaseContents->product = $Product;
				$purchaseContents->price = $Price;
				$CategoryTable->id = $Category;
			
					//echo $color."<br>";
					array_push($table2, $purchaseContents);
					
			}
			
			return $table2;
			
			$stmt->close();
			
		
		

			for($i=0;$i<count($CategoryTable);$i++){
				$stmt = $this->connection->prepare("
				
				Select ID, Category
				FROM WasteChase_Categories
				Where ID = ?
				
				");
				
				$stmt->bind_param("i", $_SESSION["userID"]);
				
				$stmt->bind_result($CategoryName);
				
				$stmt->execute();
				
			}
			while ($stmt->fetch()) {
				
				$CategoryTable->categoryname = $CategoryName;
			
					//echo $color."<br>";
					array_push($Categories, $CategoryTable);
					
			}
			
			return $Categories;
			
		}
		
}//classi lõpp
?>