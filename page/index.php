<!--- INDEX PAGE ---->
<?php

require("../functions.php");



if (isset($_GET['logout'])){
    session_destroy();
    header("Location: login.php");
}

if (!isset ($_SESSION["email"])){
    header("Location: login.php");
}

$confirm = "";
$eventType = '';
$eventDescr = '';
$eventPrice = '';
$eventDate = date("Y-m-d");
$eventVin = '';
$eventId = "";
$sort = "date";
$order = "DESC";

if (isset ($_POST["eventType"])){
    $eventType = $_POST["eventType"];
}
if (isset ($_POST ["eventDate"])){
    $eventDate = $_POST["eventDate"];
}
if (isset ($_POST ["eventPrice"])){
    $eventPrice = $_POST["eventPrice"];
}
if (isset ($_POST ["eventDescr"])){
    $eventDescr = $_POST['eventDescr'];
}
if (isset ($_POST ["eventVin"])){
    $eventVin = $_POST['eventVin'];
}

if(isset($_POST['eventType']) && isset($_POST['eventDate']) && isset ($_POST['eventPrice']) && isset ($_POST['eventDescr'])) {
    $Events->newEvent($_SESSION['email'], $Helper->cleanInput($eventType), $Helper->cleanInput($eventVin), $Helper->cleanInput($eventDate), $Helper->cleanInput($eventPrice), $Helper->cleanInput($eventDescr));
}


if(!empty($_POST['delValue'])) {
    $Events->delEvent($_POST['delValue']);
}

if(isset($_GET['q'])){
    $q = $_GET["q"];
}else{
    $q = "";
}

if(isset($_GET["sort"]) && isset($_GET["order"])){
    $sort = $_GET["sort"];
    $order = $_GET["order"];
}

$event = $Events->getAllEvents($_SESSION['email'], $q, $sort, $order);

if(!empty($_POST['editValue'])) {
    $editValue_fill = explode("|", $_POST["editValue"]);
    $eventId = $editValue_fill[0];
    $eventType = $editValue_fill[1];
    $eventDate = $editValue_fill[2];
    $eventPrice = $editValue_fill[3];
    $eventDescr = $editValue_fill[4];
}



if(isset($_POST["carMaker"]) && isset($_POST['carYear'])) {
    $Cars->addNewUserCar($_SESSION['email'], $Helper->cleanInput($_POST['carMaker']), $Helper->cleanInput($_POST['carModel']), $Helper->cleanInput($_POST['carYear']),
    $Helper->cleanInput($_POST['carVin']), $Helper->cleanInput($_POST['carDisplacement']), $Helper->cleanInput($_POST['carFuel']), $Helper->cleanInput($_POST['carGearbox']),
    $Helper->cleanInput($_POST['carDrivetrain']), $Helper->cleanInput($_POST['carDescr']));
}

if(!empty($_POST['delValue'])) {
    $Cars->delUserCar($_POST['delValue'], $_SESSION["email"]);
}


$cars = $Cars->getAllUserCars($_SESSION['email']);

$vincodes = $Events->getVinsForEvents($_SESSION['email']);
$query = $mysqli->query("SELECT * FROM garagediary_addcar_makers WHERE status = 1 ORDER BY maker_name ASC");
$rowCount = $query->num_rows;

require ("../header.php");
?>

<style>
  a{
    color: darkgreen;
  }
</style>

<title>Home // Garagediary</title>


<body data-spy="scroll" data-target=".navbar" data-offset="50">

<!--- NAVIGATION BAR----->
<nav class="navbar navbar-fixed-top navbarlogo">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar6">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php"><!--LOGO HERE (CHECK CSS)-->
            </a>
        </div>
        <div id="navbar6" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#">Home</a></li>
                <li><a href="#carlist">My cars</a></li>
                <li><a href="#events">Events</a></li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"><span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a>Logged in as <strong><?=$_SESSION['email']?></strong></a></li>
                        <li><a href="?logout"><strong>Log out </strong><span class="glyphicon glyphicon-log-out"></span></a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>


