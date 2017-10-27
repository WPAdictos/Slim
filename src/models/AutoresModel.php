<?php
namespace src\models;
use src\lib\Database;

class AutoresModel{

    private $conexion;
    
        function __construct(){
            $this->conexion= Database::getConection();
        }
    
        function getAll(){
            return $this->conexion->from('autores')->fetchAll();
        }
    
        function findById($id){
            return $this->conexion->from('autores', $id)->fetch();
        }
    
    
        function insert(array $values){
            return $this->conexion->insertInto('autores', $values)->execute();
        }
    
        function update(array $set,$id){
           return $this->conexion->update('autores',$set,$id)->execute();
        }
    
        function delete($id){
            return $this->conexion->deleteFrom('autores',$id)->execute();
        }
}