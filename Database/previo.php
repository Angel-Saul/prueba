<?php
// Incluir la conexión
require_once 'sqlConnection.php';

try {
    // Preparar y ejecutar la consulta
    $stmt = $pdo->query("SELECT * FROM PAIS2");

    // Obtener todos los resultados como un arreglo asociativo
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Imprimir resultados
    foreach ($resultados as $fila) {
        echo "<pre>";
        print_r($fila);
        echo "</pre>";
    }

} catch (PDOException $e) {
    echo "Error en la consulta: " . $e->getMessage();
}
?>