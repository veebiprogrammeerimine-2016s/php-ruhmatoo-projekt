<?php
/*
Tegeleb peamiste ja põhiliste funktsioonidega, näiteks kasutaja sisestatud
  info puhastamisega. Siin on funktsioonid, mis *ei* vaja andmebaasiühendust.
*/

class input{

  function clean ($string) {
    $string = trim(stripslashes(htmlspecialchars($string)));
    return $string;
  }

}

?>
