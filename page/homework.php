<?php
require("header.php");

if(isset($_GET["delete"])){
    if($_GET["delete"] == "all"){
        $Homework->deleteAll();
        header("Location: homework.php");
        exit();
    }}


if(isset($_GET["deleted"])){

    $Homework->deleteSingle($Helper->cleanInput($_GET["deleted"]));
    header("Location: homework.php");
}


if(isset($_POST["sendHomework"])){

    if(
        isset($_POST["description"]) &&
        isset($_POST["hwlesson"]) &&
        isset($_POST["type"]) &&
        isset($_POST["priority"]) &&
        isset($_POST["date"]) &&
        !empty($_POST["description"]) &&
        !empty($_POST["hwlesson"]) &&
        !empty($_POST["type"]) &&
        !empty($_POST["priority"]) &&
        !empty($_POST["date"])){

        $Homework->save(
            $Helper->cleanInput($_POST["type"]),
            $Helper->cleanInput($_POST["description"]),
            $Helper->cleanInput($_POST["date"]),
            $Helper->cleanInput($_POST["hwlesson"]),
            $Helper->cleanInput($_POST["priority"]),
            $Helper->cleanInput($_SESSION["userEmail"])

        );
        header("Location: homework.php");
        exit();

    }
}

?>
<script src="sweetalert-master/dist/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="sweetalert-master/dist/sweetalert.css">

<section class="background-gray-lightest">

    <div class="container">
        <div class="breadcrumbs">
            <ul class="breadcrumb">
                <li><a href="data.php">Kodu</a></li>
                <li>Kodutööd</li>
            </ul>
        </div>

        <form class="form-horizontal" method="post" id="homeworkform" name="homeworkform">
            <fieldset>

                <!-- Form Name -->
                <legend>Kodutööd</legend>


                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="description">Kirjeldus(*)</label>
                    <div class="col-md-4">
                        <input name="description" id="description" type="text" placeholder="Lisa siia lühike kirjeldus" class="form-control input-md">

                    </div>
                </div>


                <!-- Select Basic -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="selectbasic">Aine(*)</label>
                    <div class="col-md-4">
                        <select name="hwlesson" class="form-control">
                            <?php
                            foreach($allLessons as $lesson){
                                $html = "";
                                $html .= "<option value='$lesson->name'>$lesson->name</option>";
                                echo $html;}
                            ?>
                        </select>
                    </div>
                </div>


                <!-- Select Basic -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="selectbasic">Tüüp(*)</label>
                    <div class="col-md-4">
                        <select name="type" class="form-control">
                            <option value="Kodutöö">Kodutöö</option>
                            <option value="Eksam">Eksam</option>
                            <option value="Essee">Essee</option>
                            <option value="Esitlus">Esitlus</option>
                            <option value="Rühmatöö">Rühmatöö</option>
                            <option value="Kontrolltöö">Kontrolltöö</option>
                        </select>
                    </div>
                </div>


                <!-- Select Basic -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="selectbasic">Prioriteet(*)</label>
                    <div class="col-md-4">
                        <select name="priority" class="form-control">
                            <option value="Väga-tähtis">Väga-tähtis</option>
                            <option value="Üsna-tähtis">Üsna-tähtis</option>
                            <option value="Mitte-tähtis">Mitte-tähtis</option>
                        </select>
                    </div>
                </div>


                <!-- Date -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="date">Tähtaeg(*)</label>
                    <div class="col-md-4">
                        <input class="form-control" name="date" placeholder="DD/MM/YYY" type="text"/>
                    </div>
                </div>


                <!-- Button -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="singlebutton"></label>
                    <div class="col-md-4">
                        <button class="btn btn-primary" name="sendHomework" type="submit">Salvesta</button>
                    </div>
                </div>



                <!-- Include Date Range Picker -->
                    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

                    <script>
                        $(document).ready(function(){
                            var date_input=$('input[name="date"]'); //our date input has the name "date"
                            var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
                            date_input.datepicker({
                                format: 'dd/mm/yyyy',
                                container: container,
                                todayHighlight: true,
                                autoclose: true,
                                startDate: new Date()
                            })
                        })
                    </script>

                    <script>

                        $("#homeworkform").validate({

                            rules: {
                                description: {required: true, minlength: 5},
                                date: {required: true}},

                            messages:{
                                description: {required: "Palun sisesta mingi kirjeldus.", minlength: "Palun sisestage midagi sisukamat."},
                                date: {required: "Palun sisestage tähtaeg."}}
                        });

                    </script>

            </fieldset>
        </form>
</section>

<form method='post'>
<div id='page-wrap'>
    <div class="col-lg-2">
        <div class="input-group">
            <input type="text" name="q" value="<?=$q?>" class="form-control" placeholder="">
            <span class="input-group-btn">
        <button class="btn btn-primary" type="submit">OTSI</button>
      </span>
        </div>
    </div>
</div>
</form><br><br><br>

    <?php

    if(!empty($allHomework)) {
        $html2 = "";
        $html2 .= "<html>";
        $html2 .= "<head>";
        $html2 .= "<meta charset='UTF-8'>";
        $html2 .= "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
        $html2 .= "<link rel='stylesheet' href='../style_script/css/table.css'>";
        $html .= "</head>";
        $html .= "<body>";
        $html .= "<div id='page-wrap'>";

        $html2 .= "<table allign='center' class='table table striped-table-hover'>";
        $html2 .= "<thead>";
        $html2 .= "<tr>";
        $html2 .= "<th>Kirjeldus</th>";
        $html2 .= "<th>Aine</th>";
        $html2 .= "<th>Tähtaeg</th>";
        $html2 .= "<th>Tüüp</th>";
        $html2 .= "<th>Prioriteet</th>";
        $html2 .= "<th><a href='?delete=all'>Kustuta kõik</a></th>";
        $html2 .= "</tr>";
        $html2 .= "</thead>";
        $html2 .= "<tbody>";

        foreach ($allHomework as $homework) {

            $html2 .= "<tr>";
            $html2 .= "<td>$homework->description</td>";
            $html2 .= "<td>$homework->class</td>";
            $html2 .= "<td>$homework->date</td>";
            $html2 .= "<td>$homework->type</td>";
            $html2 .= "<td>$homework->priority</td>";
            $html2 .= "<td><a href='?deleted=$homework->id'>Kustuta</a></td>";
            $html2 .= "</tr>";
        }


        $html2 .= "</tbody>";
        $html2 .= "</table>";


        $html2 .= "</div>";

        $html2 .= "<br><br>";
        $html2 .= "</body>";
        $html2 .= "</html>";
        echo $html2;

    }else{
        echo("<br>");
        echo("<br>");
        echo("<br>");
        echo("<br>");
    }
?>
<br><br><br>
<?php require("footer.php"); ?>



