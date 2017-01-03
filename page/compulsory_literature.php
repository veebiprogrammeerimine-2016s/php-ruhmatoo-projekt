<?php

    require("functions.php");
    require("../class/Lesson.class.php");
    require("../class/Reading.class.php");

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


    $Lesson = new Lesson($mysqli);
    $allLessons = $Lesson->get($_SESSION["userEmail"]);
    $Reading = new Reading($mysqli);

    if(isset($_POST["sendReading"])){

        if ( isset($_POST["bookname"]) &&
            isset($_POST["bookauthor"]) &&
            isset($_POST["bookclass"]) &&
            !empty($_POST["bookname"]) &&
            !empty($_POST["bookauthor"]) &&
            !empty($_POST["bookclass"])) {

                $Reading->save(
                    $Helper->cleanInput($_POST["bookname"]),
                    $Helper->cleanInput($_POST["bookauthor"]),
                    $Helper->cleanInput($_POST["bookclass"]),
                    $Helper->cleanInput($_SESSION["userEmail"])
                );
                header("Location: compulsory_literature.php");
                exit();

            }


    }
?>


<?php require("header.php");?>

<section class="background-gray-lightest">
    <div class="container">
        <div class="breadcrumbs">
            <ul class="breadcrumb">
                <li><a href="data.php">Kodu</a></li>
                <li>Kohustuslik kirjandus</li>
            </ul>
        </div>
        <form class="form-horizontal" method="post" id="readingform" name="readingform">
            <fieldset>

                <!-- Form Name -->
                <legend>Kohustuslik kirjandus</legend>

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="bookname">Raamatu nimi(*)</label>
                    <div class="col-md-4">
                        <input id="bookname" name="bookname" type="text" placeholder="" class="form-control input-md">

                    </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="bookauthor">Autor(*)</label>
                    <div class="col-md-4">
                        <input id="bookauthor" name="bookauthor" type="text" placeholder="" class="form-control input-md">

                    </div>
                </div>

                <!-- Select Basic -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="bookclass">Õppeaine(*)</label>
                    <div class="col-md-4">
                        <select id="bookclass" name="bookclass" class="form-control">
                            <?php
                            foreach($allLessons as $lesson){
                                $html = "";
                                $html .= "<option value='$lesson->name'>$lesson->name</option>";
                                echo $html;}
                            ?>
                        </select>
                    </div>
                </div>

                <!-- Button -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="singlebutton"></label>
                    <div class="col-md-4">
                        <button class="btn btn-primary" name="sendReading" type="submit">Salvesta</button>
                    </div>
                </div>

            </fieldset>
        </form>

        <script>

            $("#readingform").validate({

                rules: {
                    bookname: {required: true},
                    bookauthor: {required: true}},

                messages:{
                    bookname: {required: "Palun sisestage raamatu nimi."},
                    bookauthor: {required: "Palun sisestage raamatu autor."}}
            });

        </script>
    </div>
</section>

<?php require("footer.php");?>