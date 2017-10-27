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
    $response->getBody()->write(json_encode($data));
    //$response->withJson($data, 201);;

    return $response;
});


$app->run();