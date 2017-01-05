<?php
/*
Sisaldab kasutajahaldusega seotud tegevusi, seehulgas
  - sisselogimine;
  - autentimine;
  - registreerumine;
*/

class User {
    private $conn;

    function __construct($db) {
      $this->conn = $db;
    }

    function checkIfExists($email) {
      $sql = "SELECT count(id) as amount from users where email='".$email."'";
      $result = $this->conn->query($sql);

      $row = $result->fetch_assoc();
      echo $row["amount"];
      if ($row["amount"] > 0) {return true;} else {return false;}
    }

    function create($email, $displayname, $hash, $type, $district, $age) {
      if ($type = "worker")
      {$sql = $this->conn->prepare("insert into users (name, email, password, type, district, age) values (?, ?, ?, ?, ?, ?)");
      $sql->bind_param("sssssi", $displayname, $email, $hash, $type, $district, $age);
      if ($sql->execute()) {
        return true;
      } else {return false;}}
      if ($type = "user") {
        $sql = $this->conn->prepare("insert into users (name, email, password, type) values (?, ?, ?, ?)");
        $sql->bind_param("ssss", $displayname, $email, $hash, $type);
        if ($sql->execute()) {
          return true;
        } else {return false;}
      }
    }

    function getHash($email) {
      $sql = "select password from users where email='".$email."'";
      $result = $this->conn->query($sql);
      $row = $result->fetch_assoc();
      return $row["password"];
    }

    function logIn($email) {
      $sql = "select id, name, email from users where email='".$email."'";
      $result = $this->conn->query($sql);
      $row = $result->fetch_assoc();
      $_SESSION["id"] = $row["id"];
      $_SESSION["name"] = $row["name"];
      $_SESSION["email"] = $row["email"];
      return true;    }

      function logout() {
        session_unset();
        session_destroy();

      }

}



?>
