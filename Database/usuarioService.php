<?php
// Evita hacer require dentro de funciones. Hazlo una vez en el controlador.
// Pero si insistes en este enfoque, al menos mejora la seguridad.

function verificarcorreo($correo)
{
    try {
        require '../db/sqlConnection.php';
        
        // ✅ Prepared statement (seguro)
        $stmt = $pdo->prepare("SELECT COUNT(correo) AS existe FROM usuario WHERE correo = :correo");
        $stmt->execute([':correo' => $correo]);
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return (int) $resultado['existe'];
    } catch (PDOException $e) {
        error_log("Error en verificarcorreo: " . $e->getMessage());
        return -1; // o lanza excepción
    }
}

function registrarusuario(
    $nombre,
    $apellidopaterno,
    $apellidomaterno,
    $genero,
    $fechanacimiento,
    $correo,
    $contrasenia  // ⚠️ ¡Aquí ya debe venir como hash!
) {
    try {
        require '../db/sqlConnection.php';

        // ✅ Validar que $contrasenia sea un hash (opcional, pero útil para depurar)
        if (strlen($contrasenia) < 60) {
            error_log("Advertencia: contraseña no parece un hash: " . substr($contrasenia, 0, 20));
        }

        $stmt = $pdo->prepare(
            "INSERT INTO usuario 
            (nombre, apellido_paterno, apellido_materno, genero, fecha_nacimiento, correo, contrasenia) 
            VALUES (:nombre, :apellidopaterno, :apellidomaterno, :genero, :fechanacimiento, :correo, :contrasenia)"
        );

        $stmt->execute([
            ':nombre' => $nombre,
            ':apellidopaterno' => $apellidopaterno,
            ':apellidomaterno' => $apellidomaterno,
            ':genero' => $genero,
            ':fechanacimiento' => $fechanacimiento,
            ':correo' => $correo,
            ':contrasenia' => $contrasenia  // ✅ Ya encriptado desde el controlador
        ]);

        return true;
    } catch (PDOException $e) {
        error_log("Error al registrar usuario: " . $e->getMessage());
        return false;
    }
}
?>