<?php
namespace src\lib;
// Clase para testear el container de dependencias

class Marca{

    private $marcasAlternativas;
    private $nombre;

    function __construct(){
        
    }

    public function setMarcasAlternativas(array $marcas){
        $this->marcasAlternativas= serialize($marcas);
    }

    public function getMarcasAlternativas(){
        return unserialize ($this->marcasAlternativas);
    }

    public function setNombre($nombre){
        $this->nombre= $nombre;
    }

    public function getNombre(){
        return $this->nombre;
    }
}