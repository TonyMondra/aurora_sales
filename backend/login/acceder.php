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
$searchUser = "SELECT user_email FROM users WHERE user_email = ? ";
$respuesta = $conexion->prepare($searchUser);
$respuesta->execute([$user]);

//retorna el numero de registros encontrados 
$foundUser = $respuesta->rowCount();


# si el usuario existe procece a validar si el password coincide con el usuario capturado
if ($foundUser > 0) {

    $buscarRegistro = "SELECT * FROM users WHERE user_email = ? ";
    $resp = $conexion->prepare($buscarRegistro);
    $resp->execute([$user]);
    $fetchdata = $resp->fetch();

    //$registrosEncontrados = $resp->rowCount();

    if ($fetchdata['user_email'] && password_verify($pass, $fetchdata['user_pass'])) {
        $data['credenciales'] = "ok";
    } else {
        $data['credenciales'] = "passError";
    }
    
} elseif ($foundUser == 0) {
    $data['credenciales'] = "inexistente";
}


echo json_encode($data);

$conexion = null;