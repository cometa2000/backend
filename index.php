<?php
    require_once realpath('../vendor/autoload.php');
    $dotenv = Dotenv\Dotenv::createImmutable('../');
    $dotenv->load();

    
    $host = $_ENV['DB_HOST'];
    $database = $_ENV['DB_DATABASE'];
    $username = $_ENV['DB_USERNAME'];
    $password = $_ENV['DB_PASSWORD'];
    $conexion = new mysqli($host, $username, $password, $database);

    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    } else{
        echo "Conexión exitosa a la base de datos";
    }

    
?>