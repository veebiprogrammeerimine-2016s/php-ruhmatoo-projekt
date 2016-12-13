<?php

require("functions.php");

if (!isset($_SESSION["userId"])){
		header("Location: index.php");
		exit();
	}

if (isset($_GET["logout"])) {
		session_destroy();
		header("Location: index.php");
		exit();
	}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Personal cabinet</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css"
          integrity="sha384-y3tfxAZXuh4HwSYylfB+J125MxIs6mR5FOHamPBG064zB+AFeWH94NdvaCBm8qnd"
          crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/office.css">
</head>
<body>
    <?php require("office-nav.php") ?>

    <div class="container" style="margin-top:150px;">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-sm">
                    <thead>
                        <th>#</th>
                        <th>Name</th>
                        <th>Working time</th>
                        <th colspan="2"></th>
                    </thead>
                    <tbody>
                        <td>1</td>
                        <td>Sample tire fitter name</td>
                        <td>8:00-20:00</td>
                        <td><i class="fa fa-gear"></i></td>
                        <td><i class="fa fa-trash-o"></i></td>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <?php require("office-footer.php") ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/js/bootstrap.min.js"
            integrity="sha384-vZ2WRJMwsjRMW/8U7i6PWi6AlO1L79snBrmgiDpgIWJ82z8eA5lenwvxbMV1PAh7"
            crossorigin="anonymous"></script>
    <script src="https://use.fontawesome.com/330cd91718.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>
    <script>
        $(function () {
            $('.fa-gear').click(function (e) {
                window.location.href = "tyre-fitter.php?id=1";
            });

            $('.fa-trash-o').click(function (e) {
                bootbox.confirm('Are you sure?', function (resonse) {
                    console.log(resonse);
                });
            });

        });
    </script>
</body>
</html>