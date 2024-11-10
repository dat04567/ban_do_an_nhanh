<?php



$router->get('/', 'HomeController@index');
$router->get('/cart', 'CartController@index');
$router->get('/checkout', 'CartController@checkout');


$router->get('home/{id}', 'HomeController@showId');
$router->get('/shop', 'ShopController@index');







