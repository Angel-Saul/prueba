<?php
// 1. Incluir conexión a la base de datos
require_once __DIR__ . '/../db/sqlConnection.php';

// 2. Incluir el servicio
require_once __DIR__ . '/../db/configuracionService.php';

class ConfiguracionController
{
    private $service;

    public function __construct($pdo)
    {
        $this->service = new ConfiguracionService($pdo);
    }

    /**
     * Mostrar página de configuración
     */
    public function mostrarConfiguracion($id_usuario)
    {
        $usuario = $this->service->obtenerUsuario($id_usuario);

        if (!$usuario) {
            throw new Exception("Usuario no encontrado");
        }

        return [
            'nombre' => $usuario['nombre'] ?? '',
            'apellidopaterno' => $usuario['apellido_paterno'] ?? '',
            'apellidomaterno' => $usuario['apellido_materno'] ?? '',
            'genero_texto' => $usuario['genero_texto'] ?? '',
            'genero' => $usuario['genero_id'] ?? '',
            'fechanacimiento' => $usuario['fecha_nacimiento'] ?? '',
            'correo' => $usuario['correo'] ?? '',
            'opciones_genero' => $this->service->obtenerOpcionesGenero()
        ];
    }

    /**
     * Procesar actualización de información personal
     */
    public function procesarActualizacionPersonal($id_usuario, $data)
    {
        if (empty($data['nombre']) || empty($data['apellido_paterno'])) {
            return ['success' => false, 'message' => 'Nombre y Apellido Paterno son obligatorios'];
        }

        $generos_validos = array_keys($this->service->obtenerOpcionesGenero());
        if (!empty($data['genero']) && !in_array($data['genero'], $generos_validos)) {
            return ['success' => false, 'message' => 'Género no válido'];
        }

        $resultado = $this->service->actualizarInformacionPersonal(
            $id_usuario,
            trim($data['nombre']),
            trim($data['apellido_paterno']),
            trim($data['apellido_materno'] ?? ''),
            $data['genero'] ?? null,
            $data['fecha_nacimiento'] ?? null
        );

        return $resultado ? 
            ['success' => true, 'message' => 'Información personal actualizada correctamente'] :
            ['success' => false, 'message' => 'No se pudo actualizar la información'];
    }

    /**
     * Procesar actualización de correo
     */
    public function procesarActualizacionCorreo($id_usuario, $correo, $password)
    {
        if (empty($correo) || empty($password)) {
            return ['success' => false, 'message' => 'Todos los campos son obligatorios'];
        }

        if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            return ['success' => false, 'message' => 'Correo electrónico no válido'];
        }

        $correo_actual = $this->service->obtenerCorreoActual($id_usuario);
        if ($correo === $correo_actual) {
            return ['success' => false, 'message' => 'El nuevo correo debe ser diferente al actual'];
        }

        return $this->service->actualizarCorreo($id_usuario, $correo, $password);
    }

    /**
     * Procesar cambio de contraseña
     */
    public function procesarCambioPassword($id_usuario, $current_password, $new_password, $confirm_password)
    {
        if (empty($current_password) || empty($new_password) || empty($confirm_password)) {
            return ['success' => false, 'message' => 'Todos los campos son obligatorios'];
        }

        return $this->service->cambiarPassword($id_usuario, $current_password, $new_password, $confirm_password);
    }

    /**
     * Actualizar un campo individual (para AJAX)
     */
    public function actualizarCampo($id_usuario, $campo, $valor)
    {
        return $this->service->actualizarCampo($id_usuario, $campo, $valor);
    }
}

// ========== MANEJO DE PETICIONES AJAX ==========
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();
    if (!isset($_SESSION['id_usuario'])) {
        echo json_encode(['success' => false, 'message' => 'Sesión expirada']);
        exit;
    }

    $input = json_decode(file_get_contents('php://input'), true);
    if (!$input) {
        echo json_encode(['success' => false, 'message' => 'Datos inválidos']);
        exit;
    }

    $id_usuario = (int)$_SESSION['id_usuario'];
    
    // ✅ $pdo está definido gracias a sqlConnection.php
    $controller = new ConfiguracionController($pdo);

    if ($input['action'] === 'actualizarCampo') {
        $resultado = $controller->actualizarCampo($id_usuario, $input['campo'], $input['valor']);
        echo json_encode($resultado);
        exit;
    }

    if ($input['action'] === 'cambiarPassword') {
        $resultado = $controller->procesarCambioPassword(
            $id_usuario,
            $input['current_password'],
            $input['new_password'],
            $input['confirm_password']
        );
        echo json_encode($resultado);
        exit;
    }

    // Si llega una acción desconocida
    echo json_encode(['success' => false, 'message' => 'Acción no reconocida']);
    exit;
}
?>