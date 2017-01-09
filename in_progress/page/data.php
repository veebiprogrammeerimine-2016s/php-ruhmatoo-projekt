<?php 
	// et saada ligi sessioonile
	require("../functions.php");
	
    require("../class/Helper.class.php");
	$Helper = new Helper();
	
	require("../class/Note.class.php");
	$Note = new Note($mysqli);
	
	//ei ole sisseloginud, suunan login lehele
	/*if(!isset ($_SESSION["userId"])) {
		header("Location: login.php");
		exit();
	}*/
	
	//kas kasutaja tahab välja logida
	// kas aadressireal on logout olemas
	if (isset($_GET["logout"])) {
		
		session_destroy();
		
		header("Location: login.php");
		exit();
	}
	
	if (	isset($_POST["paid_warranty"]) &&
			isset($_POST["serialnumber"]) &&
			isset($_POST["device"]) &&
			isset($_POST["manufacturer"]) &&
			isset($_POST["model"]) &&
			isset($_POST["date_of_purchase"]) &&
			isset($_POST["first_lastname"]) &&
			isset($_POST["country"]) &&
			isset($_POST["city"]) &&
			isset($_POST["address"]) &&
			isset($_POST["postcode"]) &&
			isset($_POST["email"]) &&
			isset($_POST["number"]) &&
			isset($_POST["problem"]) &&
			isset($_POST["add_info"]) &&
				
			!empty($_POST["paid_warranty"]) &&
			!empty($_POST["serialnumber"]) &&
			!empty($_POST["device"]) &&
			!empty($_POST["manufacturer"]) &&
			!empty($_POST["model"]) &&
			!empty($_POST["date_of_purchase"]) &&
			!empty($_POST["first_lastname"]) &&
			!empty($_POST["country"]) &&
			!empty($_POST["city"]) &&
			!empty($_POST["address"]) &&
			!empty($_POST["postcode"]) &&
			!empty($_POST["email"]) &&
			!empty($_POST["number"]) &&
			!empty($_POST["problem"]) &&
			!empty($_POST["add_info"])
	
	) {
		$paid_warranty = $Helper->cleanInput($_POST["paid_warranty"]);
		$serialnumber = $Helper->cleanInput($_POST["serialnumber"]);
		$device = $Helper->cleanInput($_POST["device"]);
		$manufacturer = $Helper->cleanInput($_POST["manufacturer"]);
		$model = $Helper->cleanInput($_POST["model"]);
		$date_of_purchase = $Helper->cleanInput($_POST["date_of_purchase"]);
		$first_lastname = $Helper->cleanInput($_POST["first_lastname"]);
		$country = $Helper->cleanInput($_POST["country"]);
		$city = $Helper->cleanInput($_POST["city"]);
		$address = $Helper->cleanInput($_POST["address"]);
		$postcode = $Helper->cleanInput($_POST["postcode"]);
		$email = $Helper->cleanInput($_POST["email"]);
		$number = $Helper->cleanInput($_POST["number"]);
		$problem = $Helper->cleanInput($_POST["problem"]);
		$add_info = $Helper->cleanInput($_POST["add_info"]);
		$Note->saveNote($paid_warranty, $serialnumber, $device, $manufacturer, $model, $date_of_purchase, $first_lastname, $country, $city, $address, $postcode, $email, $number, $problem, $add_info);

		}
		
	/*$firstnameError = "";
	$firstname = "";
	
	//kas on üldse olemas
	if (isset ($_POST["firstname"])) {
		
		// oli olemas, ehk keegi vajutas nuppu
		// kas oli tühi
		if (empty ($_POST["firstname"])) {
			
			//oli tõesti tühi
			$firstnameError = "Enter your name!";
			
		} else {
				
			// kõik korras, nimi ei ole tühi ja on olemas
			$firstname = $_POST["firstname"];
		}
		
	}	
	
	$lastnameError = "";
	$lastname = "";
	
	if (isset ($_POST["lastname"])) {
		
		if (empty ($_POST["lastname"])) {
			
			$lastnameError = "Enter your lastname!";
			
		} else {
				
			$lastname = $_POST["lastname"];
		}
		
	}	
	
	$serialnumberError = "";
	$serialnumber = "";
	
	if (isset ($_POST["serialnumber"])) {
		
		if (empty ($_POST["serialnumber"])) {
			
				$serialnumberError = "Enter the serialnumber!";
			
		} else {
				
			$serialnumber = $_POST["serialnumber"];
		}
		
	}	
	*/
	
	$q = "";
	
	// otsisõna aadressirealt
	if(isset($_GET["q"])){
		$q = $Helper->cleanInput($_GET["q"]);
	}
	
	//vaikimisi
	$sort = "id";
	$order = "ASC";
	
	if(isset($_GET["sort"]) && isset($_GET["order"])){
		$sort = $_GET["sort"];
		$order = $_GET["order"];
	}
	
	
	$notes = $Note->getAllNotes($q, $sort, $order); 
	
	//echo "<pre>";
	//var_dump($notes);
	//echo "</pre>";
	
?>
<?php require("../header.php"); ?>

