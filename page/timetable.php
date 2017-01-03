<?php

require("header.php");


//Kui ei ole kasutaja ID
if(!isset($_SESSION["userEmail"])){

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

<section class="background-gray-lightest">
    <div class="container">
        <div class="breadcrumbs">
            <ul class="breadcrumb">
                <li><a href="data.php">Kodu</a></li>
                <li>Tunniplaan</li>
            </ul>
        </div>




    </div>
</section>

<?php require("footer.php");?>