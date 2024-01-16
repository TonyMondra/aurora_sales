<?php
include('../../../../includes/conexion.php');
include('classValidarProd.php');

//define el tamaño de un mb en bytes
$mb = 1048576;

//se inicializa el array data
$data = [];

// nueva conexion
$objeto = new Conexion();
$conexion = $objeto->Conectar();


//datos recibidos del formulario agregar cliente
$addnombreProd = $_POST['addNombreProd'];
$addtipoProd = $_POST['addTipoProd'];
$addtalla = $_POST['addTalla'];
$addmarca = $_POST['addMarca'];
$addcolor = $_POST['addColor'];
$addmaterial = $_POST['addMaterial'];
$addgenero = $_POST['addGenero'];
$addedad = $_POST['addEdad'];
$addcostoU = $_POST['addCostoU'];
$addinventario = $_POST['addInventario'];

// nuevo objeto validacion
$validarDatos = new ValidarProd(
    $addnombreProd,
    $addtipoProd,
    $addtalla,
    $addmarca,
    $addcolor,
    $addmaterial,
    $addgenero,
    $addedad,
    $addcostoU,
    $addinventario
);

$producto = $validarDatos->getCleanDatos();

// datos recibido del metodo clean data
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
$inputImg = $_FILES['addImagen']['name'];
$sizeImg = $_FILES['addImagen']['size'];

//renombra la imagen
$directorio = "imgProd/";
$imagen = $directorio . date("Y-m-d_H-i-s") . basename($_FILES['addImagen']['name']);

//define los formatos validos
$formatos = array('gif', 'png', 'jpg', 'jpeg');
$extension = pathinfo($inputImg, PATHINFO_EXTENSION);


//comprueba si el producto ya existe
$consulta = "SELECT * FROM productos WHERE nombre_prod = ? AND tipo_prod = ? AND talla_prod = ? AND marca_prod = ? AND color_prod = ? AND material_prod = ? AND genero_prod = ? AND edad_prod = ?";
$resultado = $conexion->prepare($consulta);
$parametros = [$nombreProd, $tipoProd, $talla, $marca, $color, $material, $genero, $edad];
$resultado->execute($parametros);
$rows = $resultado->fetchAll();
$numRegistros = count($rows);

$imgEmpty = empty($inputImg);
$imgInvalidSize = !empty($inputImg) && $sizeImg > $mb;
$imgInvalidFormat = !empty($inputImg) && !in_array($extension, $formatos);


// devuelve un arreglo con errores si existen 
if ($errors > 0 || $numRegistros > 0 || $imgEmpty || $imgInvalidSize || $imgInvalidFormat) {

    $errs = 0;

    foreach ($producto as $key => $value) {

        $data[$key] = ($value == "incorrecto") ? ('incorrecto') : 'correcto';
        if ($data[$key] == "incorrecto"){$errs++; }
    }

    // errores en la imagen
    $data['picture'] = $imgEmpty ? "noImagen" : ($imgInvalidSize ? "sizeLimit" : ($imgInvalidFormat ? "invalidExtension" : null));
    if ($imgEmpty || $imgInvalidSize || $imgInvalidFormat) {$errs++;}
    $data['errs'] = $errs;

    // si el producto ya existe
    $data['registro'] = ($numRegistros > 0) ? "existente" : "";
}


// inserta un nuevo producto si no existen errores
else if ($errors == 0 && $numRegistros == 0 && !$imgEmpty && !$imgInvalidSize && !$imgInvalidFormat) {

    //mueve la imagen subida a una ubicacion local
    move_uploaded_file($_FILES['addImagen']['tmp_name'], '../../interfaces/' . $imagen);

    $params = [$imagen, $nombreProd, $tipoProd, $talla, $marca, $color, $material, $genero, $edad, $costoU, $inventario];

    // se hace insert con imagen 
    $insertar = "INSERT INTO productos(img_prod, nombre_prod, tipo_prod, talla_prod, marca_prod, color_prod, material_prod, genero_prod, edad_prod, costo_prod, inventario_prod) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $resultado = $conexion->prepare($insertar);

    //prepare statement
    $resultado->execute($params);

    $data['response'] = 'ok';
}




echo json_encode($data); //envia el array final en formato json a AJAX
$conexion = null;