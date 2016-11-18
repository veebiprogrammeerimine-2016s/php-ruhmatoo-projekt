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
<p>raamatud</p>

<?php require("../footer.php");?>