<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST)) {
        require_once('../db/usuarioService.php');

        $existe = verificarcorreo($_POST['email']);

        if ($existe == 0) {
            $registro = registrarusuario(
                $_POST['nombre'],
                $_POST['apellido_p'],
                $_POST['apellido_m'],
                $_POST['genero'],
                $_POST['fecha_nac'],
                $_POST['email'],
                $_POST['password']
            );
        } else {
            echo "Ya existe un usuario con este correo";
        }
    }
}
header("Location: ../iniciosesion/logueo.php?param=new"); 
exit;

?>