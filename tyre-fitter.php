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
    <title>Tyre fitter</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css"
          integrity="sha384-y3tfxAZXuh4HwSYylfB+J125MxIs6mR5FOHamPBG064zB+AFeWH94NdvaCBm8qnd"
          crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/tyre-fitter.css">
</head>
<body>
<?php require("office-nav.php") ?>

<div class="container" style="margin-top:150px;">
    <div class="row">
        <div class="col-md-offset-8 col-md-4">
            <button type="button" class="btn btn-primary">
                Profile
            </button>

            <button type="button" id="newService" class="btn btn-primary">
                New service
            </button>
        </div>
    </div>

    <div class="row">

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
        $('#newService').click(function () {
            $.ajax({
                type: 'GET',
                url: 'tyre-fitter-service.php',
                success: function (data) {
                    bootbox.dialog({
                        title: 'Add new tyre fitting service',
                        message: data,
                        buttons: {
                            confirm: {
                                label: 'Lisa',
                                className: 'btn btn-success'
                            }
                        }
                    })
                }

            });
        });

    });
</script>
</body>
</html>

