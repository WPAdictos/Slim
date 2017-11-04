<?php
namespace src\models;


class ArticulosModel extends BaseModel{

    
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
    
    function showAuthorFromArticle($idArticulo){
        //$this->conexion->debug = true;  
        return $this->conexion->from('articulos',$idArticulo)->select(NULL)->select('autores.nombre')->fetch();
    }
}