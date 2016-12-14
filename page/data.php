<?php 
	//ühendan sessiooniga
	//kuradi git ma ütlen!
	require("../functions.php");

	//kui ei ole sisseloginud, suunan login lehele
	if (!isset($_SESSION["userId"])) {
		header("Location: index.php");
		exit();
	}
	
	//kas aadressireal on logout
	if (isset($_GET["logout"])) {
		
		session_destroy();
		
		header("Location: ../index.php");
		exit();
		
	}
	//header("Location: ../data.php");
	
	$search ="";
	
	if (isset($_GET["searchPost"]) && !empty($_GET["searchPost"])){
		
		//header("Location: data.php?search=".$_GET["searchPost"]);
		//echo "test";
		$search= $_GET["searchPost"];
		
	}
	
	
	if (isset($_GET["addRate"])){
		
			$stmt = $mysqli->prepare("SELECT user_id FROM ratings WHERE user_id=? AND pic_id=?");
			echo $mysqli->error;
			$stmt->bind_param("ii", $_SESSION["userId"], $_GET["addRate"]);
			$stmt->execute();
			
			if($stmt->fetch()){
				//sai ühe rea
				echo "juba olemas";
			}else{
				
				$stmt->close();
				
				$stmt = $mysqli->prepare("
			
				INSERT INTO ratings(user_id, pic_id) 
				VALUES (?,?)");
				echo $mysqli->error;
				$stmt->bind_param("ii", $_SESSION["userId"],$_GET["addRate"]);
				$stmt->execute();
			
				$stmt->close();
				$stmt = $mysqli->prepare("
			
				INSERT INTO submissions(rating) 
				VALUES (rating+1)");
				echo $mysqli->error;
				$stmt->execute();
			
				echo "Aitäh hinnaguu eest";
			}
		
		
			

	}else{

		//echo "katki";
		
	}

?>
<?php require("../header.php"); ?>

<script type="text/javascript" src="js/jquery.infinitescroll.min.js"></script>
<script type="text/javascript">
<?php
	if($search != ""){
		echo "var search = '&search=".$search."';";
	}else{
		echo "var search = '';";
	}
?>
$(function() {
	//alert("siin");
	var track_page = 1; //track user scroll as page number, right now page number is 1
	var limit_page=5;
	var loading  = false; //prevents multiple loads
	var window_height = window.innerHeight;
	load_contents(track_page); //initial content load
	$('.load-more').hide();
	
	
	
	$('.load-more').on("click", function(){
		$("#results").empty();
		$('.loading-info').show();
		$('.load-more').hide();
		track_page++; //page number increment
		load_contents(track_page); //load content
	});

	$(window).scroll(function() { //detect page scroll
		if(loading == false){
			if($(window).scrollTop() + $(window).height() >= $(document).height() - window.innerHeight) { //if user scrolled to bottom of the page
				// 2 / 2
				// 4 / 2 jääk on 
				//console.log(track_page);
				//console.log(limit_page);
				if(track_page % limit_page != 0){
					track_page++; //page number increment
					load_contents(track_page); //load content   
				}else{
					$('.load-more').show();
					
				}
			}
		}
	});     
	//Ajax load function
	function load_contents(track_page){
		/*
		
		SEE SIIN VIRISEB KUI LIIGA PALJU KERID
		if(track_page%2==0){
			alert("Olen kerinud "+track_page+" lehekülge, äkki aitab ?");
		}
		*/
		loading = true;  //set loading flag on
		$('.loading-info').show(); //show loading animation 
		$.get( 'getDataPerPage.php?page='+track_page + search, function(data){
			 //set loading flag off once the content is loaded
			if(data.trim().length == 0){
				//notify user if nothing to load
				$('.loading-info').html("No more records!");
				return;
			}
			
			if(track_page != 1){
				window.setTimeout(function(){
					console.log("here");
					$("#results").append(data); //append data into #results element
					$('.loading-info').hide(); //hide loading animation once data is received
					loading = false;

				}, 1000);
			} else {
				$("#results").append(data); //append data into #results element
				$('.loading-info').hide(); //hide loading animation once data is received
				loading = false;
			}
			
		
		}).fail(function(xhr, ajaxOptions, thrownError) { //any errors?
			alert(thrownError); //alert with HTTP error
		})
	}
});
</script>


<div class="container">
	<div class="page-header">
		<h1>Latest posts</h1>
	</div>
	<p class="lead"></p>
	<div class="wrapper">
		<ul id="results"><!-- results appear here --></ul>
		<br>
		<br>
		<br>
		<div class="loading-info"><img src="LoaderIcon.gif" /></div>
		<div class="load-more">Lae veel</div>
		
		<br>
		<br>
		<br>
	</div>

</div>







<?php //echo$_SESSION["userEmail"];?>

<?//=$_SESSION["userEmail"];?>




<?php require("../footer.php"); ?>