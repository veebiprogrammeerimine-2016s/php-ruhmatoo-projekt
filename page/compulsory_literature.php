<?php
require("header.php");

if(isset($_GET["delete"])){
    if($_GET["delete"] == "all"){
        $Reading->deleteAll();
        header("Location: compulsory_literature.php");
        exit();
    }}


if(isset($_GET["deleted"])){

    $Reading->deleteSingle($Helper->cleanInput($_GET["deleted"]));
    header("Location: compulsory_literature.php");
}


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

<?php

if(!empty($allReading)) {
    $html = "";
    $html .= "<!DOCTYPE html>";
    $html .= "<html>";
    $html .= "<head>";
    $html .= "<meta charset='UTF-8'>";
    $html .= "<title>Responsive Table</title>";
    $html .= "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
            $html .= "<link rel='stylesheet' href='../style_script/css/table.css'>";
    $html .= "<link rel='stylesheet' href='../style_script/css/tablesaw.css'>";
            $html .= "<script src='../style_script/js/tablesaw.jquery.js'></script>";
            $html .= "<script src='../style_script/js/tablesaw-init.js'></script>";
    $html .= "</head>";
    $html .= "<body>";
    $html .= "<div id='page-wrap'>";


    $html .= "<table allign='center' class='tablesaw tablesaw-stack striped-table-hover' data-tablesaw-mode='stack'>";
    $html .= "<thead>";
    $html .= "<tr>";
    $html .= "<th>Nimi</th>";
    $html .= "<th>Autor</th>";
    $html .= "<th>Õppeaine</th>";
    $html .= "<th><a href='?delete=all'>Kustuta kõik</a></th>";
    $html .= "</tr>";
    $html .= "</thead>";
    $html .= "<tbody>";

    foreach ($allReading as $reading) {

        $html .= "<tr>";
        $html .= "<td>$reading->name</td>";
        $html .= "<td>$reading->author</td>";
        $html .= "<td>$reading->class</td>";
        $html .= "<td><a href='?deleted=$reading->id'>Kustuta</a></td>";
        $html .= "</tr>";
    }

    $html .= "</tbody>";
    $html .= "</table>";


    $html .= "</div>";
    $html .= "<br><br>";
    $html .= "</body>";
    $html .= "</html>";
    echo $html;
}
?>


<?php require("footer.php");?>