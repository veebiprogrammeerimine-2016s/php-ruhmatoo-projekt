<?php
require("functions.php");
//require("modals.php");
//require("index.php");
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
$services = getTyreFittingServices($_GET["id"]);

?>


<?php  	require("header.php");?>
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
						<?php echo ucfirst($service->category); ?>
				</li>
           </ul> 
          <?php } ?>
			<div class="card-block">
            Täpsemad hinnad leiad<a href="<?php echo $tyreFitting->pricelist ?>" class="card-link"> SIIT</a>
			</div>
		</div>
		<div class="col-lg-8 col-md-6">
			
			<div class="row">
				<iframe src="<?php echo $tyreFitting->location ?>" width="100%" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
			</div>
			<div class="row">
				<div class="col-lg-6">
					<label for="datetimepicker">Nimi</label>
					<input type="text" id="datetimepicker"  style="width:100%" />
					
				</div>
				<div class="col-lg-6">
					<label for="datetimepicker">Broneeri endale aeg</label>
					<input type="text" id="datetimepicker"  style="width:100%" />
				</div>
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
	$day1->date = "29.11.2016";
	$day1->available = ["10:00","11:00"];
	
	$day2 = new StdClass();
	$day2->date = "30.11.2016";
	$day2->available = ["12:00","13:00"];
	
	$days = [$day1, $day2];
	
	

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
			
			console.log(dateString + " " + day.date)
			if(dateString == day.date){
				
				console.log(day.available);

				this.setOptions({
				  allowTimes: day.available
				});
			}
		}
		
	  // 'this' is jquery object datetimepicker
	 /* if( currentDateTime.getDay()==6 ){
		this.setOptions({
		  minTime:'11:00'
		});
	  }else
		this.setOptions({
		  minTime:'8:00'
		});*/
	};

	$("#datetimepicker").datetimepicker({
		minDate:new Date(), // yesterday is minimum date
		allowTimes:[
			'12:00', '13:00', '15:00',
		],
		format:'d.m.Y H:i',
		onChangeDateTime:logic,
	});
	
</script>
</body>
</html>      