<?php

// Este es un ejemplo de un controlador en PHP que consulta un DNI usando la API de Reniec

// Primero, verifica si se recibió una solicitud GET con el parámetro "dni"
if (isset($_GET['dni'])) {
    // Obtener el número de DNI desde la solicitud GET
    $dni = $_GET['dni'];

    // Configuración de la solicitud cURL a la API de Reniec
    $url = 'https://api.apis.net.pe/v2/reniec/dni?numero=' . $dni;
    $token = 'apis-token-5930.NzWWU0mUJRJZ0Ywjw47y5fB2aVHRc-zL'; // Reemplaza con tu token de autenticación

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_SSL_VERIFYPEER => 0,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 2,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Referer: https://apis.net.pe/consulta-dni-api',
            'Authorization: Bearer ' . $token
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);

    // Comprobar si la respuesta es un JSON válido
    $persona = json_decode($response);

    if ($persona) {
        // Devolver la respuesta en formato JSON
        header('Content-Type: application/json');
        echo json_encode($persona);
    } else {
        // Si hay un error en la respuesta de la API, puedes devolver un mensaje de error
        header('HTTP/1.1 500 Internal Server Error');
        echo json_encode(['error' => 'Error en la respuesta de la API de Reniec']);
    }
} else {
    // Si no se proporcionó el parámetro "dni" en la solicitud GET, puedes devolver un mensaje de error
    header('HTTP/1.1 400 Bad Request');
    echo json_encode(['error' => 'Parámetro "dni" no proporcionado en la solicitud']);
}
