<?php
include "../db/ranchoService.php";
session_start();
$list=cargarListaRanchos($_SESSION["id_usuario"]);
?>