<?php

use \Slim\Middleware\HttpBasicAuthentication\PdoAuthenticator;
use \Slim\Middleware\JwtAuthentication;

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
        }
        
    ]);
};

$container["JwtAuthentication"] = function ($container) {
    return new JwtAuthentication([
        "path" => "/",
        "passthrough" => ["/token","/status"],
        "secret" => getenv("JWT_SECRET"),
        //"logger" => $container["logger"],
        "attribute" => false,
        "relaxed" => ["localhost"],
        "error" => function ($request, $response, $arguments) {
            //print_r( $request);
            return $response->withJson(array('error'=>'No tiene autorizacion'), 401);
            //return new UnauthorizedResponse($arguments["message"], 401);
        },
        "callback" => function ($request, $response, $arguments) use ($container) {
            print_r($arguments["decoded"]);
            //$container["token"]->hydrate($arguments["decoded"]);
        }
    ]);
};
$app->add("JwtAuthentication");
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