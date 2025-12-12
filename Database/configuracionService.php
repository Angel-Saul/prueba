<?php
class ConfiguracionService
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Obtener información del usuario
     */
    public function obtenerUsuario($id_usuario)
    {
        try {
            $sql = "SELECT 
                        nombre, 
                        apellido_paterno, 
                        apellido_materno, 
                        CASE 
                            WHEN genero = 1 THEN 'Masculino'
                            WHEN genero = 2 THEN 'Femenino'
                            WHEN genero = 3 THEN 'Otro'
                            WHEN genero = 4 THEN 'Prefiero no decirlo'
                            ELSE 'No especificado'
                        END as genero_texto,
                        genero as genero_id,
                        TO_CHAR(fecha_nacimiento, 'DD/MM/YYYY') as fecha_nacimiento, 
                        correo
                    FROM usuario 
                    WHERE id_usuario = :id_usuario";

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([':id_usuario' => $id_usuario]);

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error al obtener usuario: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Obtener opciones de género
     */
    public function obtenerOpcionesGenero()
    {
        return [
            1 => 'Masculino',
            2 => 'Femenino',
            3 => 'Otro',
            4 => 'Prefiero no decirlo'
        ];
    }

    /**
     * Actualizar información personal
     */
    public function actualizarInformacionPersonal($id_usuario, $nombre, $apellidopaterno, $apellidomaterno, $genero_id, $fechanacimiento)
    {
        try {
            $sql = "UPDATE usuario SET 
                    nombre = :nombre, 
                    apellido_paterno = :apellido_paterno, 
                    apellido_materno = :apellido_materno, 
                    genero = :genero, 
                    fecha_nacimiento = :fecha_nacimiento
                    WHERE id_usuario = :id_usuario";

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':id_usuario' => $id_usuario,
                ':nombre' => $nombre,
                ':apellido_paterno' => $apellidopaterno,
                ':apellido_materno' => $apellidomaterno,
                ':genero' => $genero_id,
                ':fecha_nacimiento' => $fechanacimiento
            ]);

            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            error_log("Error al actualizar información personal: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Actualizar correo electrónico
     */
    public function actualizarCorreo($id_usuario, $correo, $password)
    {
        try {
            // 1. Verificar contraseña
            $sql = "SELECT contrasenia FROM usuario WHERE id_usuario = :id_usuario";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([':id_usuario' => $id_usuario]);
            $hash = $stmt->fetchColumn();

            if (!$hash || !password_verify($password, $hash)) {
                return ['success' => false, 'message' => 'Contraseña incorrecta'];
            }

            // 2. Verificar si el correo ya existe
            $sql = "SELECT COUNT(*) FROM usuario WHERE correo = :correo AND id_usuario != :id_usuario";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':correo' => $correo,
                ':id_usuario' => $id_usuario
            ]);
            $existe = $stmt->fetchColumn();

            if ($existe > 0) {
                return ['success' => false, 'message' => 'Este correo ya está registrado por otro usuario'];
            }

            // 3. Actualizar correo
            $sql = "UPDATE usuario SET correo = :correo WHERE id_usuario = :id_usuario";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':correo' => $correo,
                ':id_usuario' => $id_usuario
            ]);

            return ['success' => true, 'message' => 'Correo actualizado correctamente'];
        } catch (PDOException $e) {
            error_log("Error al actualizar correo: " . $e->getMessage());
            return ['success' => false, 'message' => 'Error en el servidor'];
        }
    }

    /**
     * Cambiar contraseña — ✅ CORREGIDO
     */
    public function cambiarPassword($id_usuario, $current_password, $new_password, $confirm_password)
    {
        try {
            // 1. Validar que las nuevas contraseñas coincidan
            if ($new_password !== $confirm_password) {
                return ['success' => false, 'message' => 'Las contraseñas no coinciden'];
            }

            // 2. Obtener el hash actual de la base de datos
            $sql = "SELECT contrasenia FROM usuario WHERE id_usuario = :id_usuario";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([':id_usuario' => $id_usuario]);
            $hash = $stmt->fetchColumn();

            // 3. Verificar que el usuario exista
            if (!$hash) {
                return ['success' => false, 'message' => 'Usuario no encontrado'];
            }

            // 4. ✅ Verificar contraseña ACTUAL (sin trim)
            if (!password_verify($current_password, $hash)) {
                return ['success' => false, 'message' => 'Contraseña actual incorrecta'];
            }

            // 5. ✅ Verificar que la nueva sea DIFERENTE (sin trim)
            if (password_verify($new_password, $hash)) {
                return ['success' => false, 'message' => 'La nueva contraseña debe ser diferente a la actual'];
            }

            // 6. Validar fortaleza
            if (!$this->validarFortalezaPassword($new_password)) {
                return ['success' => false, 'message' => 'La contraseña debe tener al menos 8 caracteres, una mayúscula, un número y un carácter especial (!@#$%^&*)'];
            }

            // 7. Encriptar y actualizar
            $newHash = password_hash($new_password, PASSWORD_DEFAULT);
            $sql = "UPDATE usuario SET contrasenia = :password WHERE id_usuario = :id_usuario";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':password' => $newHash,
                ':id_usuario' => $id_usuario
            ]);

            return ['success' => true, 'message' => 'Contraseña cambiada correctamente'];
        } catch (PDOException $e) {
            error_log("Error al cambiar contraseña: " . $e->getMessage());
            return ['success' => false, 'message' => 'Error en el servidor'];
        }
    }

    /**
     * Validar fortaleza de contraseña
     */
    private function validarFortalezaPassword($password)
    {
        // Mínimo 8 caracteres, al menos una mayúscula, un número y un carácter especial
        $regex = '/^(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{8,}$/';
        return preg_match($regex, $password);
    }

    /**
     * Obtener el correo actual del usuario
     */
    public function obtenerCorreoActual($id_usuario)
    {
        try {
            $sql = "SELECT correo FROM usuario WHERE id_usuario = :id_usuario";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([':id_usuario' => $id_usuario]);
            return $stmt->fetchColumn();
        } catch (PDOException $e) {
            error_log("Error al obtener correo: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Actualizar un campo individual
     */
    public function actualizarCampo($id_usuario, $campo, $valor)
    {
        try {
            $campos_validos = ['nombre', 'apellido_paterno', 'apellido_materno', 'genero', 'fecha_nacimiento', 'correo'];
            if (!in_array($campo, $campos_validos)) {
                return ['success' => false, 'message' => 'Campo no válido'];
            }

            $sql = "UPDATE usuario SET $campo = :valor WHERE id_usuario = :id_usuario";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':valor' => $valor,
                ':id_usuario' => $id_usuario
            ]);

            return ['success' => true, 'message' => 'Campo actualizado correctamente'];
        } catch (PDOException $e) {
            error_log("Error al actualizar campo: " . $e->getMessage());
            return ['success' => false, 'message' => 'Error en el servidor'];
        }
    }
}
?>