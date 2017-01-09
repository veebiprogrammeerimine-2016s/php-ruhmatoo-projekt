<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>izipäevik</title>

    <!-- Jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- CSS -->
    <link href="../css/signin.css" rel="stylesheet">
    <link href="../css/site.css" rel="stylesheet">

</head>
<body>
<div class="container-fluid">
    <!-- Static navbar -->
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                        aria-expanded="false" aria-controls="navbar">
                </button>
                <a class="navbar-brand" href="../index.php">Izipäevik</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li><a href="homework.php">Kodused tööd</a></li>
                    <li><a href="curriculum.php">Tunniplaan</a></li>
                </ul>
                <!-- Navbar right side -->
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="admin.php">Admin</a></li>
                    <?php if (isset($_SESSION["userId"])) {
                        echo('
                           <li><a href="../scraper/scraper.php">Scraper</a> </li>
                           <li><a href = "?logout=1" > Logout</a ></li >
                           ');
                    }
                    ?>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>