<?php
namespace src\controllers;

use Firebase\JWT\JWT;
use Tuupola\Base62;
use DateTime;

class HomeController extends BaseController{

    public function index($request, $response, $args)
    {
        return $response->withJson(array('mensaje'=>'API funcionando...'), 200);
    }

    public function test($request, $response, $args)
    {
        $marca= $this->container->get('marca');
        $marca->setNombre("Colacao");
        $marca->setMarcasAlternativas(array(
            'mercadona' => 'Cacao en polvo',
            'Nesquik'   => 'Cacao soluble'
        ));
        print_r( $marca->getMarcasAlternativas());
        die();
        return "Test";
    }

    public function token ($request, $response, $args){
        $now = new DateTime();
        $future = new DateTime("now +2 minutes");
        $server = $request->getServerParams();
        
        $jti = (new Base62)->encode(random_bytes(16));
        $payload = [
            "iat" => $now->getTimeStamp(),
            "exp" => $future->getTimeStamp(),
            "jti" => $jti,
            "sub" => $server["PHP_AUTH_USER"],
            "scope" => "Aqui va la autorizacion"
        ];
        $secret = getenv("JWT_SECRET");
        $token = JWT::encode($payload, $secret, "HS256");
        $data["token"] = $token;
        $data["expires"] = $future->getTimeStamp();
        $data["status"] ="Ok";

        //print_r($request->getParsedBody());
        return $response->withJson($data, 201);
    }
}