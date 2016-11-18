<?php

//FUNKTSIOONIDEGA FAILID
require("../functions.php");     
require("../class/User.class.php");      //peab olema ENNE ojekti loomist
$User = new User($mysqli);               //objekt
?>


<?php
//HTML
require("../header.php");


?>
<p>raamatute lisamiseks</p>

<?php require("../footer.php");?>