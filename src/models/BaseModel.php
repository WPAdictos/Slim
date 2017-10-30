<?php
namespace src\models;

use src\lib\Database;

abstract class BaseModel
{
    protected $conexion;
    
    function __construct()
    {
        $this->conexion= Database::getConection();
    }
}
