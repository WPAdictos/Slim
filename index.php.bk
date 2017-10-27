<?php
/*
Recursos:
https://github.com/envms/fluentpdo
http://anexsoft.com/p/119/tutorial-de-fluentpdo-para-php
https://www.sitepoint.com/getting-started-fluentpdo/

*/
require "./vendor/autoload.php";
use src\models\ArticulosModel;
use src\models\AutoresModel;

$autores= new AutoresModel();
//Consulta basica
echo "Listado de todos los autores....<br>";
print_r($autores->getAll());

echo "<hr>";


$articulos= new ArticulosModel();

//Consulta basica
echo "Listado de todos los articulos....<br>";
print_r($articulos->getAll());

echo "<br>Listado de un articulo por ID=2 ...<br>";
print_r($articulos->findById(2));

echo "<br>Listado de un articulo con INNER JOIN.<br>";
print_r($articulos->getAllComplete());

//echo "<br>Insertamos un registro nuevo (Devuelve el nuevo ID).<br>";
//$values=array(
//  "titulo" => "Historia de Rumania",
//  "autores_id" => 1,
//  "categoria" => "Historia"
//);

//print_r($articulos->insert($values));

echo "<br>Actualizamos el registro 3.<br>";
$values=array(
  "categoria" => "Kaka"
);
print_r($articulos->update($values,3));

