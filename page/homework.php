<?php

require("header.php");


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


if(isset($_POST["sendClass"])){

    if(
        isset($_POST["classname"]) &&
        isset($_POST["classcode"]) &&
        isset($_POST["classteacher"]) &&
        !empty($_POST["classname"]) &&
        !empty($_POST["classcode"]) &&
        !empty($_POST["classteacher"])){

        $Lesson->save(
            $Helper->cleanInput($_POST["classname"]),
            $Helper->cleanInput($_POST["classcode"]),
            $Helper->cleanInput($_POST["classteacher"]),
            $Helper->cleanInput($_SESSION["userEmail"])
        );
        header("Location: homework.php");
        exit();
    }
}
?>
<script src="sweetalert-master/dist/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="sweetalert-master/dist/sweetalert.css">
<script>swal("You did well to come so far");</script>
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
                    <label class="col-md-4 control-label" for="selectbasic">Klass(*)</label>
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
                            <option value="Tähtis">Tähtis</option>
                            <option value="Mitte-tähtis">Mitte-tähtis</option>
                            <option value="Meh">Meh</option>
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


        <form class="form-horizontal" method="post" id="classform" name="classform">
            <fieldset>

                <!-- Form Name -->
                <legend>Õppeaine</legend>

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="classname">Nimi(*)</label>
                    <div class="col-md-4">
                        <input id="classname" name="classname" type="text" placeholder="Andmebaaside programmeerimine" class="form-control input-md" >

                    </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="classcode">Ainekood(*)</label>
                    <div class="col-md-4">
                        <input id="classcode" name="classcode" placeholder="IFI6013.DT" type="text" class="form-control input-md">
                    </div>
                </div>

                <!-- Select Basic -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="classteacher">Õpetaja(*)</label>
                    <div class="col-md-4">
                        <select id="classteacher" name="classteacher" class="form-control">
                            <?php
                                foreach($allTeachers as $homework){
                                    $html = "";
                                    $html .= "<option value='$homework->name'>$homework->name</option>";
                                    echo $html;}
                            ?>
                        </select>
                    </div>
                </div>



                <!-- Button -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="singlebutton"></label>
                    <div class="col-md-4">
                        <button class="btn btn-primary" name="sendClass" type="submit">Salvesta</button>
                    </div>
                </div>

            </fieldset>
        </form>

        <script>

            $("#classform").validate({

                rules: {
                    classname: {required: true},
                    classcode: {required: true}},

                messages:{
                    classname: {required: "Palun sisestage õppeaine nimi."},
                    classcode: {required: "Palun sisestage ainekood."}
                }});

        </script>

    </div>

    <?php

    if(!empty($allHomework)) {

        $html .= "<html>";
        $html .= "<head>";
        $html .= "<meta charset='UTF-8'>";

        $html .= "<title>Responsive Table</title>";

        $html .= "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";

        $html .= "<link rel='stylesheet' href='../style_script/css/table.css'>";

        $html .= "</head>";

        $html .= "<body>";
        $html .= "<div id='page-wrap'>";


        $html .= "<table allign='center' class='table table striped-table-hover'>";
        $html .= "<thead>";
        $html .= "<tr>";
        $html .= "<th>Kirjeldus</th>";
        $html .= "<th>Aine</th>";
        $html .= "<th>Tähtaeg</th>";
        $html .= "<th>Tüüp</th>";
        $html .= "<th>Prioriteet</th>";
        $html .= "</tr>";
        $html .= "</thead>";
        $html .= "<tbody>";

        foreach ($allHomework as $homework) {

            $html .= "<tr>";
            $html .= "<td>$homework->description</td>";
            $html .= "<td>$homework->class</td>";
            $html .= "<td>$homework->date</td>";
            $html .= "<td>$homework->type</td>";
            $html .= "<td>$homework->priority</td>";
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


</section>



<?php require("footer.php"); ?>
