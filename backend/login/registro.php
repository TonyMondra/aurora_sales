<?php
//include('../../includes/conexion.php');
include('../../../../includes/conexion.php');
// nueva conexion
$objeto = new Conexion();
$conexion = $objeto->Conectar();

// inicia el array data
$data = [];

//valores recibidos del form
$user_name = $_POST['name-reg'];
$user_lastname = $_POST['lastname-reg'];
$user_email = $_POST['email-reg'];
$user_phone = $_POST['phone-reg'];
$user_pass = $_POST['pass-reg'];


//comprueba si el usuario existe, sin comprometer el password
$searchUser = "SELECT * FROM users WHERE user_email = ? ";
$respuesta = $conexion->prepare($searchUser);
$respuesta->execute([$user_email]);

//retorna el numero de registros encontrados 
$foundUser = $respuesta->rowCount();


if ($foundUser == 0) {

    $hashedPassword = password_hash($user_pass, PASSWORD_DEFAULT);
    $addUser = "INSERT INTO users(user_name, user_lastname, user_email, user_phone, user_pass) VALUES  (?, ?, ?, ?, ?)";
    $resp = $conexion->prepare($addUser);
    $paramametros = [$user_name, $user_lastname, $user_email, $user_phone, $hashedPassword];
    $resp->execute($paramametros);

    $data['response'] = "ok";

} elseif ($foundUser > 0) {
    $data['response'] = "false";
}


echo json_encode($data);

$conexion = null;
