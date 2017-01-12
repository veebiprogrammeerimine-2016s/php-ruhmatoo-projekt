<?php 

	function generatePassword($length = 10){
	  $chars = 'abdefhiknrstyzABDEFGHKNQRSTYZ0123456789';
	  $numChars = strlen($chars);
	  $string = "";
	  for ($i = 0; $i < $length; $i++) {
		$string .= substr($chars, rand(1, $numChars) - 1, 1);
	  }
	  return $string;
	}
?>

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
	/*if (isset($_GET["logout"])) {
		
		session_destroy();
		
		header("Location: login.php");
		exit();
	}*/
	$paid_warrantyError = "";
	$paid_warranty = "";
	
	if (isset ($_POST["paid_warranty"])) {
		
				
			$paid_warranty = $_POST["paid_warranty"];
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
	
	$deviceError = "";
	$device = "";
	
	if (isset ($_POST["device"])) {
		
		if (empty ($_POST["device"])) {
			
				$deviceError = "Enter the device!";
			
		} else {
				
			$device = $_POST["device"];
		}
		
	}	
	
	$manufaturerError = "";
	$manufacturer = "";
	
	if (isset ($_POST["manufacturer"])) {
				
			
			
			
			$manufacturer = $_POST["manufacturer"];
		}
		
		
	
	$modelError = "";
	$model = "";
	
	if (isset ($_POST["model"])) {
		
		if (empty ($_POST["model"])) {
			
				$modelError = "Enter the model of device!";
			
		} else {
				
			$model = $_POST["model"];
		}
		
	}
	
	$date_of_purchaseError = "";
	$date_of_purchase = "";
	
	if (isset ($_POST["date_of_purchase"])) {
		
		if (empty ($_POST["date_of_purchase"])) {
			
				$date_of_purchaseError = "Enter the date of purchase!";
			
		} else {
				
			$date_of_purchase = $_POST["date_of_purchase"];
			
		}
		
	}	
	
	
	$first_lastnameError = "";
	$first_lastname = "";
	
	if (isset ($_POST["first_lastname"])) {
		
		if (empty ($_POST["first_lastname"])) {
			
				$first_lastnameError = "Enter your first and last names!";
			
		} else {
				
			$first_lastname = $_POST["first_lastname"];
		}
		
	}
		
	
	$countryError = "";
	$country = "";
	
	if (isset ($_POST["country"])) {
		
		if (empty ($_POST["country"])) {
			
				$countryError = "Enter the country!";
			
		} else {
				
			$country = $_POST["country"];
		}
		
	}
	
	$cityError = "";
	$city = "";
	
	if (isset ($_POST["city"])) {
		
		if (empty ($_POST["city"])) {
			
				$cityError = "Enter the city!";
			
		} else {
				
			$city = $_POST["city"];
		}
		
	}	
	
	$addressError = "";
	$address = "";
	
	if (isset ($_POST["address"])) {
		
		if (empty ($_POST["address"])) {
			
				$addressError = "Enter the address!";
			
		} else {
				
			$address = $_POST["address"];
		}
		
	}	
	
	$numberError = "";
	$number = "";
	
	if (isset ($_POST["number"])) {
		
		if (empty ($_POST["number"])) {
			
				$numberError = "Enter the phonenumber!";
			
		} else {
				
			$number = $_POST["number"];
		}
		
	}
	
	$problemError = "";
	$problem = "";
	
	if (isset ($_POST["problem"])) {
		
		if (empty ($_POST["problem"])) {
			
				$problemError = "Type the problem information!";
			
		} else {
				
			$problem = $_POST["problem"];
		}
		
	}	
	
	$postcode="";
	if (isset ($_POST["postcode"])) {
		$postcode = $_POST["postcode"];
	}
	$email="";
	if (isset ($_POST["email"])) {
		$email = $_POST["email"];
	}
	$add_info="";
	if (isset ($_POST["add_info"])) {
		$add_info = $_POST["add_info"];
	}
	
	$rma = "";
	
	
	if ( $serialnumber!="" && $device!="" && $model!="" && $date_of_purchase!="" && $first_lastname!="" && $country!="" && $city!="" && $address!="" && $number!="" && $problem){
		
		
		$rma = generatePassword();
		$status = "registred";
		
		$Note->saveNote($paid_warranty, $serialnumber, $device, $manufacturer, $model, $date_of_purchase, $first_lastname, $country, $city, $address, $postcode, $email, $number, $problem, $add_info,$rma, $status);
		echo "YOUR CODE IS <h1 style='color:red;'>".$rma."</h1> PLEASE REMEMBER IT, YOU CAN CHECK YOUR ORDER STATUS";
		}
		

	
?>


<div class="container">
<br><br>
		
	<h1>Create ticket</h1>
	<br><br>
	<table>
	
	<tr><td>
	
	<h2>Device information</h2>
	<form method="POST">
			<br>
			<label><b>Paid/warranty</b><br></label>
			<select class ="form-control" name="paid_warranty"> 
				<option value="warranty">Warranty</option>
				<option value="paid">Paid</option>
			</select> 
			
			<br>
			
			<label><b>Serialnumber</b><br></label>
			
			<input class="form-control" name="serialnumber" type="text" value="<?=$serialnumber; ?>"> <?php echo $serialnumberError; ?>
			
			<br>
			
			
			<label><b>Device</b><br></label>
			<input class="form-control" name="device" type="text" value="<?=$device; ?>"> <?php echo $deviceError; ?>
			
			<br>
			
			<label><b>Manufacturer</b></label>
			
			<br>
			
			
			<select class ="form-control" name="manufacturer"> 
				<option value="Asus">Asus</option>
				<option value="Dell">Dell</option>
				<option value="Lenovo">Lenovo</option>
			</select>
			<br>
			
			
			<label><b>Model</b></label>
			<input class="form-control" name="model" type="text" value="<?=$model; ?>"> <?php echo $modelError; ?>			
			<br>
			
			
			<label><b>Date of purchase</b></label>
			<input class="form-control" name="date_of_purchase" type="date" value="<?=$date_of_purchase;?>"><?php echo  $date_of_purchaseError;?>
			
		</td>
		<td>
			<h2>Contacts</h2>
				<br>
			<label>First- and lastname</label><br>
				
			
				<input class="form-control" name="first_lastname" type="text" value="<?=$first_lastname;?>"> <?php echo $first_lastnameError; ?>
			
				
			<br>
				
			<label>Country</label><br>
				
			
				<input class="form-control" name="country" type="text" value="<?=$country;?>"> <?php echo $countryError; ?>
			
				
			<br>
				
			<label>City</label><br>
			
				<input class="form-control" name="city" type="text" value="<?=$city;?>"> <?php echo $cityError; ?>
			
			
			<label>Address</label><br>
			
				<input class="form-control" name="address" type="text" value="<?=$address;?>"> <?php echo $addressError; ?>
			
			
			<label>Postcode</label><br>
				
				<input class="form-control" name="postcode" type="text" value="<?=$postcode;?>">
			
			
			<label>E-mail</label><br>
			
				<input class="form-control" name="email" type="text" value="<?=$email; ?>">
			
			
			<label>Phone number</label><br>
			
				<input class="form-control" name="number" type="text" value="<?=$number;?>"> <?php echo $numberError; ?>
			
		</td>
		<td>
			<h2>Repair</h2>
			<p style="color:red;"></p>
			
				<br>
			<label>Problem description:</label>
			
			
			<textarea class="form-control" name="problem" rows="5" cols="40"><?=$problem;?></textarea>
			<?php echo $problemError; ?>
			
			
			<br>
			
			<label>Additional information</label>
			
			
			<textarea class="form-control" name="add_info" rows="5" cols="40"><?=$add_info;?></textarea>
			
			<input class="btn btn-primary btn-sm hidden-xs" type="submit" value="Register">
			
					
			
				</form>

		</td>	
</tr>
</table>	



<!--<h2 style="clear:both;">Information</h2>
	<div class="col-sm-4 col-md-3">
</div>
		


-->
<?php require("../footer.php"); ?>