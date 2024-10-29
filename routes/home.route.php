<?php



$router->get('/', 'HomeController@index');
$router->get('/sign-in', 'HomeController@index');
$router->get('home/:id', 'HomeController@showId');



