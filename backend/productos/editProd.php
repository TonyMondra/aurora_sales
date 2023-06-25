<?php
include('../../../../includes/conexion.php');
include('../../baseDatos/conBD.php');
include('classValidarProd.php');

// nueva conexion
$objeto = new Conexion();
$conexion = $objeto->Conectar();

//define el tamaño de un mb en bytes
$mb = 1048576;

//se inicializa el array data
$data = [];

//datos recibidos del formulario editar producto
$editnombreProd = $_POST['editNombreProd'];
$edittipoProd = $_POST['editTipoProd'];
$edittalla = $_POST['editTalla'];
$editmarca = $_POST['editMarca'];
$editcolor = $_POST['editColor'];
$editmaterial = $_POST['editMaterial'];
$editgenero = $_POST['editGenero'];
$editedad = $_POST['editEdad'];
$editcostoU = $_POST['editCostoU'];
$editinventario = $_POST['editInventario'];


// nuevo objeto validacion
$validarDatos = new ValidarProd($editnombreProd, $edittipoProd, $edittalla, $editmarca, $editcolor, $editmaterial, $editgenero, $editedad, $editcostoU, $editinventario);
$producto = $validarDatos->getCleanDatos();


// datos recibidos del metodo getCleanDatos()
$idProd = $_POST['editIdProd'];
$nombreProd = $producto['nombreProd'];
$tipoProd = $producto['tipoProd'];
$talla = $producto['talla'];
$marca = $producto['marca'];
$color = $producto['color'];
$material = $producto['material'];
$genero = $producto['genero'];
$edad = $producto['edad'];
$costoU = $producto['costoU'] ;
$inventario = $producto['inventario'];
$errors = $producto['errors'];


//datos de la imagen
$inputImg = $_FILES['editImagen']['name'];
$sizeImg = $_FILES['editImagen']['size'];


//renombra la imagen
$directorio = "imgProd/";
$imagen = $directorio . date("Y-m-d_H-i-s") . basename($_FILES['editImagen']['name']);


//define los formatos validos para la imagen
$formatos = array('gif', 'png', 'jpg');
$extension = pathinfo($inputImg, PATHINFO_EXTENSION);


//comprueba si existe el registro
$existe = "SELECT * FROM productos WHERE nombreProd = ? AND tipoProd = ? AND talla= ? AND marca= ? AND color = ? 
AND material = ? AND genero= ? AND edad= ? AND costoU= ? AND inventario = ?";
$respuesta = $conexion->prepare($existe);
$params = [$nombreProd, $tipoProd, $talla, $marca, $color, $material, $genero, $edad, $costoU, $inventario];
$respuesta->execute($params);

$numRegistros = $respuesta->rowCount();

# si el registro existe y no se carga ninguna imagen  
if ($numRegistros > 0 && empty($inputImg)) {
    $errors++;
}


// si la imagen tiene errores
if (!empty($inputImg) && ($sizeImg > $mb || !in_array($extension, $formatos))) {
    $errors++;
}

######################################################## envia lista de errores ########################################################
// si existen errores
if ($errors > 0) {

    // errores en los inputs
    foreach ($producto as $key => $value) {

        if ($value == "incorrecto") {
            $data[$key] = 'incorrecto';
        } else {
            $data[$key] = 'correcto';
        }
    }
    // errores en la imagen
    if(empty($inputImg))
    {
        $data['picture'] = "correcto";
    } 
    else if (!empty($inputImg) && $sizeImg > $mb) {
        $data['picture'] = "sizeLimit";
    } else if (!empty($inputImg) && !in_array($extension, $formatos)) {
        $data['picture'] = "invalidExtension";
    }

    // error si el producto ya existe
    if ($numRegistros > 0 && empty($inputImg))
    {
        $data['registro'] = "existente";
    }
    
}

 ######################################################## actualiza todos los campos del registro ###########################################
elseif ($numRegistros == 0 && !empty($inputImg)) { //si el registro no existe y se carga una imagen


        //elimina imagen anterior
        $buscarImg = "SELECT * FROM productos WHERE id_producto='$idProd' ";
        $respuesta = $conexion->prepare($buscarImg);
        $respuesta->execute();
        $fila = $respuesta->fetchAll(PDO::FETCH_ASSOC);
        $oldImagen = "../../interfaces/" . $fila[0]['imgn'];

        unlink($oldImagen);

        //mueve la imagen subida a la caperta imag
        move_uploaded_file($_FILES['editImagen']['tmp_name'], '../../interfaces/' . $imagen);

        // update producto
        $actualizar = "UPDATE productos SET imgn=?, nombreProd=?, tipoProd=?, talla=?, marca=?, 
            color=?, material=?, genero=?, edad=?, costoU=?, inventario=? WHERE id_producto=? ";
        $resultado = $conexion->prepare($actualizar);
        $params = [$imagen, $nombreProd, $tipoProd, $talla, $marca, $color, $material, $genero, $edad, $costoU, $inventario, $idProd];

        $resultado->execute($params);

        $seleccionar = "SELECT * FROM productos ORDER BY id_producto DESC";
        $result = $conexion->prepare($seleccionar);
        $result->execute();

        $data = $result->fetchAll(PDO::FETCH_ASSOC);

}



######################################################## solo actualiza la imagen ########################################################
elseif ($numRegistros > 0 && !empty($inputImg)) { // si el registro existe y se carga una nueva imagen


        //elimina imagen anterior
        $buscarImg = "SELECT * FROM productos WHERE id_producto='$idProd' ";
        $respuesta = $conexion->prepare($buscarImg);
        $respuesta->execute();
        $fila = $respuesta->fetchAll(PDO::FETCH_ASSOC);
        $oldImagen = "../../interfaces/" . $fila[0]['imgn']; // indece de la imagen
        unlink($oldImagen);

        //mueve la imagen subida a una ubicacion local
        move_uploaded_file($_FILES['editImagen']['tmp_name'], '../../interfaces/' . $imagen);

        // update productos
        $actualizar = "UPDATE productos SET imgn=? WHERE id_producto=? ";
        $resultado = $conexion->prepare($actualizar);
        $resultado->execute([$imagen, $idProd]);

        $seleccionar = "SELECT * FROM productos ORDER BY id_producto DESC";
        $result = $conexion->prepare($seleccionar);
        $result->execute();

        $data = $result->fetchAll(PDO::FETCH_ASSOC); 
}




######################################################## actualiza datos y conserva la imagen ########################################################
elseif ($numRegistros == 0 && empty($inputImg)) { //si el registro no existe y no se carga una imagen

    // update del producto sin imagen 
    $actualizar = "UPDATE productos SET nombreProd=?, tipoProd=?, talla=?, marca=?, color=?, 
         material=?, genero=?, edad=?, costoU=?, inventario=? WHERE id_producto=? ";
    $resultado = $conexion->prepare($actualizar);
    $params = [$nombreProd, $tipoProd, $talla, $marca, $color, $material, $genero, $edad, $costoU, $inventario, $idProd];
    $resultado->execute($params);

    $seleccionar = "SELECT * FROM productos ORDER BY id_producto DESC";
    $result = $conexion->prepare($seleccionar);
    $result->execute();

    $data = $result->fetchAll(PDO::FETCH_ASSOC);
}





echo json_encode($data); //envio el array final el formato json a AJAX
//$conexion = null;
//$conbd->close();