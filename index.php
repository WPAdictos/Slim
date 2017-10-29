<?php

/*
Recursos :

Para instalar y descargarse las dependencias, ejecutar en linea de comandos

composer install

documentacion SLIM: https://www.slimframework.com/
*/

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use src\models\ArticulosModel;

define("ENTORNO","development");   //development || production

require 'vendor/autoload.php';

$app = new \Slim\App;

//Hola Mundo con parametro
$app->get('/hola/{name}', function (Request $request, Response $response) {
    $name = $request->getAttribute('name');
    $response->getBody()->write("Hola, $name");
    return $response;
});


//Devuelve todos los articulos
$app->get('/articulos', function (Request $request, Response $response) {
    
    $articulos= new ArticulosModel();
    $data=$articulos->getAll();
    //$response->getBody()->write(json_encode($data));
    return $response->withJson($data, 200);

   
});

//Recupero un registro por Id, observar el parametro de entrada
$app->get('/articulos/{id}', function (Request $request, Response $response, $args) {
    
    $articulos= new ArticulosModel();
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
    
    $articulos= new ArticulosModel();
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


$app->run();