<!---ADD NEW CAR MODAL---->
<div id="addCarModal" class="modal fade modal" data-backdrop="static" data-keyboard="false" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <form id="addCarForm" method="post" role="form" data-toggle="validator">
          <div class="modal-header text-center">
            <h2>Adding a new car</h2>
            <h5>Please, fill in the corresponding fields...</h5>
          </div>
          <br>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-8">
                <fieldset>
                  <legend class="text-center">Overall</legend>
                  <div class="form-group">
                      <div class="col-md-3 text-right">
                          <label for="carMaker">Make:<span class="redtext">*</span></label>
                      </div>
                      <div class="col-md-9">
                          <select id="carMaker" name="carMaker" class="form-control input-sm" required data-error="Please, select the make!">
                              <option value="">Select the make...</option>
                              <?php
                              if($rowCount > 0){
                                  while($row = $query->fetch_assoc()){
                                      echo '<option value="'.$row['maker_id'].'">'.$row['maker_name'].'</option>';
                                  }
                              }else{
                                  echo '<option value="">Make not available</option>';
                              }
                              ?>
                          </select>
                          <div class="help-block with-errors"></div>
                      </div>
                  </div>
                  <div class="form-group">
                      <div class="col-md-3 text-right">
                          <label for="carModel">Model:<span class="redtext">*</span></label>
                      </div>
                      <div class="col-md-9">
                          <select id="carModel" name="carModel" class="form-control input-sm" required data-error="Please, select the model!">
                              <option value="">Please, select the make first!</option>
                          </select>
                          <div class="help-block with-errors"></div>
                      </div>
                  </div>
                  <div class="form-group">
                      <div class="col-md-3 text-right">
                          <label for="carYear">Year:<span class="redtext">*</span></label>
                      </div>
                      <div class="col-md-9">
                          <input id='carYear' name="carYear" class="form-control input-sm" type="text" placeholder="ex. 1995" data-error="Please, type in the build year!" required onkeypress="return onlyNumbersWithDot(event);">
                          <div class="help-block with-errors"></div>
                      </div>
                  </div>
                  <div class="form-group">
                      <div class="col-md-3 text-right">
                          <label for="carVin">VIN code:<span class="redtext">*</span></label>
                      </div>
                      <div class="col-md-9">
                        <input id='carVin' name="carVin" class="form-control input-sm" type="text" placeholder="WBAPK5G54BNN27517" data-error="Please, type in the VIN code!" required>
                        <div class="help-block with-errors"></div>
                      </div>
                  </div>
                </fieldset>
              </div>
              <div class="col-md-4 imgcol">
                <img src="../img/documents.png" width="150" height="150">
              </div>
            </div>
            <br><br>
            <div class="row">
              <div class="col-md-4 imgcol">
                <img src="../img/engine.png" width="150" height="150">
              </div>
              <div class="col-md-8">
                <fieldset>
                  <legend class="text-center" >Powerplant</legend>
                  <div class="form-group">
                      <div class="col-md-3">
                          <label for="carDisplacement">Displacement:<span class="redtext">*</span></label>
                      </div>
                      <div class="col-md-9">
                          <input id='carDisplacement' name="carDisplacement" class="form-control input-sm" type="text" placeholder="ex. 1.9" data-error="Please, type in the displacement!" required onkeypress="return onlyNumbersWithDot(event);">
                          <div class="help-block with-errors"></div>
                      </div>
                  </div>
                  <div class="form-group">
                      <div class="col-md-3">
                        <label for="carFuel">Fuel type:<span class="redtext">*</span></label>
                      </div>
                      <div class="col-md-9">
                        <select id="carFuel" name="carFuel" class="form-control input-sm" required data-error="Please, select the fuel">
                            <option value="">Select the fuel type...</option>
                            <option value="Petrol">Petrol</option>
                            <option value="Diesel">Diesel</option>
                            <option value="Electric">Electric</option>
                            <option value="Hybrid">Hybrid</option>
                        </select>
                          <div class="help-block with-errors"></div>
                      </div>
                  </div>
                  <div class="form-group">
                      <div class="col-md-3">
                          <label for="carGearbox">Gearbox:<span class="redtext">*</span></label>
                      </div>
                      <div class="col-md-9">
                        <select id="carGearbox" name="carGearbox" class="form-control input-sm" required data-error="Please, select the gearbox!">
                            <option value="">Select the gearbox...</option>
                            <option value="Manual">Manual</option>
                            <option value="Automatic">Automatic</option>
                            <option value="Semi-automatic">Semi-Automatic</option>
                            <option value="CVT">CVT</option>
                            <option value="DCT">DCT</option>
                        </select>
                          <div class="help-block with-errors"></div>
                      </div>
                  </div>
                  <div class="form-group">
                      <div class="col-md-3">
                          <label for="carDrivetrain">Drivetrain:<span class="redtext">*</span></label>
                      </div>
                      <div class="col-md-9">
                        <select id="carDrivetrain" name="carDrivetrain" class="form-control input-sm" required data-error="Please, select the drivetrain!">
                            <option value="">Select the drivetrain...</option>
                            <option value="Front-wheel">Front-wheel</option>
                            <option value="Rear-wheel">Rear-wheel</option>
                            <option value="All-wheel">All-wheel</option>
                        </select>
                          <div class="help-block with-errors"></div>
                      </div>
                  </div>
                </fieldset>
              </div>
            </div>
            <br><br>
            <div class="row">
              <div class="col-md-8">
                <fieldset>
                  <legend class="text-center">Short description</legend>
                  <div class="form-group">
                      <textarea class="form-control input-sm" id="carDescr" name="carDescr" cols="40" rows="10" data-minlength="20" maxlength="250" placeholder="Description of your car (20 to 250 symbols)..." data-error="Description must be >20 symbols!" required></textarea>
                      <div class="help-block with-errors"></div>
                  </div>
                </fieldset>
              </div>
              <div class="col-md-4 imgcol">
                <img src="../img/pen.png" width="150" height="150">
              </div>
            </div>
          </div>
          <div class="modal-footer">
              <button class ="btn btn-success btn-sm" type ="submit">Save</button>
              <button type="button" class="btn btn-default btn-sm" data-dismiss="modal" onclick="clearAddCarForm()">Close</button>
          </div>
        </form>
      </div>
    </div>
