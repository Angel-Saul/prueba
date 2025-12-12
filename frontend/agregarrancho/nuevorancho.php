<?php
session_start();
if ($_SESSION['is_active'] == false) {
    header("Location: ../frontend/iniciosesion/logueo.php");
    exit;
}
$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'create_rancho') {
    header("Location: ../agregarrancho/nuevorancho_registro.php");
    exit;
}

include "../base/headerLogueado.php"

?>

<div class="container-rancho-registro">

    <div class="icon-container">
        <svg class="icon-plus" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
            <circle cx="50" cy="50" r="45" fill="none" stroke-linecap="round" />
            <line x1="50" y1="25" x2="50" y2="75" stroke-linecap="round" />
            <line x1="25" y1="50" x2="75" y2="50" stroke-linecap="round" />
        </svg>
    </div>

    <div class="message-box">
        <p>¿No tienes un rancho registrado? Agrega uno para comenzar</p>

        <form method="POST" action="">
            <input type="hidden" name="action" value="create_rancho">
            <button type="submit" class="btn-crear" style="background-color: #9ba657;">Crear Rancho</button>
        </form>
    </div>
</div>
<?php include "../base/footer.php" ?>