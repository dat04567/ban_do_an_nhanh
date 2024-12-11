<?php



$router->get('/sign-up', 'client::UserController@signUp');
$router->get('/sign-in', 'client::UserController@signIn');

$router->get('/forgot-password', 'client::UserController@forgotPassword');



$router->post('/sign-in', 'client::UserController@login');
$router->post('/sign-up', 'client::UserController@store');
$router->post('/sign-out', 'client::UserController@logout');