<?php
include('../../../../includes/conexion.php');

$objeto = new Conexion();
$conexion = $objeto->Conectar();

$data = [];
$noserial = [];


$carrito = $_POST['listaCompras'];
$cliente = $_POST['cliente'];
$totalCompra = $_POST['total'];
$cantProductos = $_POST['cantidad']; 
$formaDePago = $_POST['formaPago'];
$metodoDePago = $_POST['metodoPago'];
$nombreCliente = $cliente['nombre'].' '.$cliente['aPaterno'].' '.$cliente['aMaterno'];

/*
// serializa los datos para subirlos a la tabla
$carritoCompras = serialize($carrito);
$datosCliente = serialize($cliente);
*/

//se convierte el arreglo en json
$carritoCompras = json_encode($carrito);
$datosCliente = json_encode($cliente);


 // se inserta una nueva venta
 $insertar = "INSERT INTO ventas(carrito, cantArticulos, comprador, metodoPago, FormaPago, id_cliente, nombreCliente, total) VALUES 
 (:carritoCompras, :cantProductos, :datosCliente, :metodoDePago, :formaDePago, :cliente, :nombreCliente, :totalCompra)";

$resultado = $conexion->prepare($insertar);

$params = [':carritoCompras' => $carritoCompras, ':cantProductos' => $cantProductos, ':datosCliente' => $datosCliente, ':metodoDePago' => $metodoDePago, 
':formaDePago' => $formaDePago, ':cliente' => $cliente['id'], ':nombreCliente' => $nombreCliente, ':totalCompra' => $totalCompra];

$resultado->execute($params);

/*
// retorna el ultimo registro de la tabla
$seleccionar = "SELECT * FROM ventas ORDER BY id_venta DESC LIMIT 1";
$result = $conexion->prepare($seleccionar);
$result->execute();
$data = $result->fetchAll(PDO::FETCH_ASSOC);
*/

$data['response'] = 'ok';

//  descerializa el arreglo listaArtuculos y asigna su contenido al arreglo data
//$test = unserialize($data[0]['listaArticulos']);

echo json_encode($data);
$conexion=null;
