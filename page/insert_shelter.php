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
<style>
input[type=text], select {
    width: 30%;
    padding: 8px 16px;
    margin: 4px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}
input[type=int], select {
    width: 30%;
    padding: 8px 16px;
    margin: 4px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

input[type=submit] {
    width: 30%;
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

input[type=submit]:hover {
    background-color: #45a049;
}

div {
    border-radius: 5px;
    background-color: #f2f2f2;
    padding: 20px;
}
</style>
<body style='background-color:Silver'>
    <head>
	<?php require("../header.php"); ?>
        <h1>Varjupaiga registreerimine</h1>
	</head>	
        <body>
            <h3>Andmed</h3>
            <form method="POST">
			
	            <label>Varjupaiga nimi</label><br>
	            <input name="name" type="text" >
	            <br><br>
	
	            <label>Maakond</label><br>
	            <input name="county" type="text" >
	            <br><br>
				
				<label>Linn</label><br>
	            <input name="city" type="text" >
	            <br><br>
	
	
	            <input type="submit" value="Salvesta">
				<br><br>
                </form>
		</body>		
</html>		

<br><br>
<?php require("../footer.php"); ?>