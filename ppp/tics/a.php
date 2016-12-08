<?php 
session_start();
if(isset($_POST["number"])&&isset($_POST["num_of"])){
$_SESSION['tics']=$_POST["number"];//изменяемое кол-во спичек
$_SESSION['tics0']=$_POST["number"];//изначальное кол-во спичек
$_SESSION['tics2']=$_POST["num_of"];//колво спичек за раз
$_SESSION['turn']=$_POST['choise'];
$_SESSION['level']=$_POST["level"];}
?>
<!DOCTYPE html> 
<html> 
<head> 
	<meta charset="UTF-8"> 
	<title>Home Page</title> 
</head> 
<body> 
<?php


if (isset($_POST["radio_num"])){
$_SESSION['tics']=$_SESSION['tics']-$_POST["radio_num"];

if($_SESSION['turn']==1)
$_SESSION['turn']=2;
else
$_SESSION['turn']=1;
}

echo "Уровень:";
if($_SESSION['level']==1)
echo " легкий<br>";
if($_SESSION['level']==2)
echo " средний<br>";
if($_SESSION['level']==3)
echo " сложный<br>";

for($i=1;$i<=$_SESSION['tics'];$i++){
echo "<img height='200' src='img/match1.png'>";
}

for($b=1;$b<=$_SESSION['tics0']-$_SESSION['tics'];$b++){
if($b<=$_SESSION['tics0'])
echo "<img height='200' src='img/match2.png'>";
}


echo "Кол-во спичек: ".($i-1)."<br>";

if($_SESSION['tics']<=0){
if($_SESSION['turn']==2)
echo "<h1 style='color:red'>Ты проиграл!</h1>";
else
echo "<h1 style='color:green'>Ты победил!</h1>";
}
else{


if($_SESSION['turn']==1){
if($_SESSION['level']==1)
$c=rand(1, $_SESSION['tics2']);
if($_SESSION['level']==2){
$cc=rand(1,2);
if($cc=1)
$c=rand(1, $_SESSION['tics2']);
else{
$c=$_SESSION['tics']%($_SESSION['tics2']+1);
if($c==0)
$c=rand(1, $_SESSION['tics2']);
}}
if($_SESSION['level']==3){
$c=$_SESSION['tics']%($_SESSION['tics2']+1);
if($c==0)
$c=rand(1, $_SESSION['tics2']);
}

echo "Ход компьютера";
echo "<form action='a.php' method='POST'>";
for($a=1;$a<=$_SESSION['tics2'];$a++){
echo $a;
if($a==$c){
echo " <input checked  type='radio' name='radio_num' value='$a'><br>";
}
else
echo " <input type='radio' disabled name='radio_num' value='$a'><br>";
}
echo "<input type='submit' value='OK'>";
echo "</form><br>";}

else {
echo "Ход игрока";
echo "<form action='a.php' method='POST'>";
for($a=1;$a<=$_SESSION['tics2'];$a++){
echo $a;
echo " <input type='radio' name='radio_num' value='$a'><br>";
}
echo "<input type='submit' value='OK'>";
echo "</form><br>";}
}
//else

echo "<form action='.\'><button type='submit'>Back</button></form>";

?>
</body> 
</html>
