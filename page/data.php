<?php 
	// et saada ligi sessioonile
	require("../functions.php");
	
    require("../class/Helper.class.php");
	$Helper = new Helper();
	
	require("../class/Note.class.php");
	$Note = new Note($mysqli);
	
	//ei ole sisseloginud, suunan login lehele
	if(!isset ($_SESSION["userId"])) {
		header("Location: login.php");
		exit();
	}
	
	//kas kasutaja tahab välja logida
	// kas aadressireal on logout olemas
	if (isset($_GET["logout"])) {
		
		session_destroy();
		
		header("Location: login.php");
		exit();
	}
	
	if (	isset($_POST["note"]) && 
			isset($_POST["color"]) && 
			!empty($_POST["note"]) && 
			!empty($_POST["color"]) 
	) {
		
		$note = $Helper->cleanInput($_POST["note"]);
		$color = $Helper->cleanInput($_POST["color"]);
		
		$Note->saveNote($note, $color);
		
	}
	
	
	$q = "";
	
	// otsisõna aadressirealt
	if(isset($_GET["q"])){
		$q = $Helper->cleanInput($_GET["q"]);
	}
	
	//vaikimisi
	$sort = "id";
	$order = "ASC";
	
	if(isset($_GET["sort"]) && isset($_GET["order"])){
		$sort = $_GET["sort"];
		$order = $_GET["order"];
	}
	
	
	$notes = $Note->getAllNotes($q, $sort, $order);
	
	//echo "<pre>";
	//var_dump($notes);
	//echo "</pre>";
?>

<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</html>
<html lang="en">
<head>
<style>
@import url('https://fonts.googleapis.com/css?family=Roboto');
</style>
  <title>Groupwork</title>
  <meta charset="ANSI">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<head>
<link rel="stylesheet" type="text/css" href="../style/navigation.css">
</head>
</head>
<div class="container-fluid">
  <div class="row content">
    <div class="col-sm-3 sidenav">
      <h4 style="color:white; font-size:250%">
	  Shazza Mate
	  </h4>
	  <h4 style="color:white; font-size:200%">
	  productions
	  </h4>
      <ul class="nav nav-pills nav-stacked">
        <li>
		<a onclick="location.href = 'login.php';" style="color:red;" href="#section1";>Home</a>
		</li>
        <li><a onclick="location.href = 'AboutMe.php';" style="color:red;"href="#section2">About Me</a></li>
	<div>
	</div>
		
<div class="panel-group" id="accordion">

  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
        Account
		</a>
      </h4>
    </div>
        <div id="collapse1" class="panel-collapse collapse">
      <ul class="list-group">
        <li class="list-group-item">
		
		<html>
	<body>
<a href="?logout=1">Log Out</a>
		</li>
      </ul>
	  </div>
  </div>
</div>
    
</body>
</html>	
      </ul><br>
    </div>
    <div class="col-sm-9">
</ul>
<!-- Original tabs START -->
<head>
<link rel="stylesheet" type="text/css" href="../style/tabs.css">
</head>
<body>
<ul class="tab">
  <li><a href="javascript:void(0)" class="tablinks" onclick="openTab(event, 'RECENT')">MOST RECENT</a></li>
  <li><a href="javascript:void(0)" class="tablinks" onclick="openTab(event, 'GAMES')">GAMES</a></li>
  <li><a href="javascript:void(0)" class="tablinks" onclick="openTab(event, 'HARDWARE')">HARDWARE</a></li>
  <li><a href="javascript:void(0)" class="tablinks" onclick="openTab(event, 'YOUTUBE')">YOUTUBE</a></li>
  <li><a href="javascript:void(0)" class="tablinks" onclick="openTab(event, 'SEARCH')">SEARCH</a></li>
</ul>
<div id="" style="overflow-y:scroll; overflow-x:hidden; height:810px; width:1410px">
<div id="RECENT" class="tabcontent">
  <div id="tab1" class="tab-pane">
      <hr>
      <h2>The RX480</h2>
      <h5><span class="glyphicon glyphicon-time"></span> Post by Shazza Mate, Sep 27, 2015.</h5>
      <h5><span class="label label-danger">Hardware</span> <span class="label label-primary">Video Cards</span></h5><br>
<p>
AMD has announced two GPUs to be based on the Polaris 10 die, the biggest of which is the 2304 Steam Processor-enabled Radeon RX 480, which does use the full silicon. The die measures just 232 mm2 and crams in 5.7 billion transistors.
 This makes the die incredibly small for a GPU claiming 5.8 TFLOPS of compute power. In terms of physical size this means the RX 480 GPU is similar to the R7 370, a GPU with just 1024 SPUs for just 2 TFLOPS of compute power.

In total there are 36 compute units resulting in 2304 stream processors along with 144 texture mapping units and 32 render output units, or raster operations pipelines, depending on your naming preference.
 These core specifications place the RX 480 squarely between the Radeon R9 380X and R9 390.
