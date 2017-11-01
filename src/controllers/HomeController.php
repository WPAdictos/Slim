<?php
namespace src\controllers;


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

        return "HomeController:token";
    }
}