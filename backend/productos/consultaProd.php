<?php
include('../../../../includes/conexion.php');
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$consulta = "SELECT * FROM productos";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
$conexion=null;
?>