<div class="container">
	<div class="row">
		<div class="col-sm-4 col-md-3">
		
	<h1>Create ticket</h1>
	<p>
		Welcome, <a href="user.php"><?=$_SESSION["userEmail"];?></a>!
		<a href="?logout=1">Log out</a>
	</p>
	<h2>Device information</h2>

	<form method="POST">
			<div class ="for-group">
			<label><b>Paid/warranty</b></label>
			<select class ="form-control" name="notebook">
				<option value="warranty">Warranty</option>
				<option value="paid">Paid</option>
			</select>
			
			<br>
			
			<label><b>Serialnumber</b></label>
			<div class="form-group">
			<input class="form-control" name="serialnumber" type="text">
			
			<br>
			
			<div class="form-group">
			<label><b>Device<b></label>
			<input class="form-control" name="device" type="text" >
			
			<br>
			
			<label><b>Manufacturer</b></label>
			
			<br>
			<div class="form-group">
			
			<select class ="form-control" name="notebook">
				<option value="asus">Asus</option>
				<option value="dell">Dell</option>
				<option value="lenovo">Lenovo</option>
			</select>
			
			<br>
			
			<div class="form-group">
			<label><b>Model<b></label>
			<input class="form-control" name="model" type="text">
			
			<br>
			
			<div class="form-group">
			<label><b>Date of purchase<b></label>
			<input class="form-control" name="date_of_purchase" type="date">
					

	</form>
						</div>
					</div>	
				</div>
			</div>	
		</div>
	</div>
</div>


<div class="container">
	<div class="row">
	
		<div class="col-sm-4 col-md-3">
	
			<h2>Contacts</h2>
			<p style="color:red;"></p>
			<form method="POST">
				
			<label>First- and lastname</label><br>
				
			<div class="form-group">
				<input class="form-control" name="first_lastname" type="text">
			</div>
				
			<br>
				
			<label>Country</label><br>
				
			<div class="form-group">
				<input class="form-control" name="country" type="text">
			</div>
				
			<br>
				
			<label>City</label>
			<div class="form-group">
				<input class="form-control" name="city" type="text">
			</div>
			
			<label>Address</label>
			<div class="form-group">
				<input class="form-control" name="address" type="text">
			</div>
			
			<label>Postcode</label>
			<div class="form-group">	
				<input class="form-control" name="postcode" type="text">
			</div>
			
			<label>E-mail</label>
			<div class="form-group">	
				<input class="form-control" name="email" type="text">
			</div>
			
			<label>Phone number</label>
			<div class="form-group">	
				<input class="form-control" name="number" type="text">
			</div>
			
			</form>
				</div>
			<div class="col-sm-4 col-md-3 col-sm-offset-4 col-md-offset-3"> 
		</div>	
	</div>		
</div>	

<div class="container">
	<div class="row">
	
		<div class="col-sm-4 col-md-3">
	
			<h2>Repair</h2>
			<p style="color:red;"></p>
			<form method="POST">
				
			<label>Problem description:</label>
			
			<div class="form-group">
			<textarea class="form-control" name="comment" rows="5" cols="40"> </textarea>
			</div>
			
			<br>
			
			<label>Additional information</label>
			
			<div class="form-group">
			<textarea class="form-control" name="comment" rows="5" cols="40"> </textarea>
			</div>
				
			</form>
		</div>
		<input class="btn btn-primary btn-sm hidden-xs" type="submit" value="Register">
		<input class="btn btn-primary btn-sm btn-block visible-xs-block" type="submit" value="Register">
	 <div class="col-sm-4 col-md-3 col-sm-offset-4 col-md-offset-3"></div>
	 
					 
   </div>
</div>

				
<!--
<div class="container">
	<div class="row">
		<div class="col-sm-3 col-md-4">
		<h2>Search</h2>
		<form>
			<div class="form-group">
			<input class="form-control" type="search" name="q" value="<?=$q;?>">
			<br>
			<input class="btn btn-success btn-sm hidden-xs" type="submit" value="Search">
			<input class="btn btn-success btn-sm btn-block visible-xs-block" type="submit" value="Search">
			
					</form>
				</div>
				<div class="col-sm-4 col-md-3 col-sm-offset-4 col-md-offset-3">
			</div>
		</div>
	</div>
</div>
-->
<?php 
	//iga liikme kohta massiivis
	/*foreach ($notes as $n) {
		
		$style = "width:100px; 
				  float:left;
				  min-height:100px; 
				  border: 1px solid gray;
				  background-color: ".$n->noteColor.";";
		
		echo "<p style='  ".$style."  '>".$n->note."</p>";
	}*/
?>


<!--<h2 style="clear:both;">Information</h2>
	<div class="col-sm-4 col-md-3">
</div>
		
<?php 
	$html = "<table class='table'>";
		
		$html .= "<tr>";
			
		
			$orderId = "ASC";
			
			if (isset($_GET["order"]) && 
				$_GET["order"] == "ASC" && 
				$_GET["sort"] == "id" ){
				
				$orderId = "DESC";
			}
		
			$html .= "<th>
			
						<a href='?q=".$q."&sort=id&order=".$orderId."'>
							id
						</a>
					</th>";
			
				
		$html .= "</tr>";
			$html .= "<th>id";
			$html .= "<th>Firstname";
			$html .= "<th>Lastname";
			$html .= "<th>Notebook";
			$html .= "<th>Serialnumber";
			$html .= "<th>Priority";
			$html .= "<th>Comment";
	foreach ($notes as $note) {
		$html .= "<tr>";
			$html .= "<td>".$note->id."</td>";
			$html .= "<td>".$note->firstname."</td>";
			$html .= "<td>".$note->lastname."</td>";
			$html .= "<td>".$note->notebook."</td>";
			$html .= "<td>".$note->serialnumber."</td>";
			$html .= "<td>".$note->priority."</td>";
			$html .= "<td>".$note->comment."</td>";
			$html .= "<td><a href='edit.php?id=".$note->id."'> <span class='glyphicon glyphicon-pencil'><span></a></td>";
		$html .= "</tr>";
	}
	
	$html .= "</table>";
	
	echo $html;
?>

-->
<?php require("../footer.php"); ?>