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
   
   if ( isset($_POST["type"]) &&
	     isset($_POST["name"]) &&
		 isset($_POST["age"]) &&
		 !empty($_POST["type"]) &&
		 !empty($_POST["name"]) &&
		 !empty($_POST["age"])		 ) {
			
		  
		$type = cleanInput($_POST["type"]);
        $name = cleanInput($_POST["name"]);
        $age = cleanInput($_POST["age"]);
		
		$Animal->save($_POST["type"], $_POST["name"], $_POST["age"]);
	}
	
	 if (empty($_POST["type"]) &&
		empty($_POST["name"]) &&
		empty($_POST["age"]))
{
			 $informationError = "Täita tuleb kõik väljad!";
			 
		}

?>

<html>
<body style='background-color:Silver'>
    <head>
	<?php require("../header.php"); ?>
        <h1>Koduloomade registreerimine</h1>
	</head>	
        <body>
            <h3>Andmed</h3>
            <form method="POST">
				<label>Liik</label><br>
	            <select name="type" id="type" name="type">
				<option value="dog">Koer</option>
				<option value="cat">Kass</option>
				<option value="parrot">Papagoi</option>
				<option value="rabbit">Janes</option>
				<option value="other">Muu</option>
				</select>
	            <br><br>
	
	            <label>Looma nimi</label><br>
	            <input name="name" type="text" >
	            <br><br>
	
	            <label>Vanus</label><br>
	            <input name="age" type="int" >
	            <br><br>
	
	
	            <input type="submit" value="Salvesta">
				<br><br>
                </form>
		</body>		
</html>		

<br><br>
<?php require("../footer.php"); ?>