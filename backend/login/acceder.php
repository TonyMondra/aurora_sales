<?php
include('../../../../includes/conexion.php');
include('classValAcceso.php');

// nueva conexion
$objeto = new Conexion();
$conexion = $objeto->Conectar();

// inicia el array data
$data = [];

//valores recibidos del form
$usuario = $_POST['usuarioLog'];
$contrasena = $_POST['contraLog'];

// validacion de datos
$acceso = new ValidarAcceso($usuario, $contrasena);

//arreglo con los datos validados
$resAcceso = $acceso->getCleanDatos();

//datos procesados por la clase
$user = $resAcceso['user'];
$pass = $resAcceso['pass'];
$errores = $resAcceso['errors'];

//comprueba si el usuario existe, sin comprometer el password
$searchUser = "SELECT * FROM usuarios WHERE userName = ? ";
$respuesta = $conexion->prepare($searchUser);
$respuesta->execute([$user]);

//retorna el numero de registros encontrados 
$foundUser = $respuesta->rowCount();


# si el usuario existe procece a validar si el password coincide con el usuario capturado
if ($foundUser > 0) {

    $buscarRegistro = "SELECT * FROM usuarios WHERE userName = ? AND userPass = ? ";
    $resp = $conexion->prepare($buscarRegistro);
    $resp->execute([$user, $pass]);

    $registrosEncontrados = $resp->rowCount();

    if ($registrosEncontrados > 0) {
        $data['credenciales'] = "ok";
    }

    else if ($registrosEncontrados == 0) {
        $data['credenciales'] = "passError";
    }
    
} 

elseif ($foundUser == 0) {
    $data['credenciales'] = "inexistente";
}


echo json_encode($data);

$conexion = null;
