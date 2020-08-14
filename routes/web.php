<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::match(['get','post'], '/admin', 'AdminController@login');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// index
Route::get('/','IndexController@index');

// Pagina de Listado de categorias
Route::get('/products/{url}','ProductsController@products');

// Pagina de detalle de producto
Route::get('/product/{id}','ProductsController@product');

//pagina carrito
Route::match(['get','post'], '/cart', 'ProductsController@cart');

// Añadir ruta de carrito
Route::match(['get','post'], '/add-cart', 'ProductsController@addtocart');

//Eliminar producto del carrito
Route::get('/cart/delete-product/{id}','ProductsController@deleteCartProduct');

//Actualizar Cantidad de Producto en carrito
Route::get('/cart/update-quantity/{id}/{quantity}','ProductsController@updateCartQuantity');

//Obtener atributo precio de pr0ducto
Route::get('/get-product-price','ProductsController@getProductPrice');

//Formulario de registro de user
Route::get('/login-register','UsersController@userLoginRegister');

//Pagina de registro y logeo
Route::post('/user-register','UsersController@register');

//Form de login de usuario
Route::post('/user-login','UsersController@login');

//Salir del usuario
Route::get('/user-logout','UsersController@logout');

//Rutas despues del login
Route::group(['middleware' => ['frontlogin']], function(){
	//Pagina de Cuenta de usuario
	Route::match(['get', 'post'], 'account', 'UsersController@account');
	//Verificar la contraseña actual
	Route::post('/check-user-pwd', 'UsersController@chkUserPassword');
	//Actualizar pass de usuario
	Route::post('/update-user-pwd', 'UsersController@updatePassword');
	//Revisar productos CheckOut
	Route::match(['get', 'post'], 'checkout', 'ProductsController@checkout');
	//Pagina de Revision de pedido
	Route::match(['get', 'post'], '/order-review', 'ProductsController@orderReview');
});

//Verificar email en login
Route::match(['GET','POST'], '/check-email', 'UsersController@checkEmail');

Route::group(['middleware' => ['auth']], function(){
	Route::get('/admin/dashboard', 'AdminController@dashboard');
	Route::get('/admin/settings', 'AdminController@settings');
	Route::get('/admin/check-pwd', 'AdminController@chkPassword');
	Route::match(['get', 'post'], '/admin/update-pwd', 'AdminController@updatePassword');

	//Rutas de Categorias(ADmin)
	Route::match(['get','post'], '/admin/add-category', 'CategoryController@addCategory');
	Route::match(['get','post'], '/admin/edit-category/{id}', 'CategoryController@editCategory');
	Route::match(['get','post'], '/admin/delete-category/{id}', 'CategoryController@deleteCategory');
	Route::get('/admin/view-categories', 'CategoryController@viewCategories');

	//Rutas de Product
	Route::match(['get','post'], '/admin/add-product', 'ProductsController@addProduct');
	Route::match(['get','post'], '/admin/edit-product/{id}', 'ProductsController@editProduct');
	Route::get('/admin/view-products', 'ProductsController@viewProducts');
	Route::get('/admin/delete-product/{id}', 'ProductsController@deleteProduct');
	Route::get('/admin/delete-product-image/{id}', 'ProductsController@deleteProductImage');

	//Rutas de Atributos de Producto
	Route::match(['get','post'], '/admin/add-attributes/{id}', 'ProductsController@addAttributes');
	Route::match(['get','post'], '/admin/edit-attributes/{id}', 'ProductsController@editAttributes');
	Route::get('/admin/delete-attribute/{id}', 'ProductsController@deleteAttribute');

});

Route::get('/logout', 'AdminController@logout');
