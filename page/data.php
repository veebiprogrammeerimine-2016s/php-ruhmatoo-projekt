<?php 

	//GREG EI OSKA GITI KASUTADA
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
			
			if($stmt->fetch()) {
				//sai ühe rea
				echo '{"success": false, "message":"juba olemas"}';
				exit();
			} else {
	
				$stmt->close();
				
				$stmt = $mysqli->prepare("
			
				INSERT INTO ratings(user_id, pic_id) 
				VALUES (?,?)");
				echo $mysqli->error;
				$stmt->bind_param("ii", $_SESSION["userId"],$_GET["addRate"]);
				$stmt->execute();
			
				$stmt->close();
				$stmt = $mysqli->prepare("
			
				UPDATE submissions set rating=(rating+1) where id=(?)");
				echo $mysqli->error;
				$stmt->bind_param("i", $_GET["addRate"]);
				$stmt->execute();
			
				echo '{"success": true, "message":"Aitäh hinnangu eest"}';
				exit();
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
		//SEE SIIN VIRISEB KUI LIIGA PALJU KERID
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
				$('.loading-info').html("jõudsid lõppu :(");
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

/* ADD RATING*/
function addRating(el){
	
	console.log(el);
	
	var id = el.dataset.id;
	
	$.get( "data.php?addRate="+id, function( data ) {
		
	var result = JSON.parse(data);
	console.log(result);
	  if(result.success){
		  
		  el.className += " rated";
		  console.log(el.querySelector(".counter"));
		  var count = el.querySelector(".counter").innerHTML;
		  count = parseInt(count) + 1;
		  el.querySelector(".counter").innerHTML = count;
		  
		  console.log(el.querySelector(".counterstring"));
		  var count1 = el.querySelector(".counterstring").innerHTML;
		  
		  if(count>1) {
			  var count1 = " punkti";
			  el.querySelector(".counterstring").innerHTML = count1;
		  } else {
			  var count1 = " punkt";
			  el.querySelector(".counterstring").innerHTML = count1;
		  }
			
		  /*
		  var p = document.createElement("p");
		  p.innerHTML = result.message;
		  el.appendChild(p);
		  
		  window.setTimeout(function(){
			  el.removeChild(p);
		  },1000);
		  */
	  }else{
		  //ei õnnestunud

		  /*
		  
		  el.className += " rated";
		  console.log(el.querySelector(".counter"));
		  
		  var p = document.createElement("p");
		  p.innerHTML = result.message;
		  el.appendChild(p);
		  
		  window.setTimeout(function(){
			  el.removeChild(p);
		  },1000);
		  */
	  }
	}); 
}

</script>


<div class="container">
	<div class="wrapper">
	<div class="col-lg-6">
		<ul id="results"><!-- results appear here --></ul>
		<br>
		<br>
		<br>
		<div class="loading-info"><img src="LoaderIcon.gif" /></div>
		<div class="load-more"></div>
		<br>
		<br>
		<br>
	</div>
	</div>
</div>


<div class="col-lg-4 col-lg-offset-8">
	<div class="reklaamid">
	
		<a href="http://www.tlu.ee"><img src="tlu.jpg" style="padding: 30px; border:1px solid;"></a>
	</div>
</div>



<!--
<div class="search">
	<form class="navbar-form navbar-middle" method="GET">
    <div class="input-group">
      <input type="text" name="searchPost" class="form-control" placeholder="ei leia midagi?" value="<?=$search;?>">
      <span class="input-group-btn">
        <button class="btn btn-default" type="submit">otsi</button>
      </span>
    </div>
	</form>
</div>
-->




<?php //echo$_SESSION["userEmail"];?>

<?//=$_SESSION["userEmail"];?>




<?php require("../footer.php"); ?>