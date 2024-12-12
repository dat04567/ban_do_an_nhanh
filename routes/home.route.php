<?php



$router->get('/', 'client::HomeController@index');
$router->get('/cart', 'client::CartController@index', ['AuthMiddleware']);
$router->get('/checkout', 'client::CheckoutController@index', ['AuthMiddleware', 'CheckoutMiddleware']);


$router->post('/cart/add', 'client::CartController@addToCart');
$router->get('/cart/info', 'client::CartController@getCartInfo');
$router->post('/cart/update', 'client::CartController@updateCartQuantity');


$router->post('/address/add', 'client::AddressController@store');
$router->get('/address/list', 'client::AddressController@getShippingAddress', ['AuthMiddleware']);



$router->get('home/{id}', 'HomeController@showId');
$router->get('/shop', 'client::ShopController@index');







