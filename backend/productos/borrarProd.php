<?php
include('../../../../includes/conexion.php');

$objeto = new Conexion();
$conexion = $objeto->Conectar();


//se inicializa el array data
$data = [];

//datos recibidos del formulario editar producto
$idProducto = trim($_POST['idProducto']);

 //elimina imagen del almacenamiento local
 $buscarImg = "SELECT * FROM productos WHERE id_producto= :idProducto ";
 $respuesta = $conexion->prepare($buscarImg);
 $respuesta->bindParam(':idProducto',$idProducto);
 $respuesta->execute();
 $fila = $respuesta->fetchAll(PDO::FETCH_ASSOC);
 $oldImagen = "../../interfaces/" . $fila[0]['imgn'];

 unlink($oldImagen);


//elimina el registro de la tabla
$borrar = "DELETE FROM productos WHERE id_producto= :idProducto ";
$resultado = $conexion->prepare($borrar);
$resultado->bindParam(':idProducto',$idProducto);
$resultado->execute();


$data['response'] = "ok";

echo json_encode($data); //envio el array final el formato json a AJAX