<br>
When compared to the R9 390 though the RX 480 does have one major disadvantage; memory bandwidth. Both the 4GB and 8GB models feature GDDR5 memory clocked at 2000MHz using a 256-bit wide memory bus resulting in throughput of 256GB/s.
 In comparison the R9 390 utilizes a 512-bit memory bus and although it uses lower clocked memory it still achieves a 384 GB/s throughput.
<br>
Propping up the RX 480 is the core clock speed which has been set at 1120 MHz and can boost as high as 1266 MHz. That’s a 27% boost over the R9 390’s operating frequency and should help account for having 10% fewer cores.
</p>
	  <div id="myCarousel" class="carousel slide" data-ride="carousel" style="height:720px; width:1280px; margin:0 auto;">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
    <li data-target="#myCarousel" data-slide-to="3"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <div class="item active">
      <img class="img-responsive center-block" src="../images/rx480_1.jpg" alt="480">
    </div>

    <div class="item">
      <img class="img-responsive center-block" src="../images/rx480_2.jpg" alt="480">
    </div>

    <div class="item">
      <img class="img-responsive center-block" src="../images/rx480_3.jpg" alt="480">
    </div>

    <div class="item">
      <img class="img-responsive center-block" src="../images/rx480_4.jpg" alt="480">
    </div>
  </div>

  <!-- Left and right controls -->
  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>


    
          <div class="row">

              <br>
            </div>
          </div>
</div>

<div id="GAMES" class="tabcontent">
  <h3>here's a fucking game you silly cunt</h3>
  <p>Paris is the capital of France. Or is it?</p> 
</div>

<div id="HARDWARE" class="tabcontent">
  <h3>Tokyo Drift</h3>
  <p>Tokyo is the capital of Japan, and i'm the DK</p>
</div>


<div id="YOUTUBE" class="tabcontent">
      <hr>
      <h2>Shazza Mate's YouTube</h2>
	  <br>
	  <div>
	  <br>
	  <font size="4">FX-6300 review!</font>
	  <br>
	  <iframe width="560" height="315" src="https://www.youtube.com/embed/4AddwU7EVOg"
	  frameborder="0" allowfullscreen></iframe>
	  </div>
	  <br><br>
	  
	  <hr>
      <h2>Shazza Mate's Favorites</h2>
	  <br><br>
	  <font size="3">Stop Supporting NVIDIAs Anti Consumer Practices!!! Why Supporting AMD is Supporting PC Gaming!</font>
	  <br>
	  <iframe width="560" height="315" src="https://www.youtube.com/embed/ANz0CBa0wyg"
	  frameborder="0" allowfullscreen></iframe>
	  
</div>


<div id="SEARCH" class="tabcontent">
  <h3>Search</h3>
        <div class="input-group">
<form>
	<input type="search" name="q" value="<?=$q;?>">
	<input type="submit" value="Otsi">	
</form>
<?php 
	//iga liikme kohta massiivis
	foreach ($notes as $n) {
		
		$style = "width:100px; 
				  float:left;
				  min-height:100px; 
				  border: 1px solid gray;
				  background-color: ".$n->noteColor.";";
		
		echo "<p style='  ".$style."  '>".$n->note."</p>";
	}
?>


<h2 style="clear:both;">Tabel</h2>
<?php 
	$html = "<table>";
		
		$html .= "<tr>";
		
			$orderId = "ASC";
			
			if (isset($_GET["order"]) && 
				$_GET["order"] == "ASC" && 
				$_GET["sort"] == "id" ){
				
				$orderId = "DESC";
			}
		
			$html .= "<th>
			
						<a href='?q=".$q."&sort=id&order=".$orderId."'>
							id
						</a>
					</th>";
			
			$orderNote = "ASC";
			
			if (isset($_GET["order"]) && 
				$_GET["order"] == "ASC" && 
				$_GET["sort"] == "note" ){
				
				$orderNote = "DESC";
			}
		
			$html .= "<th>
			
						<a href='?q=".$q."&sort=note&order=".$orderNote."'>
							Märkus
						</a>
					</th>";
						
			
			
			$orderColor = "ASC";
			
			if (isset($_GET["order"]) && 
				$_GET["order"] == "ASC" && 
				$_GET["sort"] == "color" ){
				
				$orderColor = "DESC";
			}
		
			$html .= "<th>
			
						<a href='?q=".$q."&sort=color&order=".$orderColor."'>
							Värv
						</a>
					</th>";
					
		$html .= "</tr>";
	foreach ($notes as $note) {
		$html .= "<tr>";
			$html .= "<td>".$note->id."</td>";
			$html .= "<td>".$note->note."</td>";
			$html .= "<td>".$note->noteColor."</td>";
			$html .= "<td><a href='edit.php?id=".$note->id."'>edit.php</a></td>";
		$html .= "</tr>";
	}
	
	$html .= "</table>";
	
	echo $html;
?>
      </div>
</div>


<script>
function openTab(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}
</script>
</div>
</div>
</div>
</div>
</div>
</div>

<?php
require("../page/footer.php");
?>

</body>
</html>
