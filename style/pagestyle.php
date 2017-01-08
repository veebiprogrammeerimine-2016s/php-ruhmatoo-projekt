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

	th {
		height: 50px;
		text-align: center;
		background-color: #8FC132 ;
		color: white;
	}
	
	p.down {
		border-bottom: 1px solid black;
		font-size: 24px;
	}
	
	div[style=page] {
		margin-left:25%;
		padding:16px 16px;
		height:1000px;
	}
	
	table.table1, table.table1 td, table.table1 th {
		border: 1px solid white;
		text-align: center;
	}
	
	.submit2 {
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
		border-radius: 4px;
	}			

	.submit2 {
		background-color: #8FC132; 
		color: white; 
	}

	.submit2:hover {
		background-color: #E6E6E6;
		color: black;
	}
	
</style>
</head>