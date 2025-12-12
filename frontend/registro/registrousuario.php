<?php
include "../base/headerLogin.php"
?>
    <div class="login-container">
        <div class="welcome-section">
            <h2> Crea tu cuenta en <br> TalTech </h2>
            <p>Y disfruta de nuestros servicios</p>
        </div>
        
        <div class="login-section">
            <h1> Ingresa tus datos: </h1>

            <form action="controladorregistrousuario.php" method="POST"> 
                
                <div class="form-row">
                    <input type="text" id="nombre" name="nombre" required placeholder="Nombre (s)">
                    <input type="text" id="apellido_p" name="apellido_p" required placeholder="Apellido Paterno">
                </div>

                <div class="form-row">
                    <input type="text" id="apellido_m" name="apellido_m" required placeholder="Apellido Materno">
                    
                    <select id="genero" name="genero" required>
                        <option value="" disabled selected> Género </option>
                        <option value="1"> Masculino </option>
                        <option value="2"> Femenino </option>
                        <option value="3"> Otro </option>
                    </select>
                </div>

                <input type="date" id="fecha_nac" name="fecha_nac" required placeholder="dd/mm/aaaa">

                <input type="email" id="email" name="email" required placeholder="Correo Electrónico">

                <div class="form-row">
                    <input type="password" id="password" name="password" required placeholder="Contraseña">
                    <input type="password" id="password_confirm" name="password_confirm" required placeholder="Repetir Contraseña">
                </div>
                
                <div class="button-group single-btn">
                    <button type="submit" class="btn primary-btn"> Registrarme </button>
                </div>

                <p class="login-link">
                    ¿Ya tienes una cuenta? <a href="/GANADO/iniciosesion/logueo.php"> Inicia sesión aquí </a>
                </p>
            </form>
        </div>
    </div>