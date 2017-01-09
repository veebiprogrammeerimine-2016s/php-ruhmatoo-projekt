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
			
			<h1>Broneeri</h1>
			
		</head>
			 <body>
				<h3>Rentimine</h3>
				
				<p>Oled sa kindel et soovid rentida looma nimega <?php echo $name; ?> liigist <?php echo $type; ?>?
				</p>
				
				 <form method="POST">
					<label>Tagastustähtaeg</label><br>
					<input name="return" type="date" >
					<br><br>
		
					<input class="btn btn-success btn-sm hidden-xs" type="submit" value="Rendi">
					<br><br>
				</form>	
			</body>
</html>
<br><br>
<?php require("../footer.php"); ?>