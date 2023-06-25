<?php
include('../../../../includes/conexion.php');

$objeto = new Conexion();
$conexion = $objeto->Conectar();

//se inicializa el array data
$data = [];

//datos recibidos del formulario editar producto
$idCliente = trim($_POST['idCliente']);

//se elimina el registro de la tabla
$borrar = "DELETE FROM clientes WHERE id_cliente = :idCliente ";
$resultado = $conexion->prepare($borrar);

//prepared statement
$resultado->bindParam(':idCliente', $idCliente);
$resultado->execute();

$data['response'] = 'ok';

echo json_encode($data); //envio el array final el formato json a AJAX
