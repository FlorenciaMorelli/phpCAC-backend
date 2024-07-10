<?php
    class Database {
        private $server = 'localhost';
        private $user = 'root';
        private $password = '';
        private $database = 'codo_films';
        private $port  = '3306';
        private $conn;
        //el constructor no esta especificado
         

        // esto es un getter
        public function getConnection() {
            $this->conn = null;
            try {
                $this->conn = new mysqli($this->server, $this->user, $this->password, $this->database, $this->port);
            } catch (Exception $exception) {
                echo "Connection error: " . $exception->getMessage();
            }
            return $this->conn;
        }
    }
?>