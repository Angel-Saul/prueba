<?php 

session_start();

// Destruye todas las variables de sesión
$_SESSION = array();

session_destroy();

// Redirige a la página de login o inicio
header("Location: ../iniciosesion/logueo.php");
exit;

?>