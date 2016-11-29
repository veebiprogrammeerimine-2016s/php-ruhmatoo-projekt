<?php
//FUNKTSIOONIDEGA FAILID
require("../functions.php");     
require("../class/User.class.php");     
$User = new User($mysqli); 
require("../class/Coin.class.php");     
$Coin = new Coin($mysqli); 

//funktsioon, mis arvutab kasutaja müdndid kokku
$userCoins = $Coin->getCoins($_SESSION["userId"], $_SESSION["userId"]);



?>

<?php
//HTML
require("../header.php");


?>
<p>Sinu mündid: <?=$userCoins;?></p>
<br>
<p>Sinu vahetused</p>



<?php require("../footer.php");?>