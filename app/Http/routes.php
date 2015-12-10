<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'HomeController@index');
Route::get('/products/{id}', 'HomeController@getViewProduct');
Route::get('/category/{id}', 'HomeController@getViewCategories');
Route::get('/subcategory/{id}', 'HomeController@getViewSubCategories');
Route::get('/avtochasti/{id}', 'HomeController@getViewModels');

/*
| -------------------------------------------------------------------------
| General Search
| -------------------------------------------------------------------------
*/

Route::get('/search', 'HomeController@searchProducts');

/*
| -------------------------------------------------------------------------
| Profile
| -------------------------------------------------------------------------
*/

Route::get('/profile/{id}', [
	'middleware' => 'auth',
	'uses' => '\App\Http\Controllers\AuthController@getProfile',
]);

Route::post('/profile/{id}/update', [
	'middleware' => 'auth',
	'uses' => '\App\Http\Controllers\AuthController@updateProfile',
]);

Route::post('/profile/{id}/changePassword', [
	'middleware' => 'auth',
	'uses' => '\App\Http\Controllers\AuthController@changePassProfile',
]);

/*
| -------------------------------------------------------------------------
| Register and Login users
| -------------------------------------------------------------------------
*/

Route::get('/register', [
	'uses' => '\App\Http\Controllers\AuthController@getRegister',
	'as' => 'pages.register',
]);

Route::get('/login', [
	'uses' => '\App\Http\Controllers\AuthController@getLogin',
]);

Route::post('/register', [
	'uses' => '\App\Http\Controllers\AuthController@postRegister',
]);

Route::post('/login', [
	'uses' => '\App\Http\Controllers\AuthController@postLogin',
]);

Route::get('/logout', [
	'uses' => '\App\Http\Controllers\AuthController@logout',
]);

/*
| -------------------------------------------------------------------------
| Admin Panel
| -------------------------------------------------------------------------
*/

Route::get('/admin', [
	'uses' => '\App\Http\Controllers\AuthController@getAdminLogin',
]);

Route::post('/admin/login', [
	'uses' => '\App\Http\Controllers\AuthController@postAdminLogin',
]);

Route::get('/admin/dashboard', [
	'middleware' => 'auth',
	'uses' => '\App\Http\Controllers\AdminController@getDashboard',
]);

/*
| -------------------------------------------------------------------------
| Products Management
| -------------------------------------------------------------------------
*/

Route::get('/admin/add-products/', [
	'middleware' => 'auth',
	'uses' => '\App\Http\Controllers\AdminController@getAddProduct',
]);

Route::post('/admin/add-products/add', [
	'middleware' => 'auth',
	'uses' => '\App\Http\Controllers\AdminController@postAddProduct',
]);

Route::get('/ajax-subcat', [
	'uses' => '\App\Http\Controllers\AdminController@filterCategories',
]);

Route::get('/ajax-model', [
	'uses' => '\App\Http\Controllers\AdminController@filterModels',
]);

Route::get('/admin/list-products', [
	'middleware' => 'auth',
	'uses' => '\App\Http\Controllers\AdminController@listProducts',
]);

Route::get('/admin/list-products/edit/{id}', [
	'middleware' => 'auth',
	'uses' => '\App\Http\Controllers\AdminController@editProducts',
]);

Route::post('/admin/list-products/update/{id}', [
	'middleware' => 'auth',
	'uses' => '\App\Http\Controllers\AdminController@updateProducts',
]);

Route::post('/admin/list-products/edit/{id}/delete', [
	'middleware' => 'auth',
	'uses' => '\App\Http\Controllers\AdminController@deleteProducts',
]);

Route::post('/admin/list-products/upload/{id}', [
	'middleware' => 'auth',
	'uses' => '\App\Http\Controllers\AdminController@uploadImage',
]);

Route::post('/admin/list-products/delete', [
	'middleware' => 'auth',
	'uses' => '\App\Http\Controllers\AdminController@deleteImage',
]);

/*
| -------------------------------------------------------------------------
| Product Categories Management
| -------------------------------------------------------------------------
*/

Route::get('/admin/categories', [
	'middleware' => 'auth',
	'uses' => '\App\Http\Controllers\AdminController@getCategories',
]);

