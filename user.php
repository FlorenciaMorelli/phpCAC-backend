<?php

    class User {
        private $conn;
        private $table_name = "usuarios";

        public $id_usuario;
        public $nombre;
        public $email;
        public $clave;
        public $hashed_clave;

        public function __construct($db) {
            $this->conn = $db; 
        }

        public function create() {
            $query = "INSERT INTO " . $this->table_name . " SET nombre=?, email=?, clave=?";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("sss", $this->nombre, $this->email, $this->clave);
            if ($stmt->execute()) {
                return true;
            }
            return false;
        }

        public function read() {
            $query = "SELECT id_usuario, nombre, email, clave FROM " . $this->table_name;
            $result = $this->conn->query($query);
            return $result;
        }
        public function login(){
            $query = "SELECT id_usuario, nombre, email, clave FROM usuarios WHERE email=? AND clave=? ";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("ss", $this->email, $this->clave);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows == 1) {
                $stmt->bind_result($this->id_usuario, $this->nombre, $this->email, $this->clave);
                $stmt->fetch();
                return true;
            } else {
               return false;
            }

        }
    }
?>