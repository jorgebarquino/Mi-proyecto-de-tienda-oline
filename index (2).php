<?php
require 'vendor/autoload.php'; // Carga automática de Composer
use GuzzleHttp\Client;

// Clave API de OpenWeatherMap
$apiKey = 'AQUI_TU_API_KEY'; 

// Ciudad por defecto
$city = isset($_GET['city']) ? $_GET['city'] : 'Elche';

// URL de la API
$url = "http://api.openweathermap.org/data/2.5/weather?q={$city}&appid={$apiKey}&units=metric&lang=es";

// Crear cliente HTTP
$client = new Client();

try {
    $response = $client->request('GET', $url);
    $data = json_decode($response->getBody(), true);

    echo "<h1>Clima en {$data['name']}</h1>";
    echo "<p>Temperatura: {$data['main']['temp']}°C</p>";
    echo "<p>Descripción: {$data['weather'][0]['description']}</p>";
    echo "<p>Humedad: {$data['main']['humidity']}%</p>";
    echo "<p>Viento: {$data['wind']['speed']} m/s</p>";
} catch (Exception $e) {
    echo "<p>Error al obtener el clima: " . $e->getMessage() . "</p>";
}
?>
