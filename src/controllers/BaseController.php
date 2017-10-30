<?php
namespace src\controllers;
use Psr\Container\ContainerInterface;


abstract class BaseController{
    
    protected $container;
    
       // constructor receives container instance
       public function __construct($container) {
           $this->container = $container;
       }
          

}