<?php
include('../../../../includes/conexion.php');
include('../../baseDatos/conBD.php');
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
$validarDatos = new ValidarProd($addnombreProd, $addtipoProd, $addtalla, $addmarca, $addcolor, $addmaterial, $addgenero, $addedad, $addcostoU, $addinventario);
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
$formatos = array('gif', 'png', 'jpg');
$extension = pathinfo($inputImg, PATHINFO_EXTENSION);



//comprueba si el producto ya existe
$existe = "SELECT * FROM productos WHERE nombreProd = ? AND tipoProd = ? AND talla= ? AND marca= ? AND color = ? AND material = ? AND genero = ? AND edad = ?";
$resultado = $conexion->prepare($existe);
$parametros = [$nombreProd, $tipoProd, $talla, $marca, $color, $material, $genero, $edad ];
$resultado->execute($parametros);

$numRegistros = $resultado->rowCount();

// generar error si el registro existe  
if ($numRegistros > 0) {
    $errors++;
}


// generar error si la imagen es incorrect 
if (empty($inputImg) || $sizeImg > $mb || !in_array($extension, $formatos)) {
    $errors++;
}

// devuelve un arreglo con errores si existen 
if ($errors > 0) {

    foreach ($producto as $key => $value) {

        if ($value == "incorrecto") {
            $data[$key] = 'incorrecto';
        } else {
            $data[$key] = 'correcto';
        }
    }
// errores en la imagen
    if (empty($inputImg)) {
        $data['picture'] = "noImagen";
    } else if ($sizeImg > $mb) {
        $data['picture'] = "sizeLimit";
    } else if (!in_array($extension, $formatos)) {
        $data['picture'] = "invalidExtension";
    }

    // si el producto ya existe
    if ($numRegistros > 0)
    {
        $data['registro'] = "existente";
    }
    
}


// inserta un nuevo producto si no existen errores
else if ($errors == 0) {

    if ($numRegistros == 0) {

        //mueve la imagen subida a una ubicacion local
        move_uploaded_file($_FILES['addImagen']['tmp_name'], '../../interfaces/' . $imagen);

        // se hace insert con imagen 
        $insertar = "INSERT INTO productos(imgn, nombreProd, tipoProd, talla, marca, color, material, genero, edad, costoU, inventario) VALUES 
                (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $resultado = $conexion->prepare($insertar);

        $params = [$imagen, $nombreProd, $tipoProd, $talla, $marca, $color, $material, $genero, $edad, $costoU, $inventario ];

        //prepare statement
        $resultado->execute($params);


        $data['response'] = 'ok';
    }
}




echo json_encode($data); //envia el array final en formato json a AJAX
$conexion = null;
