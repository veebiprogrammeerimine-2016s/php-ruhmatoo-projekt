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

    function changeDistrict($id, $district) {
      $sql= $this->conn->prepare("update users set district=? where id=?");
      $sql->bind_param("ii",$district, $id);
      if ($sql->execute()) {
        return true;
      }
    }

    function changeName($id, $name) {
      $sql= $this->conn->prepare("update users set name=? where id=?");
      $sql->bind_param("si",$name, $id);
      if ($sql->execute()) {
        return true;
      }
    }

    function changeAge($id, $age) {
      $sql= $this->conn->prepare("update users set age=? where id=?");
      $sql->bind_param("ii",$age, $id);
      if ($sql->execute()) {
        return true;
      }
    }

    function changeBio($id, $bio) {
      $sql= $this->conn->prepare("update bios set bio=? where owner=?");
      $sql->bind_param("si",$bio, $id);
      if ($sql->execute()) {
        return true;
      }
    }

    function getId ($email) {
      $sql = "select id from users where email='".$email."'";
      $result = $this->conn->query($sql);
      $row = $result->fetch_assoc();
      return $row["id"];
    }
    function skillExists($user, $skill) {
      $sql = "select count(id) as cnt from worker_skills where userid=".$user." and skillid=".$skill;
      $result = $this->conn->query($sql);
      $row = $result->fetch_assoc();
      if ($row["cnt"] > 0) {
        return true;
      } else {return false;}
    }
    function addSkill($user, $skill) {
        $sql = $this->conn->prepare("insert into worker_skills (userid, skillid) values (?, ?)");
        $sql->bind_param("ii", $user, $skill);
        if ($sql->execute()) {
          return true;
        } else { return false;}
    }

    function getHash($email) {
      $sql = "select password from users where email='".$email."'";
      $result = $this->conn->query($sql);
      $row = $result->fetch_assoc();
      return $row["password"];
    }

    function addBio($user, $bio) {
      $sql = $this->conn->prepare("insert into bios (owner, bio) values (?, ?)");
      $sql->bind_param("is", $user, $bio);
      if ($sql->execute()) {
        return true;
      } else {return false;}
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
