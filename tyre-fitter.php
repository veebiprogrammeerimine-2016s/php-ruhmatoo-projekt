<?php

require("functions.php");
require("classes/tyrefitting_class.php");
$TyreFitting = new TyreFitting($mysqli);

if (!isset($_SESSION["userId"])){
    header("Location: index.php");
    exit();
}

if (isset($_GET["logout"])) {
    session_destroy();
    header("Location: index.php");
    exit();
}

$fitterId = "";

if (isset($_GET["id"])) {
    $fitterId = $_GET["id"];
}

$TyreFitting = new TyreFitting($mysqli);
$tyreFittingServices = $TyreFitting->getTyreFitterServices($fitterId);

echo $fitterId;

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
        <div class="col-md-offset-6 col-md-6">
            <button data-id="<?php echo $fitterId; ?>" type="button" id="profile" class="btn btn-primary">
                Muuda profiili
            </button>

            <button data-id="<?php echo $fitterId; ?>" type="button" id="newService" class="btn btn-primary">
                Lisa teenus
            </button>
        </div>
    </div>

    <div class="row" style="margin-top:40px;">
        <div class="col-md-12">
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Nimi</th>
                    <th>Hind</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php
                $html = "";
                if ($tyreFittingServices != null) {
                    foreach ($tyreFittingServices as $key => $service) {
                        $key+=1;
                        $html .= "<tr>";
                        $html .= "<td>".$key."</td>";
                        $html .= "<td>".$service->name."</td>";
                        $html .= "<td>".$service->price."</td>";
                        $html .= "<td data-id='$service->id'><i class='fa fa-gear'></i></td>";
                        $html .= "<td data-id='$service->id'><i class='fa fa-trash-o'></i></td>";
                        $html .= "</tr>";
                    }
                } else {
                    $html .= "<tr><td style='text-align: center' colspan='5'>Teil ei ole ühtegi teenust</td></tr>";
                }
                echo $html;
                ?>
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
            window.location.href = "editTyreFitterService.php?service=" + $(this).parent().data('id');
        });

        $('#newService').click(function () {
            window.location.href = "tyre-fitter-service.php?id=" + $(this).data('id');
        });

        $('#profile').click(function () {
            window.location.href = "editTyreFitter.php?id=" + $(this).data('id');
        });

        $('.fa-trash-o').click(function (e) {
            bootbox.confirm('Are you sure?', function (resonse) {

            });
        });
    });
</script>
</body>
</html>

