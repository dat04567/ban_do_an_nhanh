<?php



$router->get('/', 'client::HomeController@index');
$router->get('/cart', 'client::CartController@index');
$router->get('/checkout', 'client::CartController@checkout');
$router->post('/cart/add', 'client::CartController@addToCart');
$router->get('/cart/info', 'client::CartController@getCartInfo');
$router->post('/cart/update', 'client::CartController@updateCartQuantity');

$router->get('home/{id}', 'HomeController@showId');
$router->get('/shop', 'client::ShopController@index');







