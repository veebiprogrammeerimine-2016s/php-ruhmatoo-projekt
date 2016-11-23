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
   
?>
<html>
<style>
.button {
    background-color: #008CBA;
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 30px;
    margin: 4px 2px;
    cursor: pointer;
}
</style>
<body style='background-color:Silver'>
    <head>
	<?php require("../header.php"); ?>
	Tere tulemast <a href="user.php"><?=$_SESSION["userEmail"];?>!</a>
	<a href="?logout=1">Logi välja</a>
</p>
	</head>	
        <body>
		<div class="row">
		<div class="col-sm-2"></div>
		<div class="col-sm-3">
		<a href="animals.php" class="button">Otsi looma</a>
		</div>
		<div class="col-sm-2"></div>
		<div class="col-sm-3">
		<a href="insert_animal.php" class="button">Registreeri loom</a>
		</div>
		</div>
            
                </form>
		</body>		
</html>		

<br><br>
<?php require("../footer.php"); ?>
