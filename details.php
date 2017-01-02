<?php

require("functions.php");
require_once("pdf/tcpdf.php");
require("classes/owner_class.php");
require("classes/tyrefitting_class.php");

$Owner = new Owner($mysqli);
$TyreFitting = new TyreFitting($mysqli);

$Owner->LoginRegValidation($Owner);

$tyreFitting = $TyreFitting->getSingleTyreFitting($_GET["id"]);
$services = $TyreFitting->FittingServicesMinPrice($_GET["id"]);
$times = $TyreFitting->getTyreFittingTimesAvailable($_GET["id"]);
$orders = getOrders($_GET["id"]);

$date_reserved="";

$date_arr = array();
$time_arr = array();

foreach ($orders as $order)
{
    $reserved = $order -> booktime;
    $reserved_date = substr($reserved ,0,10);
    $reserved_time = substr($reserved ,11,5);

    array_push($date_arr, $reserved_date);
    array_push($time_arr, $reserved_time);

}

//$reserved = array($datea => []);
if(isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["phone"]) && isset($_POST["service"]) && isset($_POST["carnumber"]) && isset($_POST["datetimepicker"]))
{
    if( !empty($_POST["name"])&& !empty($_POST["email"]) && !empty($_POST["phone"]) && !empty($_POST["service"]) && !empty($_POST["carnumber"]) && !empty($_POST["datetimepicker"]))
    {
        $success = placeOrder($_POST["name"],$_POST["email"],$_POST["phone"],$_POST["note"],$_POST["service"],$_POST["carnumber"],$_POST["datetimepicker"],$_GET["id"]);

        echo "</br>";?>
        <?php

        if ($success == true){

            if(sendEmail($_POST["email"], $_POST["name"], $_POST["phone"], $_POST["note"], $_POST["carnumber"], $_POST["datetimepicker"])){
                $emailSent = true;
                header("Refresh:0");
            }else{
                $emailError = "Unable to send email";
            }
        }else{

        }

    }
}

//var_dump($reserved);
?>
<?php require("header.php");
?>

<?php  if(isset($emailSent)):   ?>
    <script>
        $(function() {
            // kogu html on laetud
            $('#bookingMessage').modal('show');
        });
    </script>

<?php endif;  ?>



