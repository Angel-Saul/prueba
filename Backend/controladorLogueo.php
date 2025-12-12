<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') { //validar que la petición sea POST
        echo "La petición es POST";

        if (!empty($_POST)) { //verificar que se recibieron datos por POST, que no sea nulo
            // echo "Se recibieron datos mediante POST";
            // echo $_POST['email'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        require_once '/TALTETCH-WEB/database/logueoService.php'; //incluir el servicio de logueo


            if (preg_match("/^[^@\s]+@[^@\s]+\.[^@\s]+$/", $email)) { //validar formato de correo
                echo "Correo válido";

                $user = loguearUsuario($_POST['email'], $_POST['password']); //llamar a la función de logueo del servicio, pasar email y password en la variable $user
                print_r($user);
                if ($user == null) {
                    header("Location: /TALTETCH-WEB/frontend/iniciosesion/logueo.php");
    exit;
                } else {
                    echo "sesión iniciada";
                    session_start(); //variable de sesión, sirve para guardar datos del usuario mientras navega
                    $_SESSION['id_usuario'] = $user['id_usuario']; //guardar id del usuario en sesión, guarda el dato que llega de la variable $user en la variable id_usuario
                    $_SESSION['nombre'] = $user['nombre'];
                    $_SESSION['apellido_paterno'] = $user['apellido_paterno']; 
                    $_SESSION['apellido_materno'] = $user['apellido_materno'];
                    $_SESSION['is_active'] = true; //indicar que la sesión está activa
                    
                    header("Location: /TALTETCH-WEB/frontend/agregarrancho/nuevorancho.php"); //redireccionar a la página de nuevo rancho
                    exit;
                }

            } else {
                echo "Correo inválido";
            }    

        } else {
            header("Location: /TALTETCH-WEB/frontend/iniciosesion/logueo.php");
    exit;
        }

    } else {
        header("Location: /TALTETCH-WEB/frontend/iniciosesion/logueo.php");
    exit;

    }   

?>
