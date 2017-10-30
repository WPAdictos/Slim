<?php
namespace src\lib;
// Clase para testear el container de dependencias

class Persona{

    function __construct(){
        
    }

    public function saludar($nombre){
      return "Hola ". $nombre. " saludos desde Slim";
    }
}