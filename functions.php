<?php



    $database = "if16_Aavister";
    $mysqli = new mysqli( $serverHost, $serverUsername, $serverPassword, $database);

    require("user.class.php");
    $User = new User($mysqli);


?>