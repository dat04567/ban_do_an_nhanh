<?php

$router->get('/admin', 'DashboardController@index');
$router->get('/admin/foods','FoodController@index');
$router->get('/admin/categories','CategoryController@index');
$router->get('/admin/customers','CustomerController@index');   
$router->get('/admin/staffs','StaffController@index');
$router->get('/admin/orders','OrderController@index');
$router->get('/admin/inventory','InventoryController@index');
$router->get('/admin/ingredients','IngredientController@index');
$router->get('/admin/sub-categories','CategoryController@showSubCategories');
$router->get('/admin/stores','StoreController@index');





