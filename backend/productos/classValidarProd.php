<?php

use JetBrains\PhpStorm\Internal\TentativeType;

class ValidarProd
{
    private string $nombreProd;
    private string $tipoProd;
    private string $talla;
    private string $marca;
    private string $color;
    private string $material;
    private string $genero;
    private string $edad;
    private string $costoU;
    private string $inventario;
    private $msj = [];



    public function __construct($nombreProd, $tipoProd, $talla, $marca, $color, $material, $genero, $edad, $costoU, $inventario)
    {
        $this->nombreProd = $nombreProd;
        $this->tipoProd = $tipoProd;
        $this->talla = $talla;
        $this->marca = $marca;
        $this->color = $color;
        $this->material = $material;
        $this->genero = $genero;
        $this->edad = $edad;
        $this->costoU = $costoU;
        $this->inventario = $inventario;


        $this->quitarEspacios();
    }


    private function quitarEspacios()
    {
        $this->nombreProd = preg_replace(['/\s+/', '/^\s|\s$/'], [' ', ''], trim($this->nombreProd));
        $this->tipoProd = preg_replace(['/\s+/', '/^\s|\s$/'], [' ', ''], trim($this->tipoProd));
        $this->talla = preg_replace(['/\s+/', '/^\s|\s$/'], [' ', ''], trim($this->talla));
        $this->marca = preg_replace(['/\s+/', '/^\s|\s$/'], [' ', ''], trim($this->marca));
        $this->color = preg_replace(['/\s+/', '/^\s|\s$/'], [' ', ''], trim($this->color));
        $this->material = preg_replace(['/\s+/', '/^\s|\s$/'], [' ', ''], trim($this->material));
        $this->genero = preg_replace(['/\s+/', '/^\s|\s$/'], [' ', ''], trim($this->genero));
        $this->edad = preg_replace(['/\s+/', '/^\s|\s$/'], [' ', ''], trim($this->edad));
        $this->costoU = preg_replace(['/\s+/', '/^\s|\s$/'], [' ', ''], trim($this->costoU));
        $this->inventario = preg_replace(['/\s+/', '/^\s|\s$/'], [' ', ''], trim($this->inventario));

       $this-> procesar ();
    }

    private function procesar(){


        $counter = 0;

        if (!preg_match("/[^a-zA-Z0-9\s]/", $this->nombreProd))
        {
            $this->msj['nombreProd'] = $this->nombreProd;
        }
        else {
            $this->msj['nombreProd'] = "incorrecto";
            $counter++;
        }

        if (!preg_match("/[^a-zA-Z0-9\s]/", $this->tipoProd))
        {
            $this->msj['tipoProd'] = $this->tipoProd;
        }
        else {
            $this->msj['tipoProd'] = "incorrecto";
            $counter++;
        }

        if (!preg_match("/[^0-9.]/", $this->talla))
        {
            $this->msj['talla'] = $this->talla;
        }
        else {
            $this->msj['talla'] = "incorrecto";
            $counter++;
        }

        if (!preg_match("/[^a-zA-Z0-9\s]/", $this->marca))
        {
            $this->msj['marca'] = $this->marca;
        }
        else {
            $this->msj['marca'] = "incorrecto";
            $counter++;
        }

        if (!preg_match("/[^a-zA-Z\s]/", $this->color))
        {
            $this->msj['color'] = $this->color;
        }
        else {
            $this->msj['color'] = "incorrecto";
            $counter++;
        }

        if (!preg_match("/[^a-zA-Z\s]/", $this->material))
        {
            $this->msj['material'] = $this->material;
        }
        else {
            $this->msj['material'] = "incorrecto";
            $counter++;
        }

        if (!preg_match("/[^a-zA-Z]/", $this->genero))
        {
            $this->msj['genero'] = $this->genero;
        }
        else {
            $this->msj['genero'] = "incorrecto";
            $counter++;
        }

        if (!preg_match("/[^a-zA-Z]/", $this->edad))
        {
            $this->msj['edad'] = $this->edad;
        }
        else {
            $this->msj['edad'] = "incorrecto";
            $counter++;
        }

        if (!preg_match("/[^0-9.]/", $this->costoU))
        {
            $this->msj['costoU'] = $this->costoU;
        }
        else {
            $this->msj['costoU'] = "incorrecto";
            $counter++;
        }
        if (!preg_match("/[^0-9]/", $this->inventario))
        {
            $this->msj['inventario'] = $this->inventario;
        }
        else {
            $this->msj['inventario'] = "incorrecto";
            $counter++;
        }

        $this->msj ['errors'] = $counter;
        
       $this-> getCleanDatos();
    }

    public function getCleanDatos()
    {
        return $this->msj;
    }
}
