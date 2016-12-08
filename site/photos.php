<?php
$dir = opendir("./photos");
while($file = readdir ($dir)){
	$ext = end(explode(".",$file));
	if($ext=="jpg" || $ext== "gif"){
		//echo "<img src='photos/".$file."' width='300' ><br />" ;
	$massive[] = $file; 
		}}
if(isset($_GET['f']))
	$page = $_GET['f'];
else 
	$page = 1;

	$number_pics = 6;
	$pages = ceil( count($massive)/$number_pics);

	if(count($massive)%$number_pics > 0 && $pages == $page) {
	$end_pic = count($massive);}
else
	$end_pic = $page * $number_pics;

	$end_pic1 = $page * $number_pics;

	echo '<table class="photos">';
	for($i=$end_pic1-$number_pics;$i< $end_pic; $i++){
	if($i%3==0)
	echo "<tr>";
	
	echo '<td><a class="group1" href="photos/'.$massive[$i].'" title="Me and my grandfather on the Ohoopee."><img src="photos/'.$massive[$i].'" width="300"></a></td>';
	
	if(($i+1)%3==0)
	echo "</tr>";
	}
	
	echo "<tr> <td colspan='3'> <table> <tr> <td>"; for ($i=1; $i <= $pages; $i++){
	echo "<td><a href='?p=2&f=".$i."'>".$i."</a></td>";
	}
	echo "<td> </tr></table> </td> </tr>";
	
		/*
		echo '<tr><td><a class="group1" href="photos/ohoopee1.jpg" title="Me and my grandfather on the Ohoopee."><img src="photos/ohoopee1.jpg" width="300"></a></td>';

		echo '<td><a class="group1" href="photos/ohoopee2.jpg" title="On the Ohoopee as a child"><img src="photos/ohoopee2.jpg" width="300"></a></td>';

		echo '<td><a class="group1" href="photos/ohoopee3.jpg" title="On the Ohoopee as an adult"><img src="photos/ohoopee3.jpg" width="300"></a></td></tr>';

		echo '<tr><td><a class="group1" href="photos/CincinnatiMen.jpg" title="On the Ohoopee as an adult"><img src="photos/CincinnatiMen.jpg" width="300"></a></td>';

		echo '<td><a class="group1" href="photos/05213u_0_0.jpg" title="On the Ohoopee as an adult"><img src="photos/05213u_0_0.jpg" width="300"></a></td>';

		echo '<td><a class="group1" href="photos/photoharwood.gif" title="On the Ohoopee as an adult"><img src="photos/photoharwood.gif" width="300"></a></td></tr>';*/
echo '</table>'; 
closedir($dir);
?>