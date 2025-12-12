<?php
// Datos de conexión
$host = 'localhost';       // Dirección del servidor PostgreSQL
$port = '5432';            // Puerto PostgreSQL por defecto
$dbname = 'bd_ganado'; // Nombre de la base de datos
$user = 'postgres';
$password = 'root';

try {
    // Crear conexión PDO
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $password);
    // Configurar errores para que lance excepciones
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Conexión exitosa"; // Opcional para probar
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>