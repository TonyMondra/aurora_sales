<?php

include('clssValRegistroCliente.php');
include('../../../../includes/conexion.php');

$objeto = new Conexion();
$conexion = $objeto->Conectar();

//se inicializa el array data
$data = [];

//datos recibidos del formulario agregar cliente
$idUsuarioTemp = $_POST['nmEditId'];
$nombreTemp = $_POST['nmEditNombre'];
$aPaternoTemp = $_POST['nmEditApaterno'];
$aMaternoTemp = $_POST['nmEditAmaterno'];
$telefonoTemp = $_POST['nmEditTel'];
$direccionTemp = $_POST['nmEditDir'];

$validacion = new ValUsuario($idUsuarioTemp, $nombreTemp, $aPaternoTemp, $aMaternoTemp, $telefonoTemp, $direccionTemp);
$cliente = $validacion->getCleanDatos();

$idUsuario = $cliente['idUsuario'];
$nombre = $cliente['nombre'];
$aPaterno = $cliente['aPaterno'];
$aMaterno = $cliente['aMaterno'];
$telefono = $cliente['telefono'];
$direccion = $cliente['direccion'];
$errors = $cliente['errors'];

//comprueba si el producto ya existe
$existe = "SELECT * FROM clientes WHERE nombre = ? AND aPaterno = ? AND aMaterno= ? AND telefono= ? AND direccion = ?";
$resp = $conexion->prepare($existe);
$param = [$nombre, $aPaterno, $aMaterno, $telefono, $direccion];
$resp->execute($param);

$regExistentes = $resp->rowCount();

//si el registro no presenta errores
if ($errors == 0) {

    //si el registro no existe
    if ($regExistentes == 0) {

        $actualizar = "UPDATE clientes SET nombre= ?, aPaterno= ?, aMaterno= ?, telefono= ?, direccion= ? WHERE id_cliente= ? ";
        $resultado = $conexion->prepare($actualizar);
        $paramametros = [$nombre, $aPaterno, $aMaterno, $telefono, $direccion, $idUsuario];
        $resultado->execute($paramametros);

        $seleccionar = "SELECT * FROM clientes WHERE id_cliente = ?";
        $result = $conexion->prepare($seleccionar);
        $result->bindParam(1, $idUsuario);
        $result->execute();

        $data = $result->fetchAll(PDO::FETCH_ASSOC);
    } 
    
    //si el registro existe
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





echo json_encode($data); //envio el array final el formato json a AJAX
$conexion = null;
