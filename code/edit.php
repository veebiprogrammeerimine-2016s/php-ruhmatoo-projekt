	<?php
		require("functions.php");
		if(isset($_POST["update"])){
			
			update(cleanInput($_POST["id"]), cleanInput($_POST["task"]), cleanInput($_POST["date"]."-01"));
			
			header("Location: edit.php?id=".$_POST["id"]."&success=true");
			exit();	
			
		}
		
		//kustutan
		elseif(isset($_POST["delete"])){
			deletetask ($_POST["id"]);
		header("Location: data.php");
		exit();
	}
		
		
		// kui ei ole id'd aadressireal siis suunan
		if(!isset($_GET["id"])){
			header("Location: data.php");
			exit();
		}
		$s = getSingleData($_GET["id"]);

		var_dump($s);
		
		
	?>
<h1><a href="about.php"> About</a> Home</a> <a href="user.php"> Contacts</a> <?=$_SESSION["userEmail"];?>!</a>
	<a href="?logout=1">Logout</a></h1>

	<h2><a href="data.php"> Back </a> Change </h2>
	 <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
				<input type="hidden" name="id" value="<?=$_GET["id"];?>" > 
				<label>Task</label><br>
				<input name="task" type="text"> 
				<br>
	
				<label>Deadline</label><br>
				<input name="date" type="text" id="datepicker">
				<br>			
				<input a href="data.php" type="submit" name="update" value="Save">
				<input type="submit" name="delete" value="Delete">
	</form>
	  
<head>
<link rel="stylesheet" href="pikaday.css">
<link rel="stylesheet" href="site.css">
<link rel="stylesheet" href="theme.css">
<link rel="stylesheet" href="triangle.css">
</head>
<link rel="stylesheet" href="pikaday.css">

<br>
<br>
<br>
<br>
<br>
<script src="moment.js"></script>
<script src="pikaday.js"></script>
<script>
    var picker = new Pikaday({
        field: document.getElementById('datepicker'),
        format: 'YYYY-MM-D',
        onSelect: function() {
            console.log(this.getMoment().format('Do MMMM YYYY'));
        }
    });
</script>