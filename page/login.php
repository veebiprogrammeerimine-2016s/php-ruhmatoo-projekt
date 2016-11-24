<?php
require("header.php");

?>


<title>Saa osa!</title>


<div class="materialContainer">

   <div class="box">

      <div class="title">Logi Sisse</div>

      <div class="input">
         <label for="name">E-mail</label>
         <input type="email" name="name" id="name">
         <span class="spin"></span>
      </div>

      <div class="input">
         <label for="pass">Parool</label>
         <input type="password" name="pass" id="pass">
         <span class="spin"></span>
      </div>

      <div class="button login">
         <button><span>Logi Sisse</span> <i class="fa fa-check"></i></button>
		   </div>

      <a href="" class="pass-forgot">Unustasid parooli?</a>

   </div>

</div>


		

<?php
require("footer.php");
?>