</div>

<!--- ADD NEW EVENT MODAL --->
<div id="addEventModal" class="modal fade" data-backdrop="static" data-keyboard="false" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="newEventForm" method="post" role="form" data-toggle="validator">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-1"></div>
                        <div class="col-sm-10">
                            <h2 class="text-center">New event:</h2>
                            <br>
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="eventType">Type:<span class="redtext">*</span></label>
                                </div>
                                <div class="col-md-9">
                                    <select id="eventType" class="form-control input-sm" name="eventType">
                                        <option value="Planned service" selected>Planned service</option>
                                        <option value="Unplanned service">Unplanned service</option>
                                        <option value="Fuel checks">Fuel checks</option>
                                        <option value="Tuning">Tuning</option>
                                        <option value="Car accident">Car accident</option>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="row form-group">
                                <div class="col-md-3">
                                    <label for="eventVin">Car by VIN:<span class="redtext">*</span></label>
                                </div>
                                <div class="col-md-9">
                                  <select id="eventVin" class="form-control input-sm" name="eventVin">
                                      <<?php
                                          $listHtml = "";
                                      	foreach($vincodes as $v){
                                      		$listHtml .= "<option value='".$v->vincodes."'>".$v->vincodes."</option>";
                                      	}
                                      	echo $listHtml;
                                      ?>
                                  </select>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-3">
                                    <label for="eventDate">Date:<span class="redtext">*</span></label>
                                </div>
                                <div class="col-md-9">
                                    <input class="form-control input-sm" id="eventDate" name="eventDate" type ="date" min="1900-01-01" max = "<?=date('Y-m-d'); ?>" placeholder="YYYY-MM-DD" data-error="Event date is required!" required>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-3">
                                    <label for="eventPrice">Price:<span class="redtext">*</span></label>
                                </div>
                                <div class="col-md-9">
                                    <input class="form-control input-sm" type="text" name="eventPrice" placeholder="ex. 15.50" data-error="Price is required!" required onkeypress="return onlyNumbersWithDot(event);">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-3">
                                    <label for="eventDescr">Description:<span class="redtext">*</span></label>
                                </div>
                                <div class="col-md-9">
                                    <textarea class="form-control input-sm" name="eventDescr" cols="50" rows="10" data-minlength="10" placeholder="Describe event here..." data-error="Description must be >10 symbols!" required></textarea>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class = "btn btn-success btn-sm" type ="submit">Save</button>
                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal" onclick="clearNewEventForm()">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!---JUMBOTRON--->
