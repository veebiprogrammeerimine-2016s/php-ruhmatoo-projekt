<?php
require("header.php");
?>
<div class="header"><?php echo $appName;?>
<div style="display: inline-block; margin-left: 1em; float:right; height: 2em; vertical-align: middle;">
<form style="float:left; font-size: 0.5em; margin: 0;">
<input type="text" name="search" placeholder="Otsi...">
<input type="submit"  value="Otsi">

</form>
<a class="button" href="login.php" style="float: right; font-size: 20px;" >Logi sisse</a>
</div>
</div>

<div class="row">

<div class="c-3" style="border: 2px solid gray; border-top: 0; border-left: 0;">
<h3 style="margin-top: 0; margin-bottom: 0;">Sorteeri</h3>
<form>
<h6>Linnaosa</h6>
<input type="text" placeholder="Kesklinn" style="width: 100%;" name="district">
<h6>Oskused</h6>
<input type="checkbox" name="builder" value="yes"> Ehitaja <br>
<input type="checkbox" name="pipe" value="yes"> Torumees <br>
<input type="checkbox" name="electrician" value="yes"> Elektrik <br>
<h6>Populaarsus</h6>
<input type="radio" name="popularity" value="3">Vähetuntud
<input type="radio" name="popularity" value="5">Keskmine
<input type="radio" name="popularity" value="7">Populaarne
<input type="submit" class="button" style="width: 100%; margin-top:10px; margin-bottom: 0;" value="Sorteeri">
</form>
</div>

<div class="c-7">

</div>


<?php require "footer.php"; ?>
