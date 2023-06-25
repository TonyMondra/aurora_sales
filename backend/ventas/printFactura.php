<?php
require('../../fpdf/fpdf.php');
include('../../../../includes/conexion.php');

$objeto = new Conexion();
$conexion = $objeto->Conectar();

class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
        // Logo
        $this->Image('../../media/logoverde.png', 10, 8, 33);
        // Arial bold 15
        $this->SetFont('Arial', 'B', 15);
        // Movernos a la derecha
        $this->Cell(60);
        // Título
        $this->Cell(60, 10, 'Cotizacion', 1, 0, 'C');
        // Salto de línea
        $this->Ln(30);
    }

    // Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Número de página
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}




$folioFactura = $_POST['folio'];


$seleccionar = "SELECT * FROM ventas where id_venta = '$folioFactura'";
$result = $conexion->prepare($seleccionar);
$result->execute();

$data = $result->fetchAll(PDO::FETCH_ASSOC);
//$articulo = unserialize($data[0]['listaArticulos']);
$articulo = json_decode($data[0]['carrito']);
$longitud = count($articulo);


//emisor
$emisor = "Emisor: Zapateria 80 Hermanos SA de CV";
$rfc = "RFC: XXXXPPPPIIP0";
$regimen = "Regimen: General de Ley Personas Morales";

// comprobante 
$comprobante = "Cotizacion";
$folio = "Folio : " . $data[0]['id_venta'];
$fecha = "Fecha : " . $data[0]['fechaCompra'];
$lugar = "Lugar de emision : 10020";


//receptor
$cliente = "Cliente : " . $data[0]['nombreCliente'];

//pago 
$metodoPago = "Metodo de pago : " . $data[0]['metodoPago'];
$formaPago = "Forma de pago : " . $data[0]['FormaPago'];

//total
$subtotalLbl = "Subtotal: $" . $data[0]['total'];
$subtotal = floatval($data[0]['total']);
$iva = 0.16;
$impuestos = "impuestos: $" . $subtotal * $iva;
$total = "Total: $" . $subtotal + ($subtotal * $iva);





$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 10);
$pdf->Ln(20);
$pdf->Cell(95, 10, $emisor);
$pdf->Cell(25);
$pdf->Cell(95, 10, $comprobante);
$pdf->Ln(7);
$pdf->Cell(95, 10, $rfc);
$pdf->Cell(25);
$pdf->Cell(95, 10, $folio);;
$pdf->Ln(7);
$pdf->Cell(95, 10, $regimen);
$pdf->Cell(25);
$pdf->Cell(95, 10, $fecha);
$pdf->Ln(7);
$pdf->Cell(120);
$pdf->Cell(95, 10, $lugar);
$pdf->Ln(20);
$pdf->Cell(95, 10, $cliente);
$pdf->Cell(25);
$pdf->Cell(95, 10, $metodoPago);
$pdf->Ln(7);
$pdf->Cell(120);
$pdf->Cell(95, 10, $formaPago);
$pdf->Ln(40);
$pdf->Cell(24, 10, "cant.", 1);
$pdf->Cell(24, 10, "tipo", 1);
$pdf->Cell(24, 10, "producto", 1);
$pdf->Cell(24, 10, "talla", 1);
$pdf->Cell(24, 10, "color", 1);
$pdf->Cell(24, 10, "marca", 1);
$pdf->Cell(24, 10, "publico", 1);
$pdf->Cell(24, 10, "importe", 1);
$pdf->Ln(20);
$pdf->SetFont('Arial', '', 8);
for ($i = 0; $i < $longitud; $i++) {
    foreach ($articulo[$i] as $key => $value) {
        $pdf->Cell(24, 7, $value, 1);
    }
    $pdf->Ln(10);
}
$pdf->Ln(20);
$pdf->SetFont('Arial', '', 14);
$pdf->Cell(95, 10, $subtotalLbl);
$pdf->Ln(10);
$pdf->Cell(95, 10, $impuestos);
$pdf->Ln(10);
$pdf->Cell(95, 10, $total);
$pdf->Output();
