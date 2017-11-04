<?php
namespace src\models;

class AutoresModel extends BaseModel{
    
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

        function getArticulos($idAutor){
            //$this->conexion->debug = true;  
            $columnas=array('articulos.id','articulos.titulo', 'articulos.categoria');
            return $this->conexion->from('articulos')->select(NULL)->select($columnas)->where('autores_id', $idAutor)->fetchAll();
        }
}