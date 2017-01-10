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
	<?php require('header.php'); ?>
	<br><br>
	<a href="data.php"> tagasi </a>

	<h2>Muuda </h2>
	 <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
				<input type="hidden" name="id" value="<?=$_GET["id"];?>" > 
				<label for="date">Kuu</label>
				<input id="date" type="month" name="mdate" value=<?=$s->date;?>>
				<br><br>				
				<label for="monthsalary" >Task</label><br>
				<input id="task" name="task" type="text" value=<?=$s->task;?>>
				<br><br>				
				<input type="submit" name="update" value="Salvesta">
				<input type="submit" name="delete" value="Kustuta">
	</form>
	  
	 <?php require('footer.php'); ?>