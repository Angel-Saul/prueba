<?php 
include '../frontend/base/headerLogueado.php';
?>
<body>
    <div class="contenedor-creacion">
        <div class="lado-titulo">
            <h1>Creación de rancho</h1>
            <h2>Datos generales</h2>
            <p class="instruccion">Ingresa los datos que se te piden</p>
        </div>
        
        <div class="lado-formulario">
            <form method="POST" action="controlador_registro_rancho.php">
                <div class="campo-form">
                    <div class="etiqueta-campo">Nombre(s)</div>
                    <input type="text" id="nombre" name="nombre" required>
                </div>
                
                <div class="campo-form">
                    <div class="etiqueta-campo">Descripción</div>
                    <textarea id="descripcion" name="descripcion" required></textarea>
                </div>
                
                <button type="submit" class="boton-registrar" name="registrar" style = "background-color: #9ba657" >Registrar</button>
            </form>
        </div>
    </div>
</body>
</html>