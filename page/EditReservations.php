<?php
	
	require("../Functions.php");
	require("../../../config.php");
	require("../Header.php");

	$Reservation = GetAllReservations();

?>
<section>


</section>

<div class="container">
	<div class="row">
		<div class="col-lg-8 col-lg-offset-2">
<?php

	$html = "<table class='table-bordered'>";
		
		$html .="<tr>";
		
			$html .="<th>id</th>";
			$html .="<th>Regnr</th>";
			$html .="<th>Tüüp</th>";
			$html .="<th>Mark</th>";
			$html .="<th>Mudel</th>";
			$html .="<th>Telefon</th>";
			$html .="<th>Kuupäev</th>";
			$html .="<th>Kellaaeg</th>";

		$html .="</tr>";
		
	foreach($Reservation as $r) {
		
		$html .="<tr>";
			$html .="<td>".$r->id."</td>";
			$html .="<td>".$r->reg_nr."</td>";
			$html .="<td>".$r->veichle_type."</td>";
			$html .="<td>".$r->car_brand."</td>";
			$html .="<td>".$r->car_model."</td>";
			$html .="<td>".$r->telephone_nr."</td>";
			$html .="<td>".$r->r_date."</td>";
			$html .="<td>".$r->r_time."</td>";
			$html .="<td><a href='EditReservations2.php?id=".$r->id."'><span class='glyphicon glyphicon-pencil'><span> Delete</a></td>";
		$html .="</tr>";
			
		
	}
	
	$html .="</table>";
	
	echo $html;


?>

<br><br>

<a class="btn btn-primary" href="index.html">Avaleht</a>
<a class="btn btn-primary" href="Reservations.php">Tagasi Broneerima</a><br>

		</div>
	</div>
</div>