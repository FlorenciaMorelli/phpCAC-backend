<?php
   
    // Función para obtener datos JSON enviados en una solicitud HTTP.
    function getJsonData() {
        // Obtiene el contenido del cuerpo de la solicitud HTTP y lo decodifica de JSON a un objeto PHP.
        return json_decode(file_get_contents("php://input"));
    }

    // Función para enviar una respuesta JSON.
    function sendJsonResponse($data) {
        // Establece la cabecera HTTP indicando que el contenido es JSON y se utiliza UTF-8.
        header("Content-Type: application/json; charset=UTF-8");
        // Codifica los datos PHP a formato JSON y los envía como respuesta.
        echo json_encode($data);
    }
?>