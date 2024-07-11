<?php
    require_once 'conexion.php';
//Funciones
    class peliculas extends conexion{
        public $response = ['status' => "ok","result" => array()];

        public function insertarPelicula($json){

           $datos = json_decode($json, true);
           if (!isset($datos['titulo']) ||  !isset($datos['genero']) || !isset($datos['emision']) || !isset($datos['duracion']) || !isset($datos['director']) || !isset($datos['sinopsis']) || !isset($datos['imagen'])) {
               $this->response['status'] = "error";
               $this->response['result'] = array(
                   "error_id" => "400",
                   "error_msg" => "Datos enviados incompletos o con formato incorrecto"
               );
               return $this->response;
             
           } else {
               $titulo = $datos['titulo'];
               $emision = $datos['emision'];// modificado en BD ---> anio (año) fecha de emision o lanzamiento
               $duracion = $datos['duracion'];
               $direccion = $datos['direccion'];//en la BD esta en una tabla aparte llamada directores
               $sinopsis = $datos['sinopsis'];
               $genero = $datos['genero'];//en la BD esta en una tabla aparte llamada generos
               $imagen = $datos['imagen']; //Agregado el campo imagen en BD
            
              // $query = "INSERT INTO peliculas (id_pelicula, titulo, id_genero, emision, duracion, direccion, sinopsis, imagen) VALUES (NULL, '$titulo','$genero', $emision', '$duracion', $direccion', $sinopsis', '$imagen')"; 
               $query = "INSERT INTO peliculas ( id_pelicula, titulo, id_genero, emision, duracion, sinopsis, imagen)VALUES (NULL, '$titulo','$genero', $emision', '$duracion', $sinopsis', '$imagen') SELECT p.id_genero FROM peliculas p INNER JOIN generos g ON p.id_genero = g.id_genero"; 

               $datos = $this->nonQueryId($query); 
               if ($datos) { 
                   $respuesta = $this->response;
                   $respuesta["result"] = array(
                       "id" => $datos
                   );
                   return $respuesta;
               } else {
                   // si no tiene un id
                   $respuesta = $this->response;
                   $respuesta['status'] = "error";
                   $respuesta['result'] = array(
                       "error_id" => "500",
                       "error_msg" => "Error interno del servidor"
                   );
                   return $respuesta;
               }
           }
       }  
    
       public function listarPeliculasSinPaginar(){
          // $query = "SELECT * FROM peliculas";
           $query = "SELECT p.id_pelicula,p.titulo,p.sinopsis,p.duracion,p.emision,p.imagen,g.nombre AS genero FROM peliculas p INNER JOIN generos g ON p.id_genero = g.id_genero";
           $datos = $this->obtenerDatos($query);// de la clase conexion
           return $datos;
       }
      
       // para listar todas las peliculas y en cada pagina vendran 16 peliculas
       public function listarPeliculas($pagina){
           
           $inicio = 0;
           $cantidad = 16;
           if ($pagina > 1) {
               $inicio = ($cantidad * ($pagina - 1)) + 1;
               $cantidad = $cantidad * $pagina;
           }
           //$query = "SELECT * FROM peliculas LIMIT $inicio, $cantidad";
           $query = "SELECT p.id_pelicula,p.titulo,p.sinopsis,p.duracion,p.emision,p.imagen,g.nombre AS genero FROM peliculas p INNER JOIN generos g ON p.id_genero = g.id_genero";
           $datos = $this->obtenerDatos($query);
           return $datos;
       }
    
       // para buscar una pelicula por su id
       public function obtenerPelicula($id){
           $query = "SELECT * FROM peliculas WHERE id_pelicula = '$id'";
           $datos = $this->obtenerDatos($query);
           if ($datos) {
               return $datos;
           } else {
               return 0;
           }
       }
       // para buscar una pelicula por una parte de su nombre
       public function buscarPelicula($nombre){
           $nombre = strtolower($nombre);
           $query = "SELECT * FROM peliculas WHERE LOWER(titulo) LIKE '%$nombre%'";
           $datos = $this->obtenerDatos($query);
           if ($datos) {
               return $datos;
           } else {
               return 0;
           }
       }
      
       //Actualiza una pelicula en la base de datos
       public function actualizarPelicula($json){

           $datos = json_decode($json, true);

           if (!isset($datos['id_pelicula']) || !isset($datos['titulo']) || !isset($datos['genero']) || !isset($datos['emision']) || !isset($datos['duracion']) || !isset($datos['director']) || !isset($datos['sinopsis']) || !isset($datos['imagen'])) {
               $this->response['status'] = "error";
               $this->response['result'] = array(
                   "error_id" => "400",
                   "error_msg" => "Datos enviados incompletos o con formato incorrecto"
               );
               return $this->response;
           } else {
               $id = $datos['id_pelicula'];
               $titulo = $datos['titulo'];
               $emision = $datos['emision'];
               $genero = $datos['genero'];
               $duracion = $datos['duracion'];
               $direccion = $datos['direccion'];
               $sinopsis = $datos['sinopsis'];
               $imagen = $datos['imagen'];

               $query = "UPDATE peliculas SET titulo = '$titulo', emision = '$emision', genero = '$genero', duracion = '$duracion', direccion = '$direccion', sinopsis = '$sinopsis', imagen = '$imagen' WHERE id_pelicula = '$id'"; $datos = $this->nonQuery($query);
               if ($datos >= 1) {
                   $respuesta = $this->response;
                   $respuesta["result"] = array(
                       "mensaje" => "Registro actualizado correctamente"
                   );
                   return $respuesta;
               } else {
                   $this->response['status'] = "error";
                   $this->response['result'] = array(
                       "error_id" => "500",
                       "error_msg" => "Error interno del servidor"
                   );
                   return $this->response;
               }
           }
       }
       //Eliminar una peliculade la base de datos
       public function eliminarPelicula($json){
          
           $datos = json_decode($json, true);
           if (!isset($datos['id_pelicula'])) {
               $this->response['status'] = "error";
               $this->response['result'] = array(
                   "error_id" => "400",
                   "error_msg" => "Datos enviados incompletos o con formato incorrecto"
               );
               return $this->response;
           }else{
               $id_pelicula = $datos['id_pelicula'];
               $query = "DELETE FROM peliculas WHERE id_pelicula = '$id_pelicula'";
               $datos = $this->nonQuery($query);
               if ($datos >= 1) {
                   $respuesta = $this->response;
                   $respuesta["result"] = array(
                       "mensaje" => "Registro eliminado correctamente"
                   );
                   return $respuesta;
               } else {
                   $this->response['status'] = "error";
                   $this->response['result'] = array(
                       "error_id" => "500",
                       "error_msg" => "Error interno del servidor"
                   );
                   return $this->response;
               }
           }
          
       }
      
    
    }

