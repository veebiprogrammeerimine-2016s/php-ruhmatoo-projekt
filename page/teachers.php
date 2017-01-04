<?php



require("header.php");


if(isset($_POST["sendTeacher"])){

    if(
        isset($_POST["teacher"]) &&
        isset($_POST["roomnumber"]) &&
        isset($_POST["email"]) &&
        isset($_POST["material"]) &&
        !empty($_POST["teacher"]) &&
        !empty($_POST["roomnumber"]) &&
        !empty($_POST["email"])){

        $Teacher->save(
            $Helper->cleanInput($_POST["teacher"]),
            $Helper->cleanInput($_POST["roomnumber"]),
            $Helper->cleanInput($_POST["material"]),
            $Helper->cleanInput($_POST["email"]),
            $Helper->cleanInput($_SESSION["userEmail"])
        );
        header("Location: teachers.php");
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
        header("Location: teachers.php");
        exit();
    }
}


?>
<section class="background-gray-lightest">
    <div class="container">
        <div class="breadcrumbs">
            <ul class="breadcrumb">
                <li><a href="data.php">Kodu</a></li>
                <li>Õpetajad</li>
            </ul>
        </div>
        <form class="form-horizontal" method="post" id="teacherform" name="teacherform">
            <fieldset>

                <!-- Form Name -->
                <legend>Õpetajad</legend>

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="teacher">Nimi(*)</label>
                    <div class="col-md-4">
                        <input id="teacher" name="teacher" type="text" class="form-control input-md" >
                    </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="roomnumber">Ruuminumber(*)</label>
                    <div class="col-md-4">
                        <input id="roomnumber" name="roomnumber" placeholder="T302" type="text" class="form-control input-md" >

                    </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="email">Email(*)</label>
                    <div class="col-md-4">
                        <input id="email" name="email" type="text" placeholder="eesnimi.perekonnanimi@tlu.ee" class="form-control input-md" >

                    </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="material">Kodulehe aadress</label>
                    <div class="col-md-4">
                        <input id="material" name="material" value="" placeholder="http(s)://www.mingisait.tlu.ee" type="text" class="form-control input-md">
                    </div>
                </div>

                <!-- Button -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for=""></label>
                    <div class="col-md-4">
                        <button class="btn btn-primary" name="sendTeacher" type="submit">Salvesta</button>
                    </div>
                </div>

            </fieldset>
        </form>

        <script>

            $("#teacherform").validate({

                rules: {
                    teacher: {required: true},
                    roomnumber: {required: true},
                    email: {required: true, email: true},
                    material: {url: true}},

                messages:{
                    teacher: {required: "Palun sisestage õpetaja nimi."},
                    bookauthor: {required: "Palun sisestage õppejõu ametiruum."},
                    email: {required: "Palun sisestage õppejõu email", email: "Palun sisestage korrektne email"},
                    material: {url: "Palun sisestage korrektne http link."}
                }});

        </script>


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

    </div>



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

</section>

<?php

if(!empty($allTeachers)) {
    $html = "";
    $html .= "<!DOCTYPE html>";
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
    $html .= "<th>Nimi</th>";
    $html .= "<th>Klassiruum</th>";
    $html .= "<th>Email</th>";
    $html .= "</tr>";
    $html .= "</thead>";
    $html .= "<tbody>";

    foreach ($allTeachers as $teacher) {

        $html .= "<tr>";
        $html .= "<td>$teacher->name</td>";
        $html .= "<td>$teacher->classroom</td>";
        $html .= "<td>$teacher->email</td>";
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


<?php

if(!empty($allLessons)) {
    $html = "";
    $html .= "<!DOCTYPE html>";
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
    $html .= "<th>Nimi</th>";
    $html .= "<th>Ainekood</th>";
    $html .= "<th>Õpetaja</th>";
    $html .= "</tr>";
    $html .= "</thead>";
    $html .= "<tbody>";

    foreach ($allLessons as $lesson) {

        $html .= "<tr>";
        $html .= "<td>$lesson->name</td>";
        $html .= "<td>$lesson->classcode</td>";
        $html .= "<td>$lesson->teacher</td>";
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

<?php require("footer.php");