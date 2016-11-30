<?php

require("../functions.php");

//Kui ei ole kasutaja ID

if(!isset($_SESSION["userId"])){

    //Suuna sisselogimis lehele
    header("Location: login.php");
    exit();
}

//Kui on log out aadressireal, siis login v'lja
if(isset($_GET["logout"])){

    session_destroy();
    header("Location: login.php");
    exit();
}


?>

<?php require("../header.php"); ?>

<div class="container">

    <h1>Data</h1>
    
    <p>
        Tere tulemast <a href="user.php"><?=$_SESSION["userEmail"];?>!</a>
        <a href="?logout=1">Logi vÃ¤lja</a>
    </p>

</div>
<?php require("../footer.php"); ?>

