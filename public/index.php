<?php
include $_SERVER['DOCUMENT_ROOT'] . "/../config/main.php";
include $_SERVER['DOCUMENT_ROOT'] . "/../services/Autoloader.php";


// сделать save, выборочный update - только изменившихся полей, контроллер корзины с 1 экшном - вывод корзины

spl_autoload_register([new \app\services\Autoloader(), 'loadClass']);

$controllerName = $_GET['c'] ?: DEFAULT_CONTROLLER;
$actionName = $_GET['a'];

$controllerClass = CONTROLLERS_NAMESPACE . "\\" . ucfirst($controllerName) . "Controller";

if(class_exists($controllerClass)){
  $controller = new $controllerClass;
  $controller->run($actionName);
}
