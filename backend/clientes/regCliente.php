<?php

include('clssValRegistroCliente.php');
include('../../../../includes/conexion.php');

$objeto = new Conexion();
$conexion = $objeto->Conectar();

//se inicializa el array data
$data = [];

//datos recibidos del formulario agregar cliente
$genericId = "1";
$nombreTemp = $_POST['nombre'];
$aPaternoTemp = $_POST['aPaterno'];
$aMaternoTemp = $_POST['aMaterno'];
$telefonoTemp = $_POST['telefono'];
$direccionTemp = $_POST['direccion'];

// instanciacion de la clase validaciones
$valUser = new ValUsuario($genericId, $nombreTemp, $aPaternoTemp, $aMaternoTemp, $telefonoTemp, $direccionTemp);

// el metodo getCleanDatos retorno un arreglo asociativo que contiede los datos validados y limpios 
$cliente = $valUser->getCleanDatos();

//asignacion de los datos del arreglo a variables porque la sentiencia sql no lo soporta
$idUsuario = $cliente['idUsuario'];
$nombre = $cliente['nombre'];
$aPaterno = $cliente['aPaterno'];
$aMaterno = $cliente['aMaterno'];
$telefono = $cliente['telefono'];
$direccion = $cliente['direccion'];
$errors = $cliente['errors'];


//comprueba si el usuario ya existe
$existe = "SELECT * FROM clientes WHERE nombre = ? AND aPaterno = ? AND aMaterno= ? AND telefono= ? AND direccion = ?";    
$resp = $conexion->prepare($existe);

$parametros = [$nombre, $aPaterno, $aMaterno, $telefono, $direccion];
$resp->execute($parametros); // $resp->bindParam(1, $nombre); otra forma de enlazar un parametro

//cuenta el numero de registros
$regExistentes = $resp->rowCount();

// inserta un nuevo usuario en la tabla
if ($errors == 0) {

    if ($regExistentes == 0) {
        $insertar = "INSERT INTO clientes(nombre, aPaterno, aMaterno, telefono, direccion) VALUES  (?, ?, ?, ?, ?)";
        $resultado = $conexion->prepare($insertar);
        $params = [$nombre, $aPaterno, $aMaterno, $telefono, $direccion];

        $resultado->execute($params);

        //retorna el ultimo registro, no es necesario retornar toda la tabla
        $seleccionar = "SELECT * FROM clientes ORDER BY id_cliente DESC LIMIT 1";
        $result = $conexion->prepare($seleccionar);
        $result->execute();
        $data = $result->fetchAll(PDO::FETCH_ASSOC);
    } 
    else if ($regExistentes > 0) {
        $data['registro'] = "existente";
    }
}

//si el registro presenta errores
else if ($errors > 0) {

    $errs= 0;

    foreach ($cliente as $key => $value) {

        if ($value == "incorrecto") {
            $data['datos'][$key] = 'incorrecto';
            $errs++;
            $data['errs']= $errs;
        } else {  
            $data['datos'][$key] = 'correcto';
        }
    }
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //envio el array final el formato json a AJAX
$conexion = null;
