<?php
namespace src\controllers;


class AutorController extends BaseController
{
   
    public function index($request, $response, $args)
    {
        $autores= $this->container->get('AutoresModel');
        return $response->withJson($autores->getAll(), 200);
    }

    public function show($request, $response, $args)
    {
       $autores= $this->container->get('AutoresModel');
        if($data= $autores->findById($args['id'])) {
            return $response->withJson($data, 200);
         }else{
            return $response->withJson(array('error'=>'Registro no encontrado'), 404);
         }  
    }

    public function create($request, $response, $args){
        $inputVars= $request->getParsedBody();
       
        if( !isset($inputVars['nombre']) or empty($inputVars['nombre']))
          return $response->withJson(array('error'=>'Parametros vacios o incorrectos - nombre'),400);

             
        $autores= $this->container->get('AutoresModel');
        $values=array(
               "nombre" => $inputVars['nombre']
        );
       
        if ($autores->insert($values)){
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
        if(isset($inputVars['nombre']) and !empty($inputVars['nombre']))
            $values['nombre'] = $inputVars['nombre'] ;
                
        if(empty($values)){
            return $response->withJson(array('error'=>'Debe de enviar los campos a modificar.'), 400); 
        }else{
            $autores= $this->container->get('AutoresModel');
            if( $autores->update($values,$args['id'])){
                return $response->withJson(array('operacion'=>'Registro actualizado correctamente'), 200);
            }else{
                return $response->withJson(array('error'=>'Se ha producido un error en la actualizacion'), 400);
            }   
        }
    }

    public function delete($request, $response, $args){
        $autores= $this->container->get('AutoresModel');
        if($autores->delete($args['id'])) {
            return $response->withJson(array('operacion'=>'Registro borrado correctamente'), 200);
         }else{
            return $response->withJson(array('error'=>'Se ha producido un error en el borrado.'), 400);
         }            
    }

    public function showarticulos($request, $response, $args)
    {
        $autores= $this->container->get('AutoresModel');
        if($data= $autores->getArticulos($args['id'])) {
            return $response->withJson($data, 200);
         }else{
            return $response->withJson(array('error'=>'Registros no encontrado'), 404);
         }         
    }

}
