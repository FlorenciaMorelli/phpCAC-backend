<?php 
header("Access-Control_Alllow_Origin: *");
header("Access-Control-Allow-Methods: *");
header("Access-Control-Headers: Content-Type");

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "catalogo";
$puerto = "3306";

$conn = mysqli_connect($servername, $username,$password,$dbname,$puerto);

If(mysqli_connect_errno()) {
    echo "Error de Conexión". mysqli_connect_errno();
    die();
}else{
    echo "Conectado correctamente";
}

if($_SERVER['REQUEST_METHOD']==='POST') {
    $genero = isset($_POST['genero'])? $conn->real_escape_string($_POST['genero']) : '';
    $postBody = file_get_contents("php://input");

    $data = json_decode($postBody, true);    
    $id_genero = $data['id_genero'];
    $titulo = $data['titulo'];   
    $director = $data['director'];
    $sinopsis = $data['sinopsis'];
    $duracion = $data['duracion'];
    $anio = $data['anio'];
    $imagen = $data['imagen'];

//Verificar si todos los datos estan completos
 if($id_genero  && $titulo && $director && $sinopsis && $duracion && $anio && $imagen) {
    $query = "INSERT INTO peliculas (id_pelicula, id_genero, titulo, director, sinopsis, duracion, anio, imagen) VALUES (NULL,'$id_genero' ,'$titulo', '$director','$sinopsis','$duracion','$anio', '$imagen')";

    if($conn->query($query)===TRUE) {
        $last_insert_id = $conn->insert_id;

        http_response_code(201);
        echo json_encode(array("message" => $last_insert_id));
    } else {
        http_response_code(500);
        echo json_encode(array("message" => "Error al crear la película: " . $conn->error));
    }
 } else {
    http_response_code(400);
    echo json_encode(array("message" =>"Debe completar todos los campos"));
 }
}


 //get
if($_SERVER['REQUEST_METHOD'] === 'GET') {
    $query = "SELECT * FROM peliculas";
    // Ejecutar la consulta SQL
    $result = $conn->query($query);
    if ($result -> num_rows > 0) {        
        http_response_code(200);
        $peliculas = array();
        while($row = $result->fetch_assoc()) {
            $peliculas[] = $row;
        }    
        echo json_encode($peliculas);
    } else {
        http_response_code(404);
        echo json_encode(array("message" => "No se encontraron películas"));
    }
}

// Manejar la solicitud PUT para actualizar una película
if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $postBody = file_get_contents("php://input");
    $data = json_decode($postBody, true);

    $id = $data['id'];
    $id_genero = $data['id_genero'];
    $titulo = $data['titulo'];
    $director = $data['director'];
    $sinopsis = $data['sinopsis'];
    $duracion = $data['duracion'];
    $anio = $data['anio'];
    $imagen = $data['imagen'];

    if ($id && $id_genero && $titulo && $director && $sinopsis && $duracion && $anio && $imagen) {
        $query = "UPDATE peliculas SET id_genero='$id_genero', titulo='$titulo', director='$director', sinopsis='$sinopsis', duracion='$duracion', anio='$anio', imagen='$imagen' WHERE id_pelicula='$id'";

        if ($conn->query($query) === TRUE) {
            http_response_code(200);
            echo json_encode(array("message" => "Película actualizada correctamente"));
        } else {
            http_response_code(500);
            echo json_encode(array("message" => "Error al actualizar la película: " . $conn->error));
        }
    } else {
        http_response_code(400);
        echo json_encode(array("message" => "Debe completar todos los campos"));
    }
}

// Manejar la solicitud DELETE para eliminar una película
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $postBody = file_get_contents("php://input");
    $data = json_decode($postBody, true);

    $id = $data['id'];

    if ($id) {
        $query = "DELETE FROM peliculas WHERE id_pelicula='$id'";

        if ($conn->query($query) === TRUE) {
            http_response_code(200);
            echo json_encode(array("message" => "Película eliminada correctamente"));
        } else {
            http_response_code(500);
            echo json_encode(array("message" => "Error al eliminar la película: " . $conn->error));
        }
    } else {
        http_response_code(400);
        echo json_encode(array("message" => "Debe proporcionar un ID válido"));
    }
}

 $conn-> close();
    
 


?>