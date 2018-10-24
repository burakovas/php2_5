<?php
include $_SERVER['DOCUMENT_ROOT'] . "/../config/main.php";
include $_SERVER['DOCUMENT_ROOT'] . "/../services/Autoloader.php";

// сделать выборочный update - только изменившихся полей, 
// контроллер корзины с 1 экшном - вывод корзины

spl_autoload_register([new \app\services\Autoloader(), 'loadClass']);

$product = new \app\models\Product();

//$product = $product->getOne(23);

//$product->name = "users prod 7";
$product->delete(31);
//$product->save();

var_dump($product->getAll());
