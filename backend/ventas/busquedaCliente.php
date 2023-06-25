<?php
include('../../../../includes/conexion.php');

$objeto = new Conexion();
$conexion = $objeto->Conectar();

$cliente = $_POST['cliente'];
$tel = intval($_POST['telefono']) ; // convierte el telefono a integral

// la barra de busqueda consulata a un cliente por medio de su nombre, apellido o telefono
$existe = "SELECT * FROM clientes WHERE nombre like ? OR aPaterno like ? OR aMaterno like ? OR telefono = ?";
$result = $conexion->prepare($existe);
$params = [$cliente, $cliente, $cliente, $tel];
$result->execute($params);
$data = $result->fetchAll(PDO::FETCH_ASSOC);


// convierte en json al arreglo data 
echo json_encode($data, JSON_UNESCAPED_UNICODE);
$conexion = null;