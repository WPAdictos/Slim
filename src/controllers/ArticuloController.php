<?php
namespace src\controllers;


class ArticuloController extends BaseController{

    public function index($request, $response, $args)
    {
        $articulos= $this->container->get('ArticulosModel');
        return $response->withJson($articulos->getAll(), 200);
    }



    public function show($request, $response, $args)
    {
        $articulos= $this->container->get('ArticulosModel');
        if($data=$articulos->findById($args['id'])) {
            return $response->withJson($data, 200);
         }else{
            return $response->withJson(array('error'=>'Registro no encontrado'), 404);
         }  
       
    }


    public function create($request, $response, $args){
        $inputVars= $request->getParsedBody();
        $data=array();
    
        if( !isset($inputVars['titulo']) or empty($inputVars['titulo'])){
          $data['error'] = 'Parametros vacios o incorrectos - titulo';
          return $response->withJson($data,400);
        }
        
        if( !isset($inputVars['autores_id']) or empty($inputVars['autores_id'])){
            $data['error'] = 'Parametros vacios o incorrectos - autores_id';
            return $response->withJson($data,400);
        }
    
        if( !isset($inputVars['categoria']) or empty($inputVars['categoria'])){
            $data['error'] = 'Parametros vacios o incorrectos - categoria';
            return $response->withJson($data,400);
        }
        
        $articulos= $this->container->get('ArticulosModel');
        $values=array(
               "titulo" => $inputVars['titulo'],
               "autores_id" =>$inputVars['autores_id'],
               "categoria" => $inputVars['categoria']
        );
       
        if ($articulos->insert($values)){
            $data['operacion'] = 'Insercion OK';
            return $response->withJson($data,201);
    
        }else{
            $data['error'] = 'Se ha producido un error en la insercion.';
            return $response->withJson($data,400);
        }
    }


    public function update($request, $response, $args){
        $inputVars= $request->getParsedBody();
        $values=array();
        if(isset($inputVars['titulo']) and !empty($inputVars['titulo']))
            $values['titulo'] = $inputVars['titulo'] ;
           
        if(isset($inputVars['autores_id']) and !empty($inputVars['autores_id']))
            $values['autores_id'] = $inputVars['autores_id'] ;
             
        if(isset($inputVars['categoria']) and !empty($inputVars['categoria']))
            $values['categoria'] = $inputVars['categoria'] ;
    
        if(empty($values)){
            return $response->withJson(array('error'=>'Debe de enviar los campos a modificar.'), 400); 
        }else{
            $articulos= $this->container->get('ArticulosModel');
            if($articulos->update($values,$args['id'])){
                return $response->withJson(array('operacion'=>'Registro actualizado correctamente'), 200);
            }else{
                return $response->withJson(array('error'=>'Se ha producid un error en la actualizacion'), 400);
            }   
        }
    }

    
    public function delete($request, $response, $args){
        $articulos= $this->container->get('ArticulosModel');
        if($articulos->delete($args['id'])) {
            return $response->withJson(array('operacion'=>'Registro borrado correctamente'), 200);
         }else{
            return $response->withJson(array('error'=>'Se ha producido un error en el borrado.'), 400);
         }          
    }
}