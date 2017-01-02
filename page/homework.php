<?php

    require("functions.php");
    require("../class/Lesson.class.php");
    require("../class/Teacher.class.php");

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

<?php require("header.php"); ?>


<section class="background-gray-lightest">
    <div class="container">
        <div class="breadcrumbs">
            <ul class="breadcrumb">
                <li><a href="data.php">Kodu</a></li>
                <li>Kodutööd</li>
            </ul>
        </div>



        <h1 class="heading">Kodutööd</h1>

        <form class="form-horizontal" method="post" id="homeworkform">
            <fieldset>

                <!-- Form Name -->
                <legend>Kodutööd</legend>


                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="homeworkDescription">Kirjeldus(*)</label>
                    <div class="col-md-4">
                        <input name="homeworkDescription" id="homeworkDescription" type="text" placeholder="Lisa siia lühike kirjeldus" class="form-control input-md">

                    </div>
                </div>


                <!-- Select Basic -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="selectbasic">Klass(*)</label>
                    <div class="col-md-4">
                        <select name="homeworkClass" class="form-control">
                            <option value="Õppimine kõrgkoolis">Õppimine kõrgkoolis</option>
                            <option value="Veebiprogammeerimine">Veebiprogammeerimine</option>
                            <option value="Diskreetsed struktuurid">Diskreetsed struktuurid</option>
                            <option value="Programmeerimise alused">Programmeerimise alused</option>
                        </select>
                    </div>
                </div>


                <!-- Select Basic -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="selectbasic">Tüüp(*)</label>
                    <div class="col-md-4">
                        <select name="homeworkType" class="form-control">
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
                        <select name="homeworkPriority" class="form-control">
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




            </fieldset>
        </form>



        <form class="form-horizontal" method="post" id="readingform">
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
                            <option value="1">Õppimine kõrgkoolis</option>
                            <option value="2">Veebiprogrammeerimine</option>
                            <option value="3">Bla bla</option>
                            <option value="4">Dla dla</option>
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

                debug: true,
                rules: {
                    bookname: {required: true},
                    bookauthor: {required: true}},

                messages:{
                    bookname: {required: "Palun sisestage raamatu nimi."},
                    bookauthor: {required: "Palun sisestage raamatu autor."}}
            });

        </script>

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
                        <input id="email" name="email" type="text" placeholder="keegi.õppejõud@tlu.ee" class="form-control input-md" >

                    </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="material">Kodulehe aadress</label>
                    <div class="col-md-4">
                        <input id="material" name="material" value="" placeholder="http://www.mingisait.tlu.ee" type="text" class="form-control input-md">
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
                                foreach($allTeachers as $teacher){
                                    $html = "";
                                    $html .= "<option value='$teacher->name'>$teacher->name</option>";
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




</section>


<?php require("footer.php"); ?>
</body>
</html>