//Metodos
    header('Content-Type: application/json');
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: *");
    header("Access-Control-Allow-Headers: Content-Type");

    function respuestaJson($statusCode, $response) {
        http_response_code($statusCode);
        echo json_encode($response);
        exit(); 
    }

    if ($_SERVER['REQUEST_METHOD'] === "GET") {
        $idParam = isset($_GET['id']) ? $_GET['id'] : null;
        $peliculas = new Peliculas();
        if ($idParam !== null) {
            $datos = $peliculas->obtenerPelicula($idParam);
        } else {
            $datos = $peliculas->listarPeliculasSinPaginar(1);
        }
        respuestaJson(200, $datos);
    }

    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $peliculas = new Peliculas();
        $postBody = file_get_contents("php://input");
        $datosArray = $peliculas->insertarPelicula($postBody);
        respuestaJson(201, 'Pelicula insertada correctamente');
    }

    if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
        $peliculas = new Peliculas();
        $postBody = file_get_contents("php://input");
        $datosArray = $peliculas->actualizarPelicula($postBody);
        respuestaJson(200, 'Pelicula insertada correctamente');
    }

    if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
        $idParam = $_GET['id'];
        $peliculas = new Peliculas();
        $postBody = file_get_contents("php://input");
        
        if ($idParam) {
            $datosArray = $peliculas->eliminarPelicula($idParam);
        } else {
            http_response_code(400);
            echo json_encode(array("message" => "ID de película no proporcionado."));
        }
        respuestaJson(200, 'Pelicula eliminada exitosamente.');
    }
   
?>