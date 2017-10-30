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
      
        return  "AutorController:show";
    }

    public function create($request, $response, $args){
        return "AutorController:create";
    }

    public function update($request, $response, $args){
        return "AutorController:update";
    }

    public function delete($request, $response, $args){
        return "AutorController:delete";        
    }

}
