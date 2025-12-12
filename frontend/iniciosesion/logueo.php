<?php
include "../base/headerLogin.php"
?>
<div class="login-container">
    <div class="welcome-section">
        <h2> Bienvenido(a) a <br> TalTech </h2>
    </div>

    <div class="login-section">
        <h1> Inicio de sesión </h1>
        <p class="subtitle"> Ingresa tu correo y contraseña para ingresar </p>

        <form action="controladorLogueo.php" method="POST">

            <input
                type="email"
                id="email"
                name="email"
                required

                placeholder="Correo Electrónico">

            <input
                type="password"
                id="password"
                name="password"
                required

                placeholder="Contraseña">

            <div class="forgot-password">
                ¿Olvidaste tu contraseña? <a href="#" class="forgot-link"> Haz click aquí </a>
            </div>

            <div class="button-group">

                <a href="/TALTETCH-WEB/frontend/registro/registrousuario.php"><button type="button" class="btn secondary-btn"> Crear Cuenta </button></a>
                <button type="submit" class="btn primary-btn"> Iniciar Sesión </button>
            </div>
        </form>
    </div>
</div>

<?php
if (isset($_GET['param'])) {
    if ($_GET['param'] == 'new') {
?>
        <div class="modal fade" id="modalAbiertoAutomatico" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">¡Bienvenido!</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Ya eres usuario de Taltech, puedes iniciar sesión.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="background-color: #9ba657;">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", function() {

                var modalElement = document.getElementById("modalAbiertoAutomatico");

                var miModal = new bootstrap.Modal(modalElement);

                miModal.show();
            });
        </script>
<?php
    }
}
?>