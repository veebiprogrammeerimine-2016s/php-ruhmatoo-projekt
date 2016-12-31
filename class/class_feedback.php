<?php
/*
Tegeleb tagasiside ning kaebuste saatmisega.
*/

class feedback {

  private $conn;

  function __construct($db) {
    $this->conn = $db;
  }

  function send($title, $content) {
    $sql = $this->conn->prepare("insert into feedback (title, content) values (?, ?)");
    $sql->bind_param("ss", $title, $content);
    if ($sql->execute()) {return true;} else {return false;}
  }

}
?>
