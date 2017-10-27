<?php
namespace src\lib;
use PDO;
use FluentPDO;

include 'config.php';

class Database{

    public static function getConection(){
        $pdo = new PDO (DSN, USER, PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        return new FluentPDO($pdo);
    }

}