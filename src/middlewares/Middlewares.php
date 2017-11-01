<?php

use \Slim\Middleware\HttpBasicAuthentication\PdoAuthenticator;

//Force SSL
if(FORCE_HTTPS === 'true'){
    $app->add(function ($request,   $response, $next) {
        if ($request->getUri()->getScheme() !== 'https') {
            $uri = $request->getUri()->withScheme("https")->withPort(null);  
            return $response->withRedirect( (string)$uri );
        } else {
            return $next($request, $response);
        }
    });
}


$container["HttpBasicAuthentication"] = function ($container) {
    $pdo=$container['pdo'];
    return new \Slim\Middleware\HttpBasicAuthentication([
        "path" => ["/token"],
        "realm" => "Protected",
        "secure" => true,
        "relaxed" => ["localhost"],
        "authenticator" => new PdoAuthenticator([
            "pdo" => $pdo,
            "table" => "accounts",
            "user" => "username",
            "hash" => "hashed"
        ]),
        "error" => function ($request, $response, $arguments) {
            return $response->withJson(array('error'=>'Credenciales incorrectas'), 403);
        },
        "callback" => function ($request, $response, $arguments) {
            //print_r($arguments);
            //$response->withoutHeader("WWW-Authenticate");
            return $response;
        }
    ]);
};
$app->add("HttpBasicAuthentication");

/*
$app->add(new \Slim\Middleware\HttpBasicAuthentication([
    "path" => ["/token"],
    "realm" => "Protected",
    "secure" => true,
    "relaxed" => ["localhost"],
    "users" => [
        "root" => "root"      
    ],
    "error" => function ($request, $response, $arguments) {
        return $response->withJson(array('error'=>'Credenciales incorrectas'), 403);
    },
    "callback" => function ($request, $response, $arguments) {
        print_r($arguments);
        //$response->withoutHeader("WWW-Authenticate");
        return $response;
    }
]));

*/

$mw = function ($request, $response, $next) {
    $response->getBody()->write('llamada antes de la accion <br>');
    //$autores= $this->get('AutoresModel');  //Ejemplo de acceso al container
    //le pasamos una variable por el request a la accion
    $request = $request->withAttribute('test', 'kaka');
    $response = $next($request, $response);
    $response->getBody()->write('<br> llamada despues de la accion');

    return $response;
};