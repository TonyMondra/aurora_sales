<?php

function updateLocalImg($idProd, $conexion, $imagen)
{
    $buscarImg = "SELECT * FROM productos WHERE id_producto='$idProd' ";
    $respuesta = $conexion->prepare($buscarImg);
    $respuesta->execute();
    $fila = $respuesta->fetchAll(PDO::FETCH_ASSOC);
    $oldImagen = "../../interfaces/" . $fila[0]['imgn'];
    unlink($oldImagen);

    //mueve la imagen subida a una ubicacion local
    move_uploaded_file($_FILES['editImagen']['tmp_name'], '../../interfaces/' . $imagen);
}

function updateAll($conexion, $params)
{
    $actualizar = "UPDATE productos SET img_prod=?, nombre_prod=?, tipo_prod=?, talla_prod=?, marca_prod=?, 
     color_prod=?, material_prod=?, genero_prod=?, edad_prod=?, costo_prod=?, inventario_prod=? WHERE id_producto=? ";
    $resultado = $conexion->prepare($actualizar);
    $resultado->execute($params);
    $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
    return $data;
}

function updateOnlyImg($conexion, $params)
{
    $actualizar = "UPDATE productos SET img_prod=? WHERE id_producto=? ";
    $resultado = $conexion->prepare($actualizar);
    $resultado->execute($params);
    $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
    return $data;
}

function updateData($conexion, $params)
{
    $actualizar = "UPDATE productos SET nombre_prod = ?, tipo_prod = ?, talla_prod = ?, marca_prod = ?, color_prod = ?, 
         material_prod = ?, genero_prod = ?, edad_prod = ?, costo_prod = ?, inventario_prod = ? WHERE id_producto = ? ";
    $resultado = $conexion->prepare($actualizar);
    $resultado->execute($params);
    $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
    return $data;
}

