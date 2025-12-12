<?php
session_start();
$_SESSION['id_usuario']=1; 


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST)) {
        require_once('../db/ranchoService.php');
        
    $registrado=registrarRancho($_POST['nombre'],$_POST['descripcion']);

    if ($registrado['registrado']== true) {
        $permisosRegistrados = registrarPermisos ($registrado['id'],$_SESSION['id_usuario']);
        header("Location: ../home/index.php?param=new");        
exit;
    }   
}
}    
?>