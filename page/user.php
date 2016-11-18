<?php
//FUNKTSIOONIDEGA FAILID
require("../functions.php");     
require("../class/User.class.php");     
$User = new User($mysqli);    
 


?>

<?php
//HTML
require("../header.php");


?>
<p>ülevaade ostud/müügid/mündid/tehingute staatus</p>

<?php require("../footer.php");?>