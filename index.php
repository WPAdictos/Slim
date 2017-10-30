<?php

/*
Recursos :

Para instalar y descargarse las dependencias, ejecutar en linea de comandos

composer install

documentacion SLIM: https://www.slimframework.com/

fluentPDO llamada  a procedimientos almacenados: https://github.com/envms/fluentpdo/issues/168
*/

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \src\models\ArticulosModel;
use \src\models\AutoresModel;
use \src\controllers\AutorController;
use \src\lib\Persona;

define("ENTORNO","development");   //development || production

require 'vendor/autoload.php';
require 'src/config/'.ENTORNO.'/config.php';

$app = new \Slim\App(["settings" => $config]);

//Container-----------------------------------------------------------------------------

$container = $app->getContainer();

$container['persona'] = function ($container) {
    $persona= new Persona();
    return $persona;
};

$container['ArticulosModel'] = function ($container) {
    $articulosdb= new ArticulosModel();
    return $articulosdb;
};

$container['AutoresModel'] = function ($container) {
    $autoresdb = new AutoresModel();
    return $autoresdb;
};




//---------------------------------------------------------------------------------------


//Rutas---------------------------------------------------------------------------------

//Hola Mundo con parametro
$app->get('/hola/{name}', function (Request $request, Response $response) {
    $name = $request->getAttribute('name');
    $persona=$this->get('persona');
    $response->getBody()->write($persona->saludar($name));
    return $response;
});


//Devuelve todos los articulos
$app->get('/articulos', function (Request $request, Response $response) {
    
    $articulos= $this->get('ArticulosModel');
    $data=$articulos->getAll();
    //$response->getBody()->write(json_encode($data));
    return $response->withJson($data, 200);

   
});

//Recupero un registro por Id, observar el parametro de entrada
$app->get('/articulos/{id}', function (Request $request, Response $response, $args) {
    
    $articulos= $this->get('ArticulosModel');
    if($data=$articulos->findById($args['id'])) {
       return $response->withJson($data, 200);
    }else{
       return $response->withJson(array('error'=>'Registro no encontrado'), 404);
    }  
});

//Insercion
$app->post('/articulos', function (Request $request, Response $response) {
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
    
    $articulos= $this->get('ArticulosModel');
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
       
    
});

//Borrado
$app->delete('/articulos/{id}', function (Request $request, Response $response, $args) {
    
    $articulos= $this->get('ArticulosModel');
    if($articulos->delete($args['id'])) {
       return $response->withJson(array('operacion'=>'Registro borrado correctamente'), 200);
    }else{
       return $response->withJson(array('error'=>'Se ha producido un error en el borrado.'), 400);
    }  
});

//Actualizacion
$app->put('/articulos/{id}', function (Request $request, Response $response, $args) {
 
    $inputVars= $request->getParsedBody();
    $values=array();
    if(isset($inputVars['titulo']) or !empty($inputVars['titulo']))
        $values['titulo'] = $inputVars['titulo'] ;
       
    if(isset($inputVars['autores_id']) or !empty($inputVars['autores_id']))
        $values['autores_id'] = $inputVars['autores_id'] ;
         
    if(isset($inputVars['categoria']) or !empty($inputVars['categoria']))
        $values['categoria'] = $inputVars['categoria'] ;

    if(empty($values)){
        return $response->withJson(array('error'=>'Debe de enviar los campos a modificar.'), 400); 
    }else{
        $articulos= $this->get('ArticulosModel');
        if($articulos->update($values,$args['id'])){
            return $response->withJson(array('operacion'=>'Registro actualizado correctamente'), 200);
        }else{
            return $response->withJson(array('error'=>'Se ha producid un error en la actualizacion'), 400);
        }   
    }
});

//------------------------------------------------------------------------------------------------------------------

$app->group('/autores', function () {
    $this->get('', AutorController::class . ':index');
    $this->get('/{id}', AutorController::class . ':show');   
    $this->post('', AutorController::class . ':create');
    $this->put('',  AutorController::class . ':update');
    $this->delete('/{id}',  AutorController::class . ':delete');
});

$app->run();