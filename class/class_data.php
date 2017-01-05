<?php
/*
Tegeleb rakenduse andmete haldamise ning otsinguga.
*/

class internal{

  private $conn;

  function __construct($db) {
    $this->conn = $db;
  }

  function getWorkers() {
    $sql = "select id from users where type='worker'";
    $result = $this->conn->query($sql);
    if ($result->num_rows > 0) {
      $workers = array();
      while ($row = $result->fetch_assoc()) {
        $workers[] = $row["id"]
      }
      return $workers
    } else {
      return false;
    }
  }

  function searchWorkers($searchterm) {

  }

  function getDistricts() {
    $sql = "select id, name from districts";
    $result = $this->conn->query($sql);
    $districts = array();
    while ($row = $result->fetch_assoc()) {
      $districts[$row["id"]] = $row["name"];
    } else {return false;}
  }

}
?>
