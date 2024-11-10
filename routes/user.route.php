<?php

$router->get('/sign-up', 'UserController@signUp');
$router->get('/sign-in', 'UserController@signIn');
$router->get('/forgot-password', 'UserController@forgotPassword');



$router->post('/sign-up', 'UserController@store');