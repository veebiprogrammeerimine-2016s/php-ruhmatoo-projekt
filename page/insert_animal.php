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
		 isset($_POST["age"])&&
		 isset($_POST["url"])&&
		 isset($_POST["shelter"]) 	 &&
		 !empty($_POST["type"]) &&
		 !empty($_POST["name"]) &&
		 !empty($_POST["age"])&&
		 !empty($_POST["url"])&&
		 !empty($_POST["shelter"])		 ) {
			
		  
		$type = cleanInput($_POST["type"]);
        $name = cleanInput($_POST["name"]);
        $age = cleanInput($_POST["age"]);
        $url = cleanInput($_POST["url"]);
		$shelter = cleanInput($_POST["shelter"]);
		
		$Animal->save($_POST["type"], $_POST["name"], $_POST["age"], $_POST["url"], $_POST["shelter"]);
	}
	
	 if (empty($_POST["type"]) &&
		empty($_POST["name"]) &&
		empty($_POST["age"])&&
		empty($_POST["url"])&&
		empty($_POST["shelter"]))
{
			 $informationError = "Täita tuleb kõik väljad!";
			 
		}
		
		
		$shelter =$Shelter->getAll();
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
        <h1>Koduloomade registreerimine</h1>
	</head>	
        <body>
            <h3>Andmed</h3>
            <form method="POST">
				<label>Liik</label><br>
	            <select name="type" id="type" name="type">
				<option value="koer">Koer</option>
				<option value="kass">Kass</option>
				<option value="papagoi">Papagoi</option>
				<option value="janes">Janes</option>
				<option value="muu">Muu</option>
				</select>
				</div>
	            <br><br>
	
	            <label>Looma nimi</label><br>
	            <input name="name" type="text" >
	            <br><br>
	
	            <label>Vanus</label><br>
	            <input name="age" type="int" >
	            <br><br>
				
				<label>Pildi url</label><br>
	            <input name="url" type="text" >
	            <br><br>
				
				<label>Varjupaik</label><br>
				<select name="shelter" type="text">
				
				<?php
            
				$listHtml = "";
        	
				foreach($shelter as $x){
        		
        		
        		$listHtml .= "<option value='".$x->name."'>".$x->name."</option>";
        
				}
        	
				echo $listHtml;
            
        ?>
    </select>
	<br>
	
	            <input type="submit" value="Salvesta">
				<br><br>
                </form>
			
				
		</body>		
</html>		



<br><br>
<?php require("../footer.php"); ?>