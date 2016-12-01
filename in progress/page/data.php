<?php 
	// et saada ligi sessioonile
	require("../functions.php");
	
    require("../class/Helper.class.php");
	$Helper = new Helper();
	
	require("../class/Note.class.php");
	$Note = new Note($mysqli);
	
	//ei ole sisseloginud, suunan login lehele
	/*if(!isset ($_SESSION["userId"])) {
		header("Location: login.php");
		exit();
	}*/
	
	//kas kasutaja tahab välja logida
	// kas aadressireal on logout olemas
	if (isset($_GET["logout"])) {
		
		session_destroy();
		
		header("Location: login.php");
		exit();
	}
	
	if (	isset($_POST["firstname"]) &&
			isset($_POST["lastname"]) &&
			isset($_POST["notebook"]) &&
			isset($_POST["serialnumber"]) &&
			isset($_POST["priority"]) &&
			isset($_POST["note"]) &&
			isset($_POST["color"]) &&
			isset($_POST["comment"]) &&
			
			!empty($_POST["firstname"]) &&
			!empty($_POST["lastname"]) &&
			!empty($_POST["notebook"]) &&
			!empty($_POST["serialnumber"]) &&
			!empty($_POST["priority"]) &&
			!empty($_POST["note"]) &&
			!empty($_POST["color"]) &&
			!empty($_POST["comment"])  
	
	) {
		$firstname = $Helper->cleanInput($_POST["firstname"]);
		$lastname = $Helper->cleanInput($_POST["lastname"]);
		$notebook = $Helper->cleanInput($_POST["notebook"]);
		$serialnumber = $Helper->cleanInput($_POST["serialnumber"]);
		$priority = $Helper->cleanInput($_POST["priority"]);
		$note = $Helper->cleanInput($_POST["note"]);
		$color = $Helper->cleanInput($_POST["color"]);
		$comment = $Helper->cleanInput($_POST["comment"]);
		
		$Note->saveNote($firstname,$lastname,$notebook,$serialnumber,$priority,$note, $color,$comment);
		
		}
		
	$firstnameError = "";
	$firstname = "";
	
	//kas on üldse olemas
	if (isset ($_POST["firstname"])) {
		
		// oli olemas, ehk keegi vajutas nuppu
		// kas oli tühi
		if (empty ($_POST["firstname"])) {
			
			//oli tõesti tühi
			$firstnameError = "Enter your name!";
			
		} else {
				
			// kõik korras, nimi ei ole tühi ja on olemas
			$firstname = $_POST["firstname"];
		}
		
	}	
	
	$lastnameError = "";
	$lastname = "";
	
	if (isset ($_POST["lastname"])) {
		
		if (empty ($_POST["lastname"])) {
			
			$lastnameError = "Enter your lastname!";
			
		} else {
				
			$lastname = $_POST["lastname"];
		}
		
	}	
	
	$serialnumberError = "";
	$serialnumber = "";
	
	if (isset ($_POST["serialnumber"])) {
		
		if (empty ($_POST["serialnumber"])) {
			
				$serialnumberError = "Enter the serialnumber!";
			
		} else {
				
			$serialnumber = $_POST["serialnumber"];
		}
		
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
<?php require("../header.php"); ?>

<div class="container">
	<div class="row">
		<div class="col-sm-4 col-md-3">
		
	<h1>Create ticket</h1>
	<p>
		Welcome, <a href="user.php"><?=$_SESSION["userEmail"];?></a>!
		<a href="?logout=1">Log out</a>
	</p>
	<h2>Enter the information</h2>

	<form method="POST">
				
			<br>
			<div class="form-group">
			<label><b>Name<b></label>
			<input class="form-control" name="firstname" type="text" value="<?=$firstname;?>" > <?php echo $firstnameError; ?>
			
			<br><br>
			
			<label><b>Lastname</b></label>
			 <br>
			 <div class="form-group">
			 <input class="form-control" name="lastname" type="text" value="<?=$lastname;?>" > <?php echo $lastnameError; ?>
			
			<br><br>
			
			<label><b>PC</b></label>
			
			<br>
			<div class="form-group">
			<select class ="form-control" name="notebook">
				<option value="asus">Asus</option>
				<option value="dell">Dell</option>
				<option value="lenovo">Lenovo</option>
			</select>
			
			<br><br>
			
			<label><b>Serialnumber</b></label>
			<div class="form-group">
			<input class="form-control" name="serialnumber" type="text" value="<?=$serialnumber;?>" > <?php echo $serialnumberError; ?>
			
			<br><br>
			
			<label><b>Priority</b></label>
			
			<br>
			<div class="form-group">
			<select class="form-control" name="priority">
				<option value="high">High</option>
				<option value="normal">Normal</option>
				<option value="low">Low</option>
			</select>
			
			<br><br>
			
			<label>Notes</label><br>
			<div class="form-group">
			<input class="form-control" name="note" type="text">
			
			<br><br>
			
			
			<label>Color</label><br>
			<input name="color" type="color">
						
			<br><br>
			
			<h3>Problem description:</h3>
			
			<div class="form-group">
			<textarea class="form-control" name="comment" rows="5" cols="40"> </textarea>
			</div>
			<br> <br>
				
					<input class="btn btn-primary btn-sm hidden-xs" type="submit" value="Register">
					<input class="btn btn-primary btn-sm btn-block visible-xs-block" type="submit" value="Register">

				</form>
				</div>
				<div class="col-sm-4 col-md-3 col-sm-offset-4 col-md-offset-3">
			</div>
	</div>	</div>
</div>	

<h2>Search</h2>
<div class="container">
	<div class="row">
		<div class="col-sm-3 col-md-4">
		<form>
			<div class="form-group">
			<input class="form-control" type="search" name="q" value="<?=$q;?>">
			<br>
			<input class="btn btn-success btn-sm hidden-xs" type="submit" value="Search">
			<input class="btn btn-success btn-sm btn-block visible-xs-block" type="submit" value="Search">
			
					</form>
				</div>
				<div class="col-sm-4 col-md-3 col-sm-offset-4 col-md-offset-3">
			</div>
		</div>
	</div>
</div>

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


<h2 style="clear:both;">Information</h2>
<?php 
	$html = "<table class='table'>";
		
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
		
			/*$html .= "<th>
			
						<a href='?q=".$q."&sort=note&order=".$orderNote."'>
							Märkus
						</a>
					</th>"; */
						
			
			
			$orderColor = "ASC";
			
			if (isset($_GET["order"]) && 
				$_GET["order"] == "ASC" && 
				$_GET["sort"] == "color" ){
				
				$orderColor = "DESC";
			}
		
			/*$html .= "<th>
			
						<a href='?q=".$q."&sort=color&order=".$orderColor."'>
							Värv
						</a>
					</th>"; */
				
		$html .= "</tr>";
		
			$html .= "<th>Firstname";
			$html .= "<th>Lastname";
			$html .= "<th>Notebook";
			$html .= "<th>Serialnumber";
			$html .= "<th>Priority";
			$html .= "<th>Comment";
	foreach ($notes as $note) {
		$html .= "<tr>";
			$html .= "<td>".$note->id."</td>";
			$html .= "<td>".$note->firstname."</td>";
			$html .= "<td>".$note->lastname."</td>";
			$html .= "<td>".$note->notebook."</td>";
			$html .= "<td>".$note->serialnumber."</td>";
			$html .= "<td>".$note->priority."</td>";
			$html .= "<td>".$note->note."</td>";
			$html .= "<td>".$note->noteColor."</td>";
			$html .= "<td>".$note->comment."</td>";
			$html .= "<td><a href='edit.php?id=".$note->id."'> <span class='glyphicon glyphicon-pencil'><span></a></td>";
		$html .= "</tr>";
	}
	
	$html .= "</table>";
	
	echo $html;
?>
<?php require("../footer.php"); ?>