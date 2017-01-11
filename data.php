<?php
    require("functions.php");
    require("classes/tyrefitting_class.php");

    if (!isset($_SESSION["userId"])){
            header("Location: index.php");
            exit();
        }

    if (isset($_GET["logout"])) {
            session_destroy();
            header("Location: index.php");
            exit();
        }

    $TyreFitting = new TyreFitting($mysqli);
    $tyreFittings = $TyreFitting->getTyreFittingsByOwnerId($_SESSION["userId"]);

    if (isset($_GET['delete'])) {
        $deleteID = $_GET['delete'];
        $delteQuery = new TyreFitting($mysqli);
        $deleted = $delteQuery->removeTyreFitter($deleteID);
        if ($deleted == "ok") {
            header("Refresh:0");
        }
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

        <div class="row" style="margin-bottom: 50px;">
            <div class="col-md-offset-8 col-md-4">
                <a href="addNewTyreFitter.php" type="button" class="btn btn-primary" style="float: right">Add new</a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <table class="table table-sm">
                    <thead>
                        <th>#</th>
                        <th>Name</th>
                        <th colspan="2"></th>
                    </thead>
                    <tbody>
                        <?php
                        $html = "";
                        if ($tyreFittings != null) {
                            foreach ($tyreFittings as $key => $tyreFitting) {
                                $key+=1;
                                $html .= "<tr>";
                                $html .= "<td>".$key."</td>";
                                $html .= "<td>".$tyreFitting->name."</td>";
                                $html .= "<td data-id='$tyreFitting->id'><i class='fa fa-gear'></i></td>";
                                $html .= "<td data-id='$tyreFitting->id'><i class='fa fa-trash-o'></i></td>";
                                $html .= "</tr>";
                            }
                        } else {
                            $html .= "<tr><td style='text-align: center' colspan='4'>Teil ei ole ühtegi rehvivahetus punkti</td></tr>";
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
                var id = $(this).parent().data('id');
                window.location.href = "tyre-fitter.php?id=" + id;
            });

            $('.fa-trash-o').click(function (e) {
                var id = $(this).parent().data('id');
                bootbox.confirm('Are you sure?', function (resonse) {
                    if (resonse) {
                        $.get("data.php?delete=" + id);
                    }
                });
            });

        });
    </script>
</body>
</html>