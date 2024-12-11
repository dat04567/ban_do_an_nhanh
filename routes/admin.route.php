<?php



$router->get('/admin', 'admin::DashboardController@index');
$router->get('/admin/foods', 'admin::FoodController@index');

// Thêm món ăn
$router->get('/admin/foods/create', 'admin::FoodController@create', ['AuthMiddleware']);
$router->post('/admin/foods/create', 'admin::FoodController@store', ['AuthMiddleware']);
$router->post('/admin/foods/insert-product-ingredient', 'admin::FoodController@insertTempProductIngredients',['AuthMiddleware']);
$router->get('/admin/foods/get-all-products-ingredients', 'admin::FoodController@getAllTempProductIngredients');
$router->post('/admin/foods/upload-temp-product-image', 'admin::FoodController@uploadTempProduct', ['AuthMiddleware']);
$router->get('/admin/foods/get-all-images', 'admin::FoodController@getAllImages');

$router->get('/admin/categories', 'admin::CategoryController@index');
// Thêm món ăn
$router->get('/admin/categories/create', 'admin::CategoryController@create');
$router->post('/admin/categories/create', 'admin::CategoryController@store');
// xoá món ăn
$router->post('/admin/categories/{id}', 'admin::CategoryController@destroy');


$router->get('/admin/customers', 'admin::CustomerController@index');
$router->get('/admin/staffs', 'admin::StaffController@index');
$router->get('/admin/orders', 'admin::OrderController@index');


// Nguyên liệu 
$router->get('/admin/ingredients', 'admin::IngredientController@index');

//  Thêm nguyên liệu
$router->get('/admin/ingredients/create', 'admin::IngredientController@create');
$router->post('/admin/ingredients/create', 'admin::IngredientController@store');

// Xoá nguyên liệu
$router->post('/admin/ingredients/{id}', 'admin::IngredientController@destroy');



// KHO NGUYÊN LIỆU 
$router->get('/admin/inventory-ingredients', 'admin::InventoryIngredientController@index');
$router->post('/admin/inventory-ingredients', 'admin::InventoryIngredientController@destroy');

// Thêm kho nguyên liệu
$router->get('/admin/inventory-ingredients/import', 'admin::InventoryIngredientController@create');
$router->post('/admin/inventory-ingredients/import', 'admin::InventoryIngredientController@store');

// API kho nguyên liệu
$router->get('/api/inventory-ingredients', 'api::InventoryIngredientController@index');



$router->get('/admin/sub-categories', 'admin::CategoryController@showSubCategories');
// Thêm danh mục con
$router->get('/admin/sub-categories/create', 'admin::CategoryController@createSubCategory');
$router->post('/admin/sub-categories/create', 'admin::CategoryController@storeSubCategory');
// Xoá danh mục con
$router->post('/admin/sub-categories/{id}', 'admin::CategoryController@destroySubCategory');


// Danh sách cửa hàng
$router->get('/admin/stores', 'admin::StoreController@index');
// Thêm cửa hàng
$router->get('/admin/stores/create', 'admin::StoreController@create');
$router->post('/admin/stores/create', 'admin::StoreController@store');


// Xoá cửa hàng
$router->post('/admin/stores/{id}', 'admin::StoreController@destroy');


// danh sach kho sản phẩm

$router->get('/admin/inventory-products', 'admin::InventoryProductController@index');

$router->get('/admin/inventory-products/import', 'admin::InventoryProductController@create');
$router->post('/admin/inventory-products/import', 'admin::InventoryProductController@store');






// api 
$router->get('/api/stores', 'api::StoreController@index');
