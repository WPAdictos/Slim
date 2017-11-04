<?php
use \src\controllers\AutorController;
use \src\controllers\ArticuloController;
use \src\controllers\HomeController;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

//Hola Mundo con parametro
$app->get('/hola/{name}', function (Request $request, Response $response) {
    $name = $request->getAttribute('name');
    $persona=$this->get('persona');
    $response->getBody()->write($persona->saludar($name));
    $response->getBody()->write("<br> parametro pasado por el request en el MW test= " . $request->getAttribute('test'));
    return $response;
})->add($mw);


$app->group('/', function(){
      $this->get('', HomeController::class . ':index');
      $this->get('test', HomeController::class . ':test');
      $this->post('token', HomeController::class . ':token');
});

//------------------------------------------------------------------------------------------------------------------

$app->group('/articulos', function () {
    $this->get('', ArticuloController::class . ':index');
    $this->get('/{id}', ArticuloController::class . ':show');   
    $this->post('', ArticuloController::class . ':create');
    $this->put('/{id}',  ArticuloController::class . ':update');
    $this->delete('/{id}',  ArticuloController::class . ':delete');
    $this->get('/{id}/autor', ArticuloController::class . ':showautor');   
});

//-------------------------------------------------------------------------------------------------------------------

$app->group('/autores', function () {
    $this->get('', AutorController::class . ':index');
    $this->get('/{id}', AutorController::class . ':show');   
    $this->post('', AutorController::class . ':create');
    $this->put('/{id}',  AutorController::class . ':update');
    $this->delete('/{id}',  AutorController::class . ':delete');
    $this->get('/{id}/articulos', AutorController::class . ':showarticulos');
});