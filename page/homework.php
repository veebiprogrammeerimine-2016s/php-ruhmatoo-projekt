<?php require "../parts/header.php"; ?>

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
                    <li class="active"><a href="#">Kodused tööd</a></li>
                    <li><a href="curriculum.php">Tunniplaan</a></li>
                </ul>
                <!-- Navbar right side -->
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="admin.php">Admin</a></li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>

    <!-- Dropdown for Calendar -->
    <div class="dropdown">
        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="true">
            Vali rühm
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
            <li><a href="homework.php?ryhm=1">1-rühm</a></li>
            <li><a href="homework.php?ryhm=2">2-rühm</a></li>
            <li><a href="homework.php?ryhm=3">3-rühm</a></li>
            <li><a href="homework.php?ryhm=4">4-rühm</a></li>
        </ul>
    </div>
    <br>

    <!-- Calendar 1-rühm -->
    <?php if (isset($_GET["ryhm"]) && $_GET["ryhm"] == 1) {
        echo('
    <div class="container-fluid">
      <div class="embed-responsive embed-responsive-16by9">
        <iframe src="https://calendar.google.com/calendar/embed?title=Kodused%20t%C3%B6%C3%B6d%201-r%C3%BChm&amp;showCalendars=0&amp;height=600&amp;wkst=2&amp;hl=en&amp;bgcolor=%23ffffff&amp;src=lrc1ripknfche4b23bk8l0usio%40group.calendar.google.com&amp;color=%23B1365F&amp;ctz=Europe%2FTallinn" style="border-width:0" width="800" height="600" frameborder="0" scrolling="no"></iframe>
      </div>
    </div>
  ');
    }
    ?>
    <!-- Calendar 2-rühm -->
    <?php if (isset($_GET["ryhm"]) && $_GET["ryhm"] == 2) {
        echo('
    <div class="container-fluid">
      <div class="embed-responsive embed-responsive-16by9">
        <iframe src="https://calendar.google.com/calendar/embed?title=Kodused%20t%C3%B6%C3%B6d%202-r%C3%BChm&amp;showCalendars=0&amp;height=600&amp;wkst=2&amp;hl=en&amp;bgcolor=%23FFFFFF&amp;src=kskquvaj53cl1ackg5fronlm6o%40group.calendar.google.com&amp;color=%23B1365F&amp;ctz=Europe%2FTallinn" style="border-width:0" width="800" height="600" frameborder="0" scrolling="no"></iframe>
      </div>
    </div>
  ');
    }
    ?>
    <!-- Calendar 3-rühm -->
    <?php if (isset($_GET["ryhm"]) && $_GET["ryhm"] == 3) {
        echo('
    <div class="container-fluid">
      <div class="embed-responsive embed-responsive-16by9">
        <iframe src="https://calendar.google.com/calendar/embed?title=Kodused%20t%C3%B6%C3%B6d%203-r%C3%BChm&amp;showCalendars=0&amp;height=600&amp;wkst=2&amp;hl=en&amp;bgcolor=%23FFFFFF&amp;src=johlvvmjin9qok97ga749urm0k%40group.calendar.google.com&amp;color=%23B1365F&amp;ctz=Europe%2FTallinn" style="border-width:0" width="800" height="600" frameborder="0" scrolling="no"></iframe>
      </div>
    </div>
  ');
    }
    ?>
    <!-- Calendar 4-rühm -->
    <?php if (isset($_GET["ryhm"]) && $_GET["ryhm"] == 4) {
        echo('
    <div class="container-fluid">
      <div class="embed-responsive embed-responsive-16by9">
        <iframe src="https://calendar.google.com/calendar/embed?title=Kodused%20t%C3%B6%C3%B6d%204-r%C3%BChm&amp;showCalendars=0&amp;height=600&amp;wkst=2&amp;hl=en&amp;bgcolor=%23FFFFFF&amp;src=krh0pkstlghhlqlninmqmqpn14%40group.calendar.google.com&amp;color=%23B1365F&amp;ctz=Europe%2FTallinn" style="border-width:0" width="800" height="600" frameborder="0" scrolling="no"></iframe>
      </div>
    </div>
  ');
    }
    ?>

</div>

<?php require "../parts/footer.php"; ?>