<html>
<head>
<style>

	body {
		margin: 0;
	}

	ul {
		list-style-type: none;
		margin: 0px;
		padding: 0;
		width: 22%;
		background-color: #A1CE52;
		position: fixed;
		height: 100%;
		overflow: auto;
		border-right: 15px solid #F3F3F3;
	}

	li a {
		display: block;
		color: #000;
		padding: 16px 16px;
		text-decoration: none;
	}

	li a.active {
		background-color: #F3F3F3;
		color: black ;
	}

	li a.active1 {
		background-color: #8FC132;
		color: white ;
		border-bottom: 2px solid #ADCC70;
	}

	li a:hover:not(.active) {
		background-color: #F3F3F3;
		color: black;
	}

	table, td, th {
		border: 1px solid grey;
	}

	table {
		border-collapse: collapse;
		width: 100%;
		
	}
	
	tr:nth-child(even){background-color: #f3f3f3}

	th {
		height: 50px;
		text-align: center;
		background-color: #8FC132 ;
		color: white;
	}
	
	p.down {
		border-bottom: 1px solid black;
		font-size: 20px;
	}
	
	p {font-family:  Futura, "Trebuchet MS", Arial, sans-serif;}
	
	div[style=page] {
		margin-left:25%;
		padding:16px 16px;
		height:1000px;
	}
	
	div[class=login] {
		border: 2px solid rgba(255, 255, 255, 0.2) ;
		border-radius: 15px 50px;
		padding: 20px;
		background: rgba(255, 255, 255, 0.3);
		width: 35%;
		margin: 15%;
	}
	
	table.table1, table.table1 td, table.table1 th {
		border: 1px solid white;
		text-align: center;
	}
	
	.submit2 {
		width: 50%;
		height: 50px;
		background-color: #8FC132;
		border: 1px solid #8FC132;
		color: white;
		text-align: center;
		text-decoration: none;
		display: inline-block;
		font-size: 16px;
		margin: 4px 2px;
		-webkit-transition-duration: 0.4s; /* Safari */
		transition-duration: 0.4s;
		cursor: pointer;
		border-radius: 12px;
	}			

	.submit2 {
		background-color: #8FC132; 
		color: white; 
	}

	.submit2:hover {
		background-color: #E6E6E6;
		color: black;
	}
	
	.submit {
		width: 50%;
		height: 50px;
		background-color: #AA7CFF;
		border: 1px solid #ADADAD;
		color: white;
		text-align: center;
		text-decoration: none;
		display: inline-block;
		font-size: 16px;
		margin: 4px 2px;
		-webkit-transition-duration: 0.4s; /* Safari */
		transition-duration: 0.4s;
		cursor: pointer;
		border-radius: 12px;
	}			

	.submit1 {
		background-color: white; 
		color: black; 
	}

	.submit1:hover {
		background-color: #E6E6E6;
		color: black;
	}
	
	input[class=text],select {
		width: 60%;
		padding: 12px 20px;
		margin: 8px 0;
		display: inline-block;
		border: 1px solid #ccc;
		border-radius: 4px;
		box-sizing: border-box;
	}
	
</style>
</head>