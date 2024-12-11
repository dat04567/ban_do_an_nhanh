<?php
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../config/_db.php';

use Framework\Router;
use Framework\SessionManager;

require '../helpers.php';




// Start session
SessionManager::getInstance();





$router = new Router();



$router->addNamespace('client', 'App\Controllers\Client');
loadRoutes('home');
loadRoutes('admin');
loadRoutes('user');


// Get current URI and HTTP method
$uri = parse_url($_SERVER['REQUEST_URI']);

// Enable output compression
if (extension_loaded('zlib')) {
   ob_start('ob_gzhandler');
}
// Route the request
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
$router->route();
