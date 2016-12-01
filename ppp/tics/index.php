<!DOCTYPE html> 
<html> 
<head> 
	<meta charset="UTF-8"> 
	<title>Home Page</title> 
</head> 
<body> 
<form action="a.php" method="POST">
Количество спичек на столе: <input type="text" value="15" name="number"><br><br>
Количество спичек за раз: <input type="radio" name="num_of" value="3" checked>
3
<input type="radio" name="num_of" value="4">
4
<input type="radio" name="num_of" value="5">
5<br><br>
Первый ход: <input type="radio" name="choise" value="1">
Компьютер
<input type="radio" name="choise" value="2" checked>
Игрок<br><br>
Уровень:<input type="radio" name="level" value="1" checked>
Легкий
<input type="radio" name="level" value="2">
Средний
<input type="radio" name="level" value="3">
Сложный<br><br>
<input type="submit" name="button" value="OK">
</form>
</body> 
</html>