<div class="jumbotron jumbotron-indexpage text-center">
    <br>
    <h1>Welcome!</h1>
    <h4>Down below you can see your dashboard.<br><br>
    It provides you with a short review of your cars, information and related events.<br><br></h4>
</div>

<!--- CAR LIST --->
<div class="container" id="carlist">
  <div class="row">
    <div class="col-sm-2">
      <h3 class="text-left">My cars: <small><a href="#addCarModal" data-toggle="modal"><span class="glyphicon glyphicon-plus"></span></a></small><br><br></h3>
    </div>
  </div>
        <?php

        if(empty($cars)){
            echo '<div class="row">';
            echo '<div class="col-sm-12 text-center">';
            echo "<strong><h2>You don't have a single car information submitted.</h2></strong><br><h5>Would you like to add one?</h5><br><br>";
            echo '<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#addCarModal"><span class="glyphicon glyphicon-plus"></span> Yes, of course!</button>';

        }else{
            foreach($cars as $c){
                echo '<div class="row carlist-car">';
                echo '<form method="POST">';
                echo '<div class="col-sm-1 col-sm-offset-11">';
                echo "<button class='btn btn-danger btn-sm' value='$c->carVin' name='delValue' onclick=\"return confirm('Delete this car? Warning: can not be restored!')\"><span class='glyphicon glyphicon-remove'></span></button>";
                echo '</div>';
                echo '<div class="row">';
                echo '<h1 class="text-center">',$c->carMaker,'</h1>','<h4 class="text-center">',$c->carModel,' (',$c->carYear,')</h4>';
                echo '<br><br>';
                echo '</div>';
                echo '<div class="row">';
                echo '<div class="col-sm-6">';
                echo "<strong>Engine: </strong>",$c->carDisplacement,' ',$c->carFuel;
                echo '<br><br>';
                echo "<strong>Gearbox: </strong>",$c->carGearbox,' gearbox';
                echo '<br><br>';
                echo "<strong>Drivetrain: </strong>  ",$c->carDrivetrain,' drive';
                echo '<br><br>';
                echo "<strong>VIN: </strong>",$c->carVin;
                echo '<br><br>';
                echo '</div>';
                echo '<div class="col-sm-6">';
                echo "<i>",$c->carDescr,"</i>";
                echo '</div>';
                echo '</div>';
                echo '<br>';
                echo '</form>';
                echo '</div>';
            }
        }



        ?>
</div>
</div>

