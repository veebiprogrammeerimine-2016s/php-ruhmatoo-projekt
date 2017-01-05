<?php
/*
Tegeleb rakenduse andmete haldamise ning otsinguga.
*/

class internal {

  private $conn;

  function __construct($db) {
    $this->conn = $db;
    $this->conn->query("SET NAMES 'utf8'");
    $this->conn->query("SET CHARACTER SET 'utf8'");
  }

  function getWorkers() {
    $sql = "select id from users where type='worker'";
    $result = $this->conn->query($sql);
    if ($result->num_rows > 0) {
      $workers = array();
      while ($row = $result->fetch_assoc()) {
        $workers[] = $row["id"];
      }
      return $workers;
    } else {
      return false;
    }
  }

  function getName($id) {
      $sql = "select name from users where id=".$id;
      $result = $this->conn->query($sql);
      $row = $result->fetch_assoc();
      return $row["name"];
  }

  function searchWorkers($searchterm) {

  }

  function getDistrictIDs() {
    $sql = "select id, name from districts order by name";
    $result = $this->conn->query($sql);
    $districts = array();
    while ($row = $result->fetch_assoc()) {
      $districts[] = $row["id"];
    }
    return $districts;
  }

  function getSkillIDs() {
    $sql = "select id, skill from skills order by skill";
    $result = $this->conn->query($sql);
    $skills = array();
    while ($row = $result->fetch_assoc()) {
      $skills[] = $row["id"];
    }
    return $skills;
  }

  function getSkillName($id) {
    $sql = "select skill from skills where id=".$id;
    $result = $this->conn->query($sql);
    $row = $result->fetch_assoc();
    return $row["skill"];
  }

  function getDistrictName($id) {
    $sql = "select name from districts where id=".$id."";
    $result = $this->conn->query($sql);
    $row = $result->fetch_assoc();
    return $row["name"];
  }

}
?>
