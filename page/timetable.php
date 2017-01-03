<?php

    require("functions.php");

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


<?php require("header.php");?>

<section class="background-gray-lightest">
    <div class="container">
        <div class="breadcrumbs">
            <ul class="breadcrumb">
                <li><a href="data.php">Kodu</a></li>
                <li>Tunniplaan</li>
            </ul>
            <iframe src="https://www.tlu.ee/asio/kalenterit2/index.php?kt=lk&yks&cluokka=IFIFB-1&av=170102170108170103&guest=intranet%2Ftu&lang=est&jagu=4" width="100%" height="900em" frameborder="0" scrolling="no"></iframe>
        </div>




    </div>
</section>

<?php require("footer.php");?>