<!--- EVENT LIST --->
<?php
if(empty($cars)){

  }else{
    echo '<div class="container" id="events">';
      echo '<h3 class="text-left">Events: <small><a href="#addEventModal" data-toggle="modal"><span class="glyphicon glyphicon-plus"></span></a></small><br><br></h3>';
        echo '<div class="row carlist-car">';
            echo '<div class="col-sm-1">';
            echo '</div>';
            echo '<div class="col-sm-10">';
                echo '<form method="post">';
                    echo'<div class="row">';
                        echo'<br>';

                        $typeOrder="ASC";
                        if (isset($_GET["order"]) && $_GET["order"] == "ASC"){
                            $typeOrder = "DESC";
                        }

                        $dateOrder="ASC";
                        if (isset($_GET["order"]) && $_GET["order"] == "ASC"){
                            $dateOrder = "DESC";
                        }

                        $priceOrder="ASC";
                        if (isset($_GET["order"]) && $_GET["order"] == "ASC"){
                            $priceOrder = "DESC";
                        }

                        $descrOrder="ASC";
                        if (isset($_GET["order"]) && $_GET["order"] == "ASC"){
                            $descrOrder = "DESC";
                        }


                        $html = "<table class='table'>";
                        $html .= "<tr>";
                        $html .= "<th>Vin</th>";
                        $html .= "<th style='text-align:center'><a href='?q=".$q."&sort=eventType&order=".$typeOrder."'>Type</a></th>";
                        $html .= "<th style='text-align:center'><a href='?q=".$q."&sort=eventDate&order=".$dateOrder."'>Date</a></th>";
                        $html .= "<th style='text-align:center'><a href='?q=".$q."&sort=eventPrice&order=".$priceOrder."'>Price(€)</a></th>";
                        $html .= "<th style='text-align:center'><a href='?q=".$q."&sort=eventDescr&order=".$descrOrder."'>Description</a></th>";
                        $html .= "<th> </th>";
                        $html .= "<th> </th>";
                        $html .= "</tr>";

                        foreach($event as $e){
                            $html .= "<tr>";
                            $html .= "<td>$e->carVin</td>";
                            $html .= "<td>$e->eventType</td>";
                            $html .= "<td>$e->eventDate</td>";
                            $html .= "<td>$e->eventPrice</td>";
                            $html .= "<td>$e->eventDescr</td>";
                            $html .= "<td><a href='edit.php?id=".$e->eventId."'><img src='../img/edit.png' width='20' height='20'></a></td>";
                            $html .= "<td><button style='border:none; background-color: transparent;' value='$e->eventId' name='delValue' onclick=\"return confirm('Delete?')\"><img src='../img/delete.png' width='20' height='20'></button></td>";
                            $html .= "</tr>";
                        }

                        $html .= "</table>";
                        echo $html;


                    echo'</div>';
                echo '</form>';
                echo '<div class="row">';
                    echo '<form>';
                        echo '<div class="col-sm-10">';
                            echo '<input type="search" class="form-control input-sm" name="q" value="',$q,'" placeholder="Type in keyword...">';
                        echo '</div>';
                        echo '<div class="col-sm-1">';
                            echo '<button type="submit" class = "btn btn-success btn-sm btn-block"><span class="glyphicon glyphicon-search"></span></button>';
                        echo '</div>';
                        echo '<div class="col-sm-1">';
                            echo '<a class="btn btn-warning btn-sm btn-block" href="../page/index.php"><span class="glyphicon glyphicon-erase"></span></a>';
                        echo '</div>';
                    echo '</form>';
                    echo '<br><br>';
                echo '</div>';
            echo '</div>';
        echo '</div>';
    echo '</div>';
  }
  ?>





<script>
    $(document).ready(function(){
      $('[data-toggle="tooltip"]').tooltip();
      $(".navbar a, footer a[href='#home']").on('click', function(event) {

        if (this.hash !== "") {

          event.preventDefault();

          var hash = this.hash;

          $('html, body').animate({
            scrollTop: $(hash).offset().top
          }, 300, function(){

            window.location.hash = hash;
          });
        }
      });
    })
    </script>
<script>
    function clearAddCarForm() {
        document.getElementById("addCarForm").reset();
    }
</script>
<script type="text/javascript">
    function onlyNumbersWithDot(e) {
        var charCode;
        if (e.keyCode > 0) {
            charCode = e.which || e.keyCode;
        }
        else if (typeof (e.charCode) != "undefined") {
            charCode = e.which || e.keyCode;
        }
        if (charCode == 46)
            return true
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }
</script>



<?php require("../footer.php"); ?>

<script type="text/javascript">
    $(document).ready(function(){
        $('#carMaker').on('change',function(){
            var carMakerID = $(this).val();
            if(carMakerID){
                $.ajax({
                    type:'POST',
                    url:'ajaxData.php',
                    data:'maker_id='+carMakerID,
                    success:function(html){
                        $('#carModel').html(html);
                    }
                });
            }else{
                $('#carModel').html('<option value="">Please, select the make first!</option>');
            }
        });
    });
</script>
