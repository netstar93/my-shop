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

Route::get('/', 'IndexController@index');
Route::get('/test', 'IndexController@test');
Route::post('/test/response', 'IndexController@response');

Route::get('/services', function(){
	return view('pages.services');
});

Route::get('/customer', 'CustomerController@index')->middleware('validateCustomer');
Route::get('/customer/create', 'CustomerController@create')->name('createCustomer');
Route::get('/customer/login', 'CustomerController@login')->name('loginCustomer');
Route::get('/customer/logout', 'CustomerController@logout')->name('logoutCustomer');
Route::post('/customer/save', 'CustomerController@store');
Route::post('/customer/checklogin', 'CustomerController@checklogin');
Route::post('/customer/address/save', 'CustomerController@addressSave');
Route::post('/customer/address/saveinline', 'CustomerController@saveAddressPage');
Route::get('/customer/address/get/{id?}', 'CustomerController@getAddress');
Route::get('/customer/address/getAddress_html', 'CustomerController@getAddressHtml');
Route::get('/customer/dashboard', 'CustomerController@index')->middleware('validateCustomer');


Route::get('cart', 'Checkout\CartController@index');
Route::get('/cart/checkout', 'Checkout\CartController@checkout');
Route::post('/cart/checkout', 'Checkout\CartController@checkout');
Route::post('/cart/order/save', 'Checkout\OrderController@save');
Route::post('/cart/order/payment', 'Checkout\OrderController@processPayment');
Route::post('/cart/order/pay_response', 'Checkout\OrderController@pay_response');
Route::post('/cart/remove/{product_id?}', 'Checkout\CartController@delete');
Route::get('/cart/order/success', 'Checkout\CartController@success');

Route::get('catalog/category/view/{id}/{filters?}', 'Catalog\CategoryController@view');
Route::get('catalog/product/filter/{filters?}', 'Catalog\ProductController@filter');
Route::post('catalog/product/addtocart', 'Catalog\ProductController@addtocart');
Route::get('catalog/product/view/{id}', 'Catalog\ProductController@view') ->middleware('bootstrap');
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

// ADMIN HOME ROUTES
Route::get('admin/dashboard', 'adminController@dashboard');
Route::get('admin', 'adminController@dashboard');
Route::get('admin/login', 'adminController@login');

// ADMIN PRODUCT ROUTES
Route::get('admin/product/index', 'productController@index');
Route::get('admin/product/new', 'productController@new');
Route::post('admin/product/save', 'productController@save');
Route::get('admin/product/duplicate/{product_id?}', 'productController@duplicate');
Route::get('admin/product/edit/{id?}', 'productController@edit');
Route::get('admin/product/delete/{id?}', 'productController@delete');
Route::get('admin/product/getFormhtml/{id?}', 'productController@getFormhtml');

// ADMIN CATEGORY ROUTES
Route::get('admin/category/index', 'categoryController@index');
Route::get('admin/category/new', 'categoryController@add');
Route::post('admin/category/save', 'categoryController@save');
Route::get('admin/category/edit/{id?}', 'categoryController@edit');
Route::get('admin/category/delete/{id?}', 'categoryController@delete');

// ADMIN ATTRIBUTE ROUTES
Route::get('admin/attributeset/index', 'attributesetController@index');
Route::get('admin/attributeset/new', 'attributesetController@new');
Route::post('admin/attributeset/save', 'attributesetController@save');
Route::get('admin/attributeset/edit/{id?}', 'attributesetController@edit');
Route::get('admin/attributeset/delete/{id?}', 'attributesetController@delete');

Route::get('admin/attribute/index', 'attributeController@index');
Route::get('admin/attribute/new', 'attributeController@new');
Route::post('admin/attribute/save', 'attributeController@save');
Route::get('admin/attribute/edit/{id?}', 'attributeController@edit');
Route::get('admin/attribute/delete/{id?}', 'attributeController@delete');
Route::get('admin/attribute/list', 'attributeController@list');
//ADMIN BANNER
Route::post('admin/banner/save', 'bannerController@save');
Route::get('admin/banner/new', 'bannerController@new');
Route::get('admin/banner/delete', 'bannerController@delete');
Route::resource('admin/banner', 'bannerController');

//ADMIN SALES
Route::get('admin/order', 'Sales\OrderController@index');
Route::get('admin/order/index', 'Sales\OrderController@index');
Route::get('admin/order/view/{id?}', 'Sales\OrderController@view');
Route::post('admin/order/add_comment', 'Sales\OrderController@addComment');
Route::post('admin/order/update/{status?}', 'Sales\OrderController@update');

