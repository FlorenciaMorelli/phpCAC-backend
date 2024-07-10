<?php

    include_once 'database.php'; 
    include_once 'user.php';  
    include_once 'functions.php'; 

    header("Access-Control-Allow-Origin: *"); 
    header("Access-Control-Allow-Methods: POST, OPTIONS"); 
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
        http_response_code(200);
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405); 
        $response = array("message" => "Metodo no permitido. Por favor, use el método POST.");
        $respuesta = ["message" => "Metodo no permitido. Por favor, use el método POST."];
        sendJsonResponse($response);
        exit();
    }

    $database = new Database();
    $db = $database->getConnection();
    $user = new User($db); 
    $data = getJsonData();

    $user->nombre = $data->nombre;
    $user->email = $data->email;
    $user->clave = $data->clave;

    if ($user->create()) {
        http_response_code(201);
        sendJsonResponse(array("message" => "Usuario Creado ok."));
    } else {
        http_response_code(503);
        sendJsonResponse(array("message" => "El usuario no se pudo crear."));
    }
?>