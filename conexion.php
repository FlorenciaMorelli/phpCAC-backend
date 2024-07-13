<?php

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type");
    header("Access-Control-Allow-Credentials: true");

    class conexion{
        private $server = 'localhost';
        private $user = 'root';
        private $password = '';
        private $database = 'codo_films';
        private $port  = '3306';
        private $conexion;
        
        function __construct(){
           $this->conexion = new mysqli($this->server, $this->user, $this->password, $this->database, $this->port);
            if($this->conexion->connect_errno){
                echo "Se presentó un error con la conexion";
                die();
            }
        }
    
        // converte caracteres a utf8
        private function convertirUTF8($array){
            array_walk_recursive($array,function(&$item,$key){
                if(!mb_detect_encoding($item,'utf-8',true)){
                    $item = mb_convert_encoding($item, 'UTF-8');
                }
            });
            return $array;
        }
    
        //obtener un array con los datos de la base de datos
        public function obtenerDatos($sqlstr){
            $results = $this->conexion->query($sqlstr);
            $resultArray = array();
            if($results){
                foreach($results as $key){
                        $resultArray[] = $key;
                }
                return $this->convertirUTF8($resultArray);
            }else{
                return 0;
            }  
        }
        //Guardar datos en la base de datos(update - insert - delete)
        public function nonQuery($sqlstr){
            $results = $this->conexion->query($sqlstr);
            return $this->conexion->affected_rows;
        }
        //Obtener el id de un registro(update - insert- delete)
        public function nonQueryId($sqlstr){
            $results = $this->conexion->query($sqlstr);
            $filas = $this->conexion->affected_rows;
            if($filas >= 1){
                return $this->conexion->insert_id;
            }else{
                return 0;
            }
        }
    }
    
    ?>