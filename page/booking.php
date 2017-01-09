<?php
   require("../functions.php");
   
   
   //kas on sisseloginud, kui ei ole siis
   //suunata login lehele
   if (!isset ($_SESSION["userId"])) {
	   
	   header("Location: login.php");
	   
	}
   
   //kas ?loguout on aadressireal
   if (isset($_GET["logout"])) {
	   
	   session_destroy();
	   
	   header("Location: login.php");
	   exit();
	   
   }  
 
   
   if ( isset($_POST["return"]) &&
	    !empty($_POST["return"])) {
	
		 
		$Booking->save($_GET["id"], $_POST["return"]);
		$Booking->book($_GET["id"]);
		}
	
		$animal = $Animal->getSingle($_GET["id"]);
		$name = $animal->name;
		$type = $animal->type;
?>

<html>
	<body style='background-color:Silver'>
		<head>
			<?php require("../header.php"); ?>
			<br>
			<a href="animals.php">Tagasi kuulutusele</a>
			
			<h1>Broneerimine</h1>
			
		</head>
			 <body>
				<h3>Kodulooma rentimisel tuleb järgida teatud reegleid:</h3>
				<h4>*Ära vigasta looma!</h4>
				<h4>*Järgi loomade varjupaigast saadud juhiseid!</h4>
				<h4>*Tagasta loom õigeaegselt!</h4>
				
				
				
				<form method="POST">
					<label>Tagastustähtaeg</label><br>
					<input name="return" type="date" >
					<br><br>
					<p style="color:#FF0000";>Oled sa kindel et soovid rentida looma nimega <?php echo $name; ?> liigist <?php echo $type; ?>?</p>
					<input class="btn btn-success btn-sm hidden-xs" type="submit" value="Jah ja nõustun reeglitega!">
					<br><br>
					
				</form>	
				
			</body>
</html>
<br><br>
<?php require("../footer.php"); ?>