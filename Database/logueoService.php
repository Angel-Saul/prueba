<?php

    function loguearUsuario($username, $contrasenia) { //función para loguear usuario
        require 'TALTETCH-WEB/Database/sqlConnection.php'; //incluir la conexión a la base de datos
        // Aquí iría la lógica para verificar el usuario en la base de datos
        // Por simplicidad, asumimos que el usuario es "admin" y la contraseña es "password"
        // Incluir la conexión
     
        
    try {
        // Preparar y ejecutar la consulta
        $stmt = $pdo->query("SELECT id_usuario,nombre,apellido_paterno,apellido_materno
        FROM usuario WHERE correo = '$username' AND contrasenia = '$contrasenia'"); //consulta para obtener el usuario con el correo y contraseña proporcionados retornando id, nombre y apellidos

        // Obtener todos los resultados como un arreglo asociativo
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC); //guardar resultados en la variable $resultados
        print_r ($resultados);
        if (count($resultados) > 0) { //verificar si se encontró un usuario, si el conteo de resultados es mayor a 0
            // Usuario encontrado
            return $resultados[0]; // Retornar datos del usuario
        } else {
            // Usuario no encontrado
            return null;
            
        }


    } catch (PDOException $e) { //manejo de errores
        echo "Error en la consulta: " . $e->getMessage();
        return false;
    }
}



?>