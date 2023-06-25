<?php

use JetBrains\PhpStorm\Internal\TentativeType;

class ValUsuario
{
    private string $idUsuario;
    private string $nombre;
    private string $aPaterno;
    private string $aMaterno;
    private string $telefono;
    private string $direccion;
    private $msj = [];

    public function __construct($idUsuario, $nombre, $aPaterno, $aMaterno, $telefono, $direccion)
    {
        $this->idUsuario = $idUsuario;
        $this->nombre = $nombre;
        $this->aPaterno = $aPaterno;
        $this->aMaterno = $aMaterno;
        $this->telefono = $telefono;
        $this->direccion = $direccion;

        $this->quitarEspacios();
    }


    private function quitarEspacios()
    {
        $this->idUsuario = preg_replace(['/\s+/', '/^\s|\s$/'], [' ', ''], trim($this->idUsuario));
        $this->nombre = preg_replace(['/\s+/', '/^\s|\s$/'], [' ', ''], trim($this->nombre));
        $this->aPaterno = preg_replace(['/\s+/', '/^\s|\s$/'], [' ', ''], trim($this->aPaterno));
        $this->aMaterno = preg_replace(['/\s+/', '/^\s|\s$/'], [' ', ''], trim($this->aMaterno));
        $this->telefono = preg_replace(['/\s+/', '/^\s|\s$/'], [' ', ''], trim($this->telefono));
        $this->direccion = preg_replace(['/\s+/', '/^\s|\s$/'], [' ', ''], trim($this->direccion));

        $this->procesar();
    }

    private function procesar()
    {


        $counter = 0;

        if (!preg_match("/[^0-9]/", $this->idUsuario) && !empty($this->idUsuario) ) {
            $this->msj['idUsuario'] = $this->idUsuario;
        } else {
            $this->msj['idUsuario'] = "incorrecto";
            $counter++;
        }

        if (!preg_match("/[^a-zA-Z\s]/", $this->nombre) && !empty($this->nombre) && strlen($this->nombre) < 30) {
            $this->msj['nombre'] = $this->nombre;
        } else {
            $this->msj['nombre'] = "incorrecto";
            $counter++;
        }

        if (!preg_match("/[^a-zA-Z\s]/", $this->aPaterno) && !empty($this->aPaterno) && strlen($this->aPaterno) < 20) {
            $this->msj['aPaterno'] = $this->aPaterno;
        } else {
            $this->msj['aPaterno'] = "incorrecto";
            $counter++;
        }

        if (!preg_match("/[^a-zA-Z\s]/", $this->aMaterno) && !empty($this->aMaterno) && strlen($this->aMaterno) < 20) {
            $this->msj['aMaterno'] = $this->aMaterno;
        } else {
            $this->msj['aMaterno'] = "incorrecto";
            $counter++;
        }

        if (!preg_match("/[^0-9]/", $this->telefono) && !empty($this->telefono) && strlen($this->telefono) == 10) {
            $this->msj['telefono'] = $this->telefono;
        } else {
            $this->msj['telefono'] = "incorrecto";
            $counter++;
        }

        if (!preg_match("/[^a-zA-Z0-9\s]/", $this->direccion) && !empty($this->direccion) && strlen($this->direccion) < 40) {
            $this->msj['direccion'] = $this->direccion;
        } else {
            $this->msj['direccion'] = "incorrecto";
            $counter++;
        }


        $this->msj['errors'] = $counter;
        $this->getCleanDatos();
    }

    public function getCleanDatos()
    {
        return $this->msj;
    }
}







//$nombre, $aPaterno, $aMaterno, $telefono, $direccion
//$this->nombre, $this->aPaterno, $this->aMaterno, $this->telefono, $this->direccion