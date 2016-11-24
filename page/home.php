<?php
require("header.php");
?>

<!-- Always shows a header, even in smaller screens. -->
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
  <header class="mdl-layout__header">
    <div class="mdl-layout__header-row">
      <!-- Title -->
      <span class="mdl-layout-title">Töömehe otsija</span>
      <!-- Add spacer, to align navigation to the right -->
      <div class="mdl-layout-spacer"></div>
      <!-- Navigation. We hide it in small screens. -->
      <nav class="mdl-navigation mdl-layout--large-screen-only">
        <!-- Expandable Textfield -->
        <form action="#">
          <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
            <label class="mdl-button mdl-js-button mdl-button--icon" for="sample6">
              <i class="material-icons">search</i>
            </label>
            <div class="mdl-textfield__expandable-holder">
              <input class="mdl-textfield__input" type="text" id="sample6">
              <label class="mdl-textfield__label" for="sample-expandable">Otsi</label>
            </div>
          </div>
        </form>
        <a class="mdl-navigation__link" href="">Kontakt</a>
        <a class="mdl-navigation__link" href="login.php">Logi sisse</a>
        <a class="mdl-navigation__link" href="registreerumine.php">Registreeru</a>
      </nav>
    </div>
  </header>
  <div class="mdl-layout__drawer">
    <span class="mdl-layout-title">Sorteeri</span>
    <nav class="mdl-navigation">
      <p class="mdl-navigation" href="">Millises linnaosas?</p>
      <select name= "location">
        <option value= "kristiine"> Kristiine</option>
        <option value= "viimsi"> Viimsi</option>
        <option value= "pirita"> Pirita</option>
        <option value= "lasnamäe"> Lasnamäe</option>
        <option value= "kesklinn"> Kesklinn</option>
        <option value= "pohja-tallinn"> Põhja-Tallinn</option>
        <option value= "mustamäe"> Mustamäe</option>
        <option value= "haabersti"> Haabersti</option>
        <option value= "nomme"> Nõmme</option>
        
      </select>
      <a class="mdl-navigation__link" href="">Link</a>
      <a class="mdl-navigation__link" href="">Link</a>
      <a class="mdl-navigation__link" href="">Link</a>
    </nav>
  </div>
  <main class="mdl-layout__content">
    <div class="page-content"><!-- Your content goes here --></div>
  </main>
</div>


<?php 
require("footer.php"); 
?>
