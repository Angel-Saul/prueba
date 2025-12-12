<?php

    function registrarRancho($nombreRancho, $descripcion) {
        require '../db/sqlConnection.php';
        // Aquí iría la lógica para verificar el usuario en la base de datos
        // Por simplicidad, asumimos que el usuario es "admin" y la contraseña es "password"
        // Incluir la conexión
try {
    // Valor que queremos insertar
    //$nombreRancho = "Rancho 1"; // Puedes cambiarlo o recibirlo desde un formulario

    // Preparar la sentencia SQL
    $stmt = $pdo->prepare("INSERT INTO public.rancho( nombre, id_pais, pais, id_estado, estado, id_municipio, municipio, descripcion)
	VALUES ( :nombre, 1, 'México', 3, 'Puebla', 4, 'Xicotepec', :descripcion);");

    // Asignar el valor al parámetro
    $stmt->bindParam(':nombre', $nombreRancho);
    $stmt->bindParam(':descripcion', $descripcion);
    // Ejecutar la sentencia
    $stmt->execute();
    $lastInsertId = $pdo->lastInsertId();

    return [
        'registrado' =>  true,
        'id' =>  $lastInsertId
];

    //echo "Rancho insertado correctamente.";

} catch (PDOException $e) {
    echo "Error al insertar: " . $e->getMessage();
      
    return [
        'registrado' =>  false,
        'id' =>  NULL
];
}
}


function registrarPermisos ($idRancho, $idUsuario){
    try{
        require '../db/sqlConnection.php';
    $stmt = $pdo->prepare("INSERT INTO public.permisos(
	 id_rol, estatus, id_usuario, id_rancho)
	VALUES ( 1, 1, :idUsuario, :idRancho);");

    $stmt->bindParam(':idUsuario', $idRancho);
    $stmt->bindParam(':idRancho', $idUsuario);

    $stmt->execute();
    $lastInsertId = $pdo->lastInsertId();

    return [
        'registrado' =>  true,
        'id' =>  $lastInsertId
    ];

    //echo "Rancho insertado correctamente.";

} catch (PDOException $e) {
    echo "Error al insertar: " . $e->getMessage();  
    return [
        'registrado' =>  false,
        'id' =>  NULL
];
}
    
}
function cargarListaRanchos($idUsuario){
    try{
     require '../db/sqlConnection.php';
        // Preparar y ejecutar la consulta
       // echo "SELECT r.id_rancho, nombre, descripcion FROM public.rancho r INNER JOIN permisos p ON p.id_usuario=".$idUsuario." AND p.estatus=1 WHERE r.id_rancho=p.id_rancho " ;
    $stmt = $pdo->query("SELECT r.id_rancho, nombre, descripcion FROM public.rancho r INNER JOIN permisos p ON p.id_usuario=".$idUsuario." AND p.estatus=1 WHERE r.id_rancho=p.id_rancho ;");
    //$stmt->bindParam(':idUsuario', $idUsuario);
    $stmt->execute();
    // Obtener todos los resultados como un arreglo asociativo
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // Imprimir resultados
        return $resultados;
} catch (PDOException $e) {
    echo "Error en la consulta: " . $e->getMessage();
}
        //SELECT id_rancho, nombre,  descripcion
	//FROM public.rancho;

    }

function cargarRancho ($idRancho){
    try{
     require '../db/sqlConnection.php';
        // Preparar y ejecutar la consulta
       // echo "SELECT r.id_rancho, nombre, descripcion FROM public.rancho r INNER JOIN permisos p ON p.id_usuario=".$idUsuario." AND p.estatus=1 WHERE r.id_rancho=p.id_rancho " ;
    $stmt = $pdo->query("SELECT id_rancho, nombre, id_pais, pais, id_estado, estado, id_municipio, municipio, id_colonia, colonia, calle, numero_exterior, numero_interior, numero_telefono, telefono_fijo, correo, descripcion, facebook, instagram, fotografia FROM public.rancho WHERE id_rancho=".$idRancho.";");
    //$stmt->bindParam(':idUsuario', $idUsuario);
    $stmt->execute();
    // Obtener todos los resultados como un arreglo asociativo
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // Imprimir resultados
        return $resultados[0];
} catch (PDOException $e) {
    echo "Error en la consulta: " . $e->getMessage();
}
}

?>