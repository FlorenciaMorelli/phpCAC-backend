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
        sendJsonResponse(array("message" => "Método no permitido."));
        exit();
    }

    $database = new Database();
    $db = $database->getConnection();

    $user = new User($db);

    $data = getJsonData();

    if (empty($data->email) || empty($data->clave)) {
        http_response_code(400);
        sendJsonResponse(array("message" => "El email y la contraseña son obligatorios."));
        exit();
    }

    $user->email = $data->email;
    $user->clave = $data->clave;

    if ($user->login()){
        http_response_code(200);
        sendJsonResponse(array($user));
    } else {
        http_response_code(401);
        sendJsonResponse(array("message" => "Login failed."));
    }
?>