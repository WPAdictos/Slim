<?php
namespace src\models;
use src\lib\Database;

class ArticulosModel{

    private $conexion;

    function __construct(){
        $this->conexion= Database::getConection();
    }

    function getAll(){
        return $this->conexion->from('articulos')->fetchAll();
    }

    function findById($id){
        return $this->conexion->from('articulos', $id)->fetch();
    }

    function getAllComplete(){
        return $this->conexion->from('articulos')->select('autores.nombre')->fetchAll();
    }

    function insert(array $values){
        return $this->conexion->insertInto('articulos', $values)->execute();
    }

    function update(array $set,$id){
       return $this->conexion->update('articulos',$set,$id)->execute();
    }

    function delete($id){
        return $this->conexion->deleteFrom('articulos',$id)->execute();
    }
}