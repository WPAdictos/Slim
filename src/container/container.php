<?php
use \src\models\ArticulosModel;
use \src\models\AutoresModel;
use \src\lib\Persona;
use \src\lib\Marca;
use \src\lib\Token;

require_once BASE_PATH . '/src/config/'.ENTORNO.'/configDB.php';

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

$container['marca'] = function ($container) {
    $marca = new Marca();
    return $marca;
};

/*
Ejemplos y modos
    $this->logger->addInfo("Something interesting happened"); 
    $this->logger->addDebug("Se ha jodido todo");
    addError

*/
$container['logger'] = function($container) {
    $logger = new \Monolog\Logger('logger');
    $file_handler = new \Monolog\Handler\StreamHandler(BASE_PATH . "/logs/app.log");
    $logger->pushHandler($file_handler);
    return $logger;
};

$container['pdo'] = function ($container) {
    //$container['logger']->addInfo("DSN=", array('dsn' => DSN));
    $pdo = new PDO (DSN, USER, PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
};

$container["token"] = function ($container) {
    return new Token;
};

$container['notFoundHandler'] = function($container) {
    return function ($request, $response) use ($container) {
        return $container['response']
            ->withStatus(404)
            ->withHeader('Content-Type', 'application/json')
            ->write(json_encode(['error' => 'Resource not valid']));
    };
};

$container['notAllowedHandler'] = function($container) {
    return function ($request, $response) use ($container) {
        return $container['response']
            ->withStatus(401)
            ->withHeader('Content-Type', 'application/json')
            ->write(json_encode(['error' => 'Method not allowed']));
    };
};

$container['errorHandler'] = function($container) {
    return function ($request, $response, $exception = null) use ($container) {
        $code = 500;
        $message = 'There was an error';

        if ($exception !== null) {
            $code = $exception->getCode();
            $message = $exception->getMessage();
        }

        // Use this for debugging purposes
        //error_log($exception->getMessage().' in '.$exception->getFile().' - ('
        //    .$exception->getLine().', '.get_class($exception).')');

        return $container['response']
            ->withStatus($code)
            ->withHeader('Content-Type', 'application/json')
            ->write(json_encode([
                'success' => false,
                'error' => $message
            ]));
    };

};

