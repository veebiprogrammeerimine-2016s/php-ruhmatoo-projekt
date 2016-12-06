<?php

require("functions.php");
require_once("pdf/tcpdf.php");


if(isset($_POST["regPassword"]) && isset($_POST["regUsername"]))
	{
		if( !empty($_POST["regPassword"])&& !empty($_POST["regUsername"]))
		{

		signUP($_POST["regUsername"],$_POST["regPassword"]);
		
		?>
        <script>alert("Kasutaja on tehtud!");</script>
        <?php
		
		}
   
	}
		
if(isset($_POST["username"]) && isset($_POST["password"]))
	{
		
		login($_POST["username"],$_POST["password"]);
		if(!isset($_SESSION["userId"]))
		{
			?> <script> alert("Vale parool või kasutaja nimi"); </script> <?php
		}
		
	}
$tyreFitting = getSingleTyreFitting($_GET["id"]);
$services = FittingServicesMinPrice($_GET["id"]);

if(isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["phone"]) && isset($_POST["service"]) && isset($_POST["carnumber"]) && isset($_POST["datetimepicker"]))
	{
		if( !empty($_POST["name"])&& !empty($_POST["email"]) && !empty($_POST["phone"]) && !empty($_POST["service"]) && !empty($_POST["carnumber"]) && !empty($_POST["datetimepicker"]))
		{
			$success = placeOrder($_POST["name"],$_POST["email"],$_POST["phone"],$_POST["note"],$_POST["service"],$_POST["carnumber"],$_POST["datetimepicker"],$_GET["id"]);
			
			if ($success == true){
				if(sendEmail($_POST["email"])){
					$emailSent = true;
				}else{
					$emailError = "Unable to send email";
				}
			}else{
				
			}
			
         //	mail($_POST["email"],"Teade","Teie aeg on reserveeritud, saadame teile arve","info@rehvivahetus.ee");
			//sendPDF($_POST["name"],$_POST["phone"]);
			
			
								           
		}
	}
?>
<?php require("header.php");?>
<?php if(isset($emailSent)): ?>
	<script>
		$(function() {
			// kogu html on laetud
			$('#login').modal('show');
		});
	</script>
<?php endif; ?>
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
                            <label>Nimi:<span class="req-form-field">*</span></label><br  />
                            <input type="text" name="name" id="name" class="form-control required" required="required"/>
                        </p>
                         <p>
                            <label>E-post:<span class="req-form-field">*</span></label><br  />
                            <input type="text" name="email" id="email" class="form-control required" required="required"/>
                        </p>
                        
                        <p>
                            <label>Telefon:<span class="req-form-field">*</span></label><br  />
                            <input type="text" id="mobile-number" name="phone" class="form-control required" required="required"/>
                            
                        </p>
                        <p>
                            <label>Kommentaar:</label><br  />
                            <input type="text" name="note" class="form-control" />
                        </p>
                              
                        <br />
          					
					</div>
                    <div class="col-lg-6">
                    	
                            <label>Teenused:<span class="req-form-field">*</span></label><br/><div style="clear:both"></div>
                            <select name="service" class="c-select" style="width:100%; height:38px;" required>
                                  <option selected disabled></option>
                                   <?php foreach($services as $service)
									  {?>
                                  			<option value="<?php echo ucfirst($service->id); ?>"><?php echo ucfirst($service->name); ?></option>
                                   <?php } ?>
                                 
							</select>
							<p></p>	
                        
                        <p>
                            <label>Auto number:<span class="req-form-field">*</span></label><br  />
                            <input type="text" name="carnumber" class="form-control required" required="required"/>
                        </p>
                        <label for="datetimepicker">Vali endale aeg:<span class="req-form-field">*</span></label>
                        <input type="text" name="datetimepicker" id="datetimepicker" class="form-control required"  style="width:100%" required="required" /></br></br>
                        <input type="submit" id="order-btn" class="btn btn-success" name="bookthistime"  value="Broneeri" />
                    </div>
                    
            	</form>
			</div>
		
		</div>
		
	</div>
	
</div>

<?php require("modals.php");
require("footer.php");?>   
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/js/bootstrap.min.js"
            integrity="sha384-vZ2WRJMwsjRMW/8U7i6PWi6AlO1L79snBrmgiDpgIWJ82z8eA5lenwvxbMV1PAh7"
            crossorigin="anonymous"></script>
    <!-- our scripts -->
<script type="text/javascript" src="js/sc.js"></script>
<script type="text/javascript" src="js/jquery.datetimepicker.full.js"></script>
<?php

	// date time taken
	// open times 
	
	$day1 = new StdClass();
	$day1->date = "1.12.2016";
	$day1->available = ["10:00","11:00"];
	
	$day2 = new StdClass();
	$day2->date = "30.11.2016";
	$day2->available = ["12:00","13:00"];
	
	$day3 = new StdClass();
	$day3->date = "5.12.2016";
	$day3->available = ["12:00","13:00","14:00"];
	
	$days = [$day1, $day2,$day3];
	
	

?>
<script>


	var days = <?php echo json_encode($days); ?> ;
	console.log(days);
	var logic = function( currentDateTime ){
		console.log(currentDateTime);
		
		var dateString = currentDateTime.getDate() + "." + (currentDateTime.getMonth()+1) + "." + currentDateTime.getFullYear();
		
		
		console.log(dateString);
			
		for(var i = 0; i < days.length; i++){
			var day = days[i];

			if(dateString == day.date){
				
				console.log(day.date);
				this.setOptions({
				  timepicker:true,
				  allowTimes: day.available
				
				});
				break;
			}
			else
			{
				this.setOptions({
				  timepicker:true,
				  allowTimes: ['00:00','01:00', '02:00', '03:00', '04:00', '05:00', '06:00', '07:00',
				  			   '08:00','09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00',
							   '16:00','17:00', '18:00', '19:00', '20:00', '21:00', '22:00', '23:00']				 				
				
				
				
				});
				
			}
			
		}
		
	};
	/*var minDateTime =  new Date();
		minDateTime.setHours(minDateTime.getHours());*/
	$("#datetimepicker").datetimepicker({
		minDate:new Date(),
		//minTime:minDateTime,
		format:'d.m.Y H:i',
		defaultSelect:false,
		timepicker:false,
		onChangeDateTime:logic
				
	});
	

	
</script>
</body>
</html>      