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
            <button type="button" id="profile" class="btn btn-primary">
                Profile
            </button>

            <button type="button" id="newService" class="btn btn-primary">
                New service
            </button>
        </div>
    </div>

    <div class="row" style="margin-top:20px;">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nimi</th>
                    <th>Kategooria</th>
                    <th>Hind</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
                <tr>
                    <td>1</td>
                    <td>Rehvivahetus</td>
                    <td>Plekkvelg</td>
                    <td>30</td>
                    <td><i class="fa fa-gear"></i></td>
                    <td><i class="fa fa-trash-o"></i></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Rehvivahetus</td>
                    <td>Valuvelg</td>
                    <td>35</td>
                    <td><i class="fa fa-gear"></i></td>
                    <td><i class="fa fa-trash-o"></i></td>
                </tr>
            <tbody>

            </tbody>
        </table>
    </div>

</div>

<!--+-----------------+---------------+------+-----+---------+----------------+
| Field           | Type          | Null | Key | Default | Extra          |
+-----------------+---------------+------+-----+---------+----------------+
| id              | int(11)       | NO   | PRI | NULL    | auto_increment |
| name            | varchar(30)   | YES  |     | NULL    |                |
| description     | text          | YES  |     | NULL    |                |
| category        | varchar(30)   | YES  |     | NULL    |                |
| size            | float         | YES  |     | NULL    |                |
| price           | decimal(10,0) | YES  |     | NULL    |                |
| tyre_fitting_id | int(11)       | YES  | MUL | NULL    |                |
+-----------------+---------------+------+-----+---------+----------------+-->



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

        $('#profile').click(function () {
            $.ajax({
                type: 'GET',
                url: 'tyre-fitting-profile.php',
                success: function (data) {
                    bootbox.dialog({
                        title: 'Edit profile',
                        message: data,
                        buttons: {
                            confirm: {
                                label: 'Edit',
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