Route::post('/admin/categories/add', [
	'middleware' => 'auth',
	'uses' => '\App\Http\Controllers\AdminController@createCategories',
]);

Route::post('/admin/categories/update/{id}', [
	'middleware' => 'auth',
	'uses' => '\App\Http\Controllers\AdminController@updateCategories',
]);

Route::post('/admin/categories/delete/{id}', [
	'middleware' => 'auth',
	'uses' => '\App\Http\Controllers\AdminController@deleteCategories',
]);

Route::get('/admin/sub-categories', [
	'middleware' => 'auth',
	'uses' => '\App\Http\Controllers\AdminController@getSubCategories',
]);

Route::post('/admin/sub-categories/add', [
	'middleware' => 'auth',
	'uses' => '\App\Http\Controllers\AdminController@createSubCategories',
]);

Route::post('/admin/sub-categories/update/{id}', [
	'middleware' => 'auth',
	'uses' => '\App\Http\Controllers\AdminController@updateSubCategories',
]);

Route::post('/admin/sub-categories/delete/{id}', [
	'middleware' => 'auth',
	'uses' => '\App\Http\Controllers\AdminController@deleteSubCategories',
]);

/*
| -------------------------------------------------------------------------
| Brands and Models Management
| -------------------------------------------------------------------------
*/

Route::get('/admin/brands', [
	'middleware' => 'auth',
	'uses' => '\App\Http\Controllers\AdminController@getBrands',
]);

Route::post('/admin/brands/add', [
	'middleware' => 'auth',
	'uses' => '\App\Http\Controllers\AdminController@createBrands',
]);

Route::post('/admin/brands/update/{id}', [
	'middleware' => 'auth',
	'uses' => '\App\Http\Controllers\AdminController@updateBrands',
]);

Route::post('/admin/brands/delete/{id}', [
	'middleware' => 'auth',
	'uses' => '\App\Http\Controllers\AdminController@deleteBrands',
]);

Route::get('/admin/models', [
	'middleware' => 'auth',
	'uses' => '\App\Http\Controllers\AdminController@getModels',
]);

Route::post('/admin/models/add', [
	'middleware' => 'auth',
	'uses' => '\App\Http\Controllers\AdminController@createModels',
]);

Route::post('/admin/models/update/{id}', [
	'middleware' => 'auth',
	'uses' => '\App\Http\Controllers\AdminController@updateModels',
]);

Route::post('/admin/models/delete/{id}', [
	'middleware' => 'auth',
	'uses' => '\App\Http\Controllers\AdminController@deleteModels',
]);

Route::get('/admin/orders', [
	'middleware' => 'auth',
	'uses' => '\App\Http\Controllers\AdminController@getOrders',
]);

Route::post('/admin/orders/update/{id}', [
	'middleware' => 'auth',
	'uses' => '\App\Http\Controllers\AdminController@confirmOrders',
]);

/*
| -------------------------------------------------------------------------
| Shopping cart
| -------------------------------------------------------------------------
*/

Route::get('order/cart', 'ShoppingCartController@getCart');
Route::post('order/cart/add', 'ShoppingCartController@addToCart');
Route::post('order/cart/destroy', 'ShoppingCartController@destroyCart');
Route::post('order/cart/remove/{rowid}', 'ShoppingCartController@removeFromCart');
Route::post('order/checkout', 'ShoppingCartController@checkOut');

/*
| -------------------------------------------------------------------------
| Profile orders
| -------------------------------------------------------------------------
*/

Route::get('profile/{id}/orders', 'HomeController@getProfileOrders');

/*
| -------------------------------------------------------------------------
| Blog / News section
| -------------------------------------------------------------------------
*/

Route::get('/blog', 'HomeController@getBlog');

Route::get('/admin/blog', 'AdminController@getCreatePost');
Route::get('/blog/view/{id}', 'HomeController@viewPost');
Route::post('/admin/blog/create', 'AdminController@CreatePost');
Route::post('/admin/blog-post/delete/{id}', 'AdminController@deletePost');

/*
| -------------------------------------------------------------------------
| Contacts
| -------------------------------------------------------------------------
*/

Route::get('/contacts', 'HomeController@getContacts');
Route::get('/admin/contacts', 'AdminController@getContacts');
Route::post('/admin/contacts/update/{id}', 'AdminController@updateContacts');