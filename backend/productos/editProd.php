<?php
include('../../../../includes/conexion.php');
include('classValidarProd.php');
include_once('funciones.php');

// nueva conexion
$objeto = new Conexion();
$conexion = $objeto->Conectar();

//define el tamaño de un mb en bytes
$mb = 1048576;

//se inicializa el array data
$data = [];

//datos recibidos del formulario editar producto
$editName = $_POST['editNombreProd'];
$editTipo = $_POST['editTipoProd'];
$editSize = $_POST['editTalla'];
$editBrand = $_POST['editMarca'];
$editColor = $_POST['editColor'];
$editMat = $_POST['editMaterial'];
$editGen = $_POST['editGenero'];
$editAge = $_POST['editEdad'];
$editPrice = $_POST['editCostoU'];
$editStock = $_POST['editInventario'];


// nueva instancia validacion
$validarDatos = new ValidarProd(
    $editName,
    $editTipo,
    $editSize,
    $editBrand,
    $editColor,
    $editMat,
    $editGen,
    $editAge,
    $editPrice,
    $editStock
);

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
$costoU = $producto['costoU'];
$inventario = $producto['inventario'];
$errors = $producto['errors'];

//datos de la imagen
$inputImg = $_FILES['editImagen']['name'];
$sizeImg = $_FILES['editImagen']['size'];
$baseNameImg = $_FILES['editImagen']['name'];
$dirDestino = "imgProd/";
$imagen = $dirDestino . date("Y-m-d_H-i-s") . basename($baseNameImg);

//define los formatos validos para la imagen
$formatos = array('gif', 'png', 'jpg', 'jpeg');
$extension = pathinfo($inputImg, PATHINFO_EXTENSION);


//comprueba si existe el registro
$existe = "SELECT * FROM productos WHERE nombre_prod = ? AND tipo_prod = ? AND talla_prod= ? AND marca_prod= ? AND color_prod = ? 
AND material_prod = ? AND genero_prod= ? AND edad_prod= ? AND costo_prod= ? AND inventario_prod = ?";
$respuesta = $conexion->prepare($existe);
$params = [$nombreProd, $tipoProd, $talla, $marca, $color, $material, $genero, $edad, $costoU, $inventario];
$respuesta->execute($params);
$rows = $respuesta->fetchAll();
$numRegistros = count($rows);

$regSinImagen = ($numRegistros > 0 && empty($inputImg)); //cuando no se modifican datos ni se agrega nueva imagen
$imgInvalida = (!empty($inputImg) && ($sizeImg > $mb || !in_array($extension, $formatos)));

$imgEmpty = empty($inputImg);
$imgInvalidSize = !empty($inputImg) && $sizeImg > $mb;
$imgInvalidFormat = !empty($inputImg) && !in_array($extension, $formatos);



######################################################## envia lista de errores si existen ########################################################
if (($errors > 0) || $regSinImagen || $imgInvalidSize || $imgInvalidFormata) {

    $errs = 0;
    // errores en los inputs
    foreach ($producto as $key => $value) {

        $data[$key] = ($value == "incorrecto") ? ('incorrecto') : 'correcto';
        if ($data[$key] == "incorrecto"){$errs++; }

    }
    // errores en la imagen
    $data['picture'] = $imgEmpty ? "correcto" : ($imgInvalidSize ? "sizeLimit" : ($imgInvalidFormat ? "invalidExtension" : null));
    
    if ($imgInvalidSize || $imgInvalidFormat) {$errs++;}
    $data['errs']= $errs;

    //registro existente
    $data['registro'] = ($numRegistros > 0 && empty($inputImg)) ? "existente" : "";

}

######################################################## actualiza datos e imagen ###########################################
elseif ($numRegistros == 0 && !$imgEmpty && !$imgInvalidSize && !$imgInvalidFormata) {

    //reemplaza imagen del producto en el almacenamiento local
    updateLocalImg($idProd, $conexion, $imagen);

    // parametros a actualizar
    $params = [$imagen, $nombreProd, $tipoProd, $talla, $marca, $color, $material, $genero, $edad, $costoU, $inventario, $idProd];

    $data = updateAll($conexion, $params);

}


######################################################## solo actualiza la imagen ########################################################
elseif ($numRegistros > 0 && !$imgEmpty && !$imgInvalidSize && !$imgInvalidFormata) {

    //reemplaza imagen del producto en el almacenamiento local
    updateLocalImg($idProd, $conexion, $imagen);

    // parametros a actualizar
    $params = [$imagen, $idProd];

    //actualiza imagen
    $data = updateOnlyImg($conexion, $params);
}


######################################################## solo actualiza datos ########################################################
elseif ($numRegistros == 0 && $imgEmpty) {

    // parametros a actualizar
    $params = [$nombreProd, $tipoProd, $talla, $marca, $color, $material, $genero, $edad, $costoU, $inventario, $idProd];

    //update
    $data = updateData($conexion, $params);

}


echo json_encode($data); //envia el array en formato json a AJAX
$conexion = null;