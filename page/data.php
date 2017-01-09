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
<h3>Tere tulemast Koduloom24 lehele <a href="user.php"><?=$_SESSION["userEmail"];?>!</a></h3><br>
<p>Koduloom24 lehekülg aitab leida kõigile sobiva kodulooma ajutiseks omamiseks,</p>
<p>ja mis kõige tähtsam - ajutise kodu nukratele omaniketa koduloomadele Eesti</p>
<p>erinevatest koduloomade varjupaikadest!</p><br>
<p>Vajuta menüüribalt "Otsi kuulutust" ja leia sinagi endale ajutine karvane sõber!</p>
<br>
<br>
<br>
<p>Kõike parimat soovides,</p>
<p>Koduloom24 tiim</p>








</p>
</html>		

<br><br>
<?php require("../footer.php"); ?>
