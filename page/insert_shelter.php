<?php
   require("../functions.php");
   
   //kas on sisseloginud, kui ei ole siis
   //suunata login lehele
   if (!isset ($_SESSION["userId"])) {
	   
	   //header("Location: login.php");
	   
	}
   
   //kas ?loguout on aadressireal
   if (isset($_GET["logout"])) {
	   
	   session_destroy();
	   
	   header("Location: login.php");
	   exit();
	   
   }  
   $informationError="";
   
   if ( isset($_POST["name"]) &&
	     isset($_POST["county"]) &&
		 isset($_POST["city"]) &&
		 !empty($_POST["name"]) &&
		 !empty($_POST["county"]) &&
		 !empty($_POST["city"])		 ) {
			
		  
		$type = cleanInput($_POST["name"]);
        $name = cleanInput($_POST["county"]);
        $age = cleanInput($_POST["city"]);
		
		$Shelter->save($_POST["name"], $_POST["county"], $_POST["city"]);
	}
	
	 if (empty($_POST["name"]) &&
		empty($_POST["county"]) &&
		empty($_POST["city"]))
{
			 $informationError = "Täita tuleb kõik väljad!";
			 
		}

?>

<html>
<body style='background-color:Silver'>
    <head>
	<?php require("../header.php"); ?>
        <h1>Varjupaiga registreerimine</h1>
	</head>	
        <body>
            <h3>Andmed</h3>
            <form method="POST">
			
	            <label>Varjupaiga nimi</label><br>
                <div class="form-group, col-xs-2">
					<input class="form-control" name="name" type="text">
				</div>
	            <br><br>
	
	            <label>Maakond</label><br>
                <div class="form-group, col-xs-2">
					<input class="form-control" name="county" type="text">
				</div>
	            <br><br>
				
				<label>Linn</label><br>
                <div class="form-group, col-xs-2">
					<input class="form-control" name="city" type="text">
				</div>
	            <br><br>
	
				<input class="btn btn-success btn-sm hidden-xs" type="submit" value="Salvesta"> <?php echo $informationError;?>	
				<br><br>
                </form>
		</body>		
</html>		

<br><br>
<?php require("../footer.php"); ?>