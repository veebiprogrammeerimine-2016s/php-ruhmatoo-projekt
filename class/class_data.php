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

  function searchWorkers($searchterm) {
    $sql = "select id from users where type='worker' and name like '%".$searchterm."%'";
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

  function getWorkerSkills($id) {
      $sql = "select skillid from worker_skills where userid=".$id;
      $result = $this->conn->query($sql);
      $skills = array();
      while ($row = $result->fetch_assoc()) {
        $skills[] = $row["id"];
      }
      return $skills;
  }

  function getName($id) {
      $sql = "select name from users where id=".$id;
      $result = $this->conn->query($sql);
      $row = $result->fetch_assoc();
      if (empty($row["name"])) {return "Nimi puudub";} else
      {return $row["name"];}
  }

  function getNumber($id) {
      $sql = "select phone from contacts where user=".$id;
      $result = $this->conn->query($sql);
      $row = $result->fetch_assoc();
      if (empty($row["phone"])) {return "Number puudub";} else
      {return $row["phone"];}
  }

  function getEmail($id) {
    $sql = "select email from users where id=".$id;
    $result = $this->conn->query($sql);
    $row = $result->fetch_assoc();
    return $row["email"];
  }

  function getAge($id) {
    $sql = "select age from users where id=".$id;
    $result = $this->conn->query($sql);
    $row = $result->fetch_assoc();
    if (empty($row["age"])) {return "Vanus puudub";} else
    {return $row["age"];}
  }

  function getBio($id) {
    $sql = "select bio from bios where owner=".$id;
    $result = $this->conn->query($sql);
    $row = $result->fetch_assoc();
    if (empty($row["bio"])) {return "Biograafia puudub";} else
    {return $row["bio"];}
  }

  function getUserDistrict($id) {
    $sql = "select district from users where id=".$id;
    $result = $this->conn->query($sql);
    $row = $result->fetch_assoc();
    if (empty($row["district"])) {return "";} else
    {return $row["district"];}
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

  function hasImage($id) {
    if (file_exists("../src/".$id.".png")) {
      return true;
    } else { return false; }

  }

}
?>
