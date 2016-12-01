<?php
  require "../parts/header.php";
?>

<body>
  <!-- Static navbar -->
  <nav class="navbar navbar-default navbar-static-top">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        </button>
        <a class="navbar-brand" href="../index.php">Izipäevik</a>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
          <li class="active"><a href="#">Kodused tööd</a></li>
          <li><a href="curriculum.php">Tunniplaan</a></li>
        </ul>
      </div><!--/.nav-collapse -->
    </div>
  </nav>

  <div class="container-fluid">
    <!-- Calendar -->
    <div class="embed-responsive embed-responsive-16by9">
    <iframe class="embed-responsive-item" src="https://calendar.google.com/calendar/embed?showTitle=0&amp;showCalendars=0&amp;mode=AGENDA&amp;height=600&amp;wkst=2&amp;hl=en&amp;bgcolor=%23FFFFFF&amp;src=lrc1ripknfche4b23bk8l0usio%40group.calendar.google.com&amp;color=%23B1365F&amp;ctz=Europe%2FTallinn" style="border-width:0" width="800" height="600" frameborder="0" scrolling="no"></iframe>
    </div>
  </div>

</body>

<?php require "../parts/footer.php";?>