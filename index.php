<?php
    require_once realpath('./vendor/autoload.php');
    $dotenv = Dotenv\Dotenv::createImmutable('./');
    $dotenv->load();
    echo $_ENV['MI_VARIABLE_ENTORNO'];
    
    echo "<br>";
    echo $_ENV['DB_CONNECTION'];
    echo "<br>";
    echo $_ENV['DB_HOST'];
    echo "<br>";
    echo $_ENV['DB_PORT'];
    echo "<br>";
    echo $_ENV['DB_DATABASE'];
    echo "<br>";
    echo $_ENV['DB_USERNAME'];
    echo "<br>";
    echo $_ENV['DB_PASSWORD'];

    
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