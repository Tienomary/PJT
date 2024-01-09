<?php
require './config.php';
require './vendor/autoload.php';

$uri = $_SERVER['REQUEST_URI'];
$router = new AltoRouter();

$router->map('GET', '/', 'home');
$router->map('GET', '/espacemembre/', './espacemembre/index');
$router->map('GET', '/espacemembre/inscription', './espacemembre/inscription');
$router->map('GET', '/product-[i:id]', 'product');

$router->map('POST', '/connexion', 'connexion');

$match = $router->match();

switch ($match){
    case '/connexion':
        echo ('ok');
        break;
    default: 
        require "./{$match['target']}.php";
        break;

}
