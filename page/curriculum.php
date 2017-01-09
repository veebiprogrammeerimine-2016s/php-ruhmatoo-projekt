<?php

require("../functions.php");

// Logout
if (isset($_GET["logout"])) {
    session_destroy();
    header("Location: admin.php");
    exit();
}

?>
<?php require "../parts/header.php"; ?>

        <!-- Dropdown for Table -->
        <div class="dropdown">
            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="true">
                Vali rühm
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                <li><a href="curriculum.php?ryhm=1">1-rühm</a></li>
                <li><a href="curriculum.php?ryhm=2">2-rühm</a></li>
                <li><a href="curriculum.php?ryhm=3">3-rühm</a></li>
                <li><a href="curriculum.php?ryhm=4">4-rühm</a></li>
            </ul>
        </div>
        <br>

        <?php
        if (isset($_GET["ryhm"])) {
            if ($_GET["ryhm"] == 1) {
                echo "
                <div class=\"container-fluid\">
                    <div class=\"embed-responsive embed-responsive-16by9\">
                        <iframe src=\"https://calendar.google.com/calendar/embed?src=uedj1kpngtked4occukic6h89s%40group.calendar.google.com&ctz=Europe/Tallinn\" 
                        style=\"border: 0\" width=\"800\" height=\"600\" frameborder=\"0\" scrolling=\"no\"></iframe>              
                    </div>
                </div>
            ";
            } else if ($_GET["ryhm"] == 2) {
                echo "
                <div class=\"container-fluid\">
                    <div class=\"embed-responsive embed-responsive-16by9\">
                        <iframe src=\"https://calendar.google.com/calendar/embed?src=907ppl76mvkb7l1dclbq0pqljc%40group.calendar.google.com&ctz=Europe/Tallinn\"
                        style=\"border: 0\" width=\"800\" height=\"600\" frameborder=\"0\" scrolling=\"no\"></iframe>              
                    </div>
                </div>
            ";
            } else if ($_GET["ryhm"] == 3) {
                echo "
                <div class=\"container-fluid\">
                    <div class=\"embed-responsive embed-responsive-16by9\">
                        <iframe src=\"https://calendar.google.com/calendar/embed?src=8ib6r0h4in7m1a24cqobqp109o%40group.calendar.google.com&ctz=Europe/Tallinn\" 
                        style=\"border: 0\" width=\"800\" height=\"600\" frameborder=\"0\" scrolling=\"no\"></iframe>             
                    </div>
                </div>
             ";
            } else if ($_GET["ryhm"] == 4) {
                echo "
                <div class=\"container-fluid\">
                    <div class=\"embed-responsive embed-responsive-16by9\">
                        <iframe src=\"https://calendar.google.com/calendar/embed?src=nhbecorj0k810lsi65p0ktdck0%40group.calendar.google.com&ctz=Europe/Tallinn\" 
            style=\"border: 0\" width=\"800\" height=\"600\" frameborder=\"0\" scrolling=\"no\"></iframe>             
                    </div>
                </div>
            ";
            }
        }
        ?>


    </div>

<?php require "../parts/footer.php"; ?>