<?php
    session_start();

    if (isset($_POST['submit'])) {
        $db = new Database();

        $postUsername = $_POST['username'];
        $postPassword = $_POST['password'];

        if ($db->login($postUsername, $postPassword)) {
            echo "ok";
        } else {
            echo "nok";
        }


    }



    class Database {

        private $host = "localhost";
        private $username = "if16";
        private $password = "ifikad16";
        private $dbName = "if16_stanislav";

        private $mysqli;

        public function __construct() {
            $this->mysqli = $this->getConnection();
            if ($this->mysqli->connect_errno > 0) {
                echo "Database connection error";
                exit();
            }
        }

        private function getConnection() {
            return new mysqli($this->host, $this->username, $this->password, $this->dbName);
        }

        private function closeConnection() {
            $this->mysqli->close();
        }

        function login($username, $password) {
            $query = $this->mysqli->prepare("SELECT id, username, password FROM p_owners WHERE username = ? AND password = ?");
            $query->bind_param('ss', $username, $password);
            $query->bind_result($id, $usernameDb, $passwrodDb);
            $query->execute();

            if ($query->fetch()) {
                $_SESSION["userId"] = $id;
                $_SESSION["username"] = $usernameDb;
                $this->closeConnection();
                return true;
            } else {
                $this->closeConnection();
                return false;
            }

        }



    }



?>