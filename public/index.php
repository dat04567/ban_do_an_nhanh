<?php
require __DIR__ . '/../vendor/autoload.php';
use Framework\Router;


require '../helpers.php';


$router = new Router();


loadRoutes('home');
loadRoutes('admin');
loadRoutes('user');


// Get current URI and HTTP method
$uri = parse_url($_SERVER['REQUEST_URI']);

// Route the request
$router->route();