<body style="padding-top:70px;">
<div class="container">
    <nav class="navbar navbar-fixed-top navbar-dark bg-primary">
        <div class="">
            <ul class="nav navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Esileht <span class="sr-only">(current)</span></a>
                </li>
            </ul>
            <a class="navbar-brand pull-sm-right m-r-0 hidden-sm-down" href="http://www.tlu.ee">Presented by TLÜ team</a>
            <ul class="nav navbar-nav ">
                <li class="nav-item pull-xs-right mrg">
                    <a class="nav-link"  data-toggle="modal" data-target="#login" style="cursor:pointer">Logi sisse</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="card">
        <div class="row">
            <div class='col-md-6 col-lg-4'>
                <img class="card-img-top" src="<?php echo $tyreFitting->logo ?>" alt="Card image cap" style="width:100%;">
                <div class="card-block">
                    <h4 class="card-title"><?php echo $tyreFitting->name ?></h4>
                    <p class="card-text"><?php echo $tyreFitting->description  ?></p>
                    <h4>Teenused</h4>
                </div>
                <?php foreach($services as $service)
                {?>

                    <ul class="list-group">
                        <li class="list-group-item">
                            <span class="label label-default label-pill pull-xs-right">alates <?php echo $service->price ?> EUR</span>
                            <?php echo ucfirst($service->name); ?>
                        </li>
                    </ul>
                <?php } ?>
                <div class="card-block">
                    Täpsemad hinnad leiad<a href="<?php echo $tyreFitting->pricelist ?>" class="card-link"> SIIT</a>
                </div>
            </div>
            <div class="col-lg-8 col-md-6">
                <iframe src="<?php echo $tyreFitting->location ?>" width="100%" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>

                <!-- ORDER FORM -->
                <div class="row">
                    <?php if(isset($emailError)): ?><div class="alert alert-danger" role="alert"><?=$emailError;?></div><?php endif; ?>
                    <div class="col-lg-6">
                        <form method="post" id="bookingForm">
                            <p>
                                <label for="name">Nimi:<span class="req-form-field">*</span></label><br  />
                                <input type="text" name="name" id="name" class="form-control required" required="required"/>
                            </p>
                            <p>
                                <label for="email">E-post:<span class="req-form-field">*</span></label><br  />
                                <input type="text" name="email" id="email" class="form-control required" required="required"/>
                            </p>
                            <p>
                                <label for="mobile-number">Telefon:<span class="req-form-field">*</span></label><br  />
                                <input type="text" id="mobile-number" name="phone" class="form-control required" required="required"/>
                            </p>
                            <p>
                                <label for="note">Kommentaar:</label><br  />
                                <input type="text" name="note" id="note" class="form-control" />
                            </p>
                            <br />
                    </div>
                    <div class="col-lg-6">

                        <label for="service">Teenused:<span class="req-form-field">*</span></label><br/><div style="clear:both"></div>
                        <select name="service" id="service" class="c-select" style="width:100%; height:38px;" required>
                            <option selected disabled></option>
                            <?php foreach($services as $service)
                            {?>
                                <option value="<?php echo ucfirst($service->id); ?>"><?php echo ucfirst($service->name); ?></option>
                            <?php } ?>

                        </select>
                        <p></p>

                        <p>
                            <label for="carnumber">Auto number:<span class="req-form-field">*</span></label><br  />
                            <input type="text" name="carnumber" id="carnumber" class="form-control required" required="required"/>
                        </p>
                        <label for="datetimepicker">Vali endale aeg:<span class="req-form-field">*</span></label>
                        <input type="text" name="datetimepicker" id="datetimepicker" class="form-control required"  style="width:100%" required="required" /><br><br>
                        <input type="submit" id="order-btn" class="btn btn-success" name="bookthistime"  value="Broneeri" />
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php require("modals.php");
    require("footer.php");?>

    <?php

    $days=[];
    $time = mktime(0, 0, 0, date("m")  , date("d"), date("Y"));

    $days_forecast = 14;
    $array = [];

    for($i =0; $i < $days_forecast; $i++){

        $day = new StdClass();
        $time = mktime(0, 0, 0, date("m")  , date("d")+$i, date("Y"));

        $day->date = date("j.m.Y", $time);
        array_push($array,$day->date);

        foreach($times as $t) {

            $dayNumber = date("N", $time);

            if ($dayNumber == 7) {
                $dayNumber = 0;
            }

            if ($t->day == $dayNumber) {
                $day->available = [];
                $start = strtotime($t->open);
                $close = strtotime($t->close);
                $lunch_begin = strtotime($t->lunch_begin);
                $lunch_end = strtotime($t->lunch_end);

                for ($j = 0; $j < 24; $j++) {
                    //echo
                    if (date("j.m.Y", $time) == date("j.m.Y") && intval(date("G")) + 1 >= $j) {
                        continue;
                    }

                  //  if ($j < 10) {
                    //    $time_string = "0" . $j . ":00";
                    //} else {
                        $time_string = $j . ":00";
                    //}

                    $our_time = strtotime($time_string);

                    if ($our_time >= $start && $our_time <= $close && $our_time != $lunch_begin) {
                        array_push($day->available, $time_string);
                    }
                }
            }
        }


        array_push($days, $day);
    }
    foreach ($days as $d ) {
    //     var_dump($d->date);
         if($d->date[1] == ".")
         {
             $d->date = "0" . $d->date;
         }
      //  echo "<br>";
      //  echo "<br>";
        for ($o = 0; $o < count($date_arr); $o++  )
        {
            if($date_arr[$o] == $d->date)
            {
             //   echo "<br>";
              //  print_r($d->available[0]);
             //   echo "<br>";

                if(in_array($time_arr[$o],$d->available))
                {
                    $array = [];
                    $array = array_diff($d->available, array($time_arr[$o]));
                    $d->available = $array;
                    $d->available = array_values(array_filter($d->available));
                   // print_r($d->date);
                }

            }
        }
    }

    ?>
    <script>


        var days = <?php echo json_encode($days); ?> ;
        console.log(days);

       var log = function()
        {
            this.setOptions({
                timepicker:false,
               // allowTimes: day.available
               format:'d.m.Y'
            });
        };
        var logic = function( currentDateTime ){
            console.log(currentDateTime);
            //console.log(currentDateTime.getDay());
            var month = (currentDateTime.getMonth() + 1);
            var d = currentDateTime.getDate();

            if(month < 10)
            {
                month = "0" + month;
            }
            if(d < 10)
            {
                d = "0" + d;
            }

            var dateString = d + "." + month + "." + currentDateTime.getFullYear();

            console.log(dateString);

            for(var i = 0; i < days.length; i++){
                var day = days[i];

                console.log(days[i]);


                if(dateString == day.date && day.available.length > 0){

                    console.log(day.available);
                    this.setOptions({
                        timepicker:true,
                        
                       allowTimes: day.available,
                       // minTime:'11:00'

                    });

                    document.getElementById("datetimepicker").value = dateString + " " + currentDateTime.getHours() + ":00";

                    break;
                }
                else
                {
                    console.log("disabling " + dateString);
                    this.setOptions({
                        timepicker:true,
                        allowTimes: []
                    });

                }

           //    document.getElementById("datetimepicker").value = "";
            }


        };

        var disabled_dates = [];
        var allow_dates = [];
        for(var i = 0; i < days.length; i++){

            var d = days[i].date.substring(0,2);

            if (d[1] == ".")
            {
                days[i].date = "0" + days[i].date;
            }
            if(days[i].available == 0){
                
                disabled_dates.push(days[i].date);

            }
            if(days[i].available != 0)
            {
                allow_dates.push(days[i].date);
            }
        }

        console.log(disabled_dates);
        console.log(allow_dates);


        $("#datetimepicker").datetimepicker({
          // inline:true,
            minDate:new Date(),
            format:'d.m.Y H:i',
          //  datepicker:true,
            defaultSelect:false,
            timepicker:false,
            //onSelectDate:log,
            onChangeDateTime:logic,
            disabledDates: disabled_dates,
            formatDate:'d.m.Y',
            allowDates: allow_dates,

          //  formatDate:'d.m.Y'



        });



    </script>
</body>
</html>      