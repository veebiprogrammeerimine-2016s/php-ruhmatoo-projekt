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
	<br>
Tere tulemast koduloomade laenutuse lehele <a href="user.php"><?=$_SESSION["userEmail"];?>!</a>
<br>
Siin saate endale valida endale rõõmsa sõbra teatud ajaks!

</p>
</html>		

<br><br>
<?php require("../footer.php"); ?>
