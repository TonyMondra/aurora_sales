<?php

use JetBrains\PhpStorm\Internal\TentativeType;

class ValidarAcceso
{
    private string $user;
    private string $pass;
    private $msj = [];



    public function __construct($user, $pass)
    {
        $this->user = $user;
        $this->pass = $pass;
    
        $this->quitarEspacios();
    }


    private function quitarEspacios()
    {
        $this->user = preg_replace(['/\s+/', '/^\s|\s$/'], [' ', ''], trim($this->user));
        $this->pass = preg_replace(['/\s+/', '/^\s|\s$/'], [' ', ''], trim($this->pass));

        $this-> procesar ();
    }

    private function procesar(){


        $counter = 0;

        if (!preg_match("/[^a-zA-Z.]/", $this->user))
        {
            $this->msj['user'] = $this->user;
        }
        else {
            $this->msj['user'] = "incorrecto";
            $counter++;
        }


        if (!preg_match("/[^a-zA-Z0-9.]/", $this->pass))
        {
            $this->msj['pass'] = $this->pass;
        }
        else {
            $this->msj['pass'] = "incorrecto";
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
