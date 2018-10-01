<?php

//FRONTEND ROUTES 
Route::get('/', 'indexController@index');
Route::get('/catalog/category/view/{id?}', 'catalog\CategoryController@view');
Route::get('/catalog/product/view/{id?}', 'catalog\ProductController@view');
Route::post('/catalog/product/addtocart', 'catalog\ProductController@addtocart');

//CUSTOMER
Route::get('/customer/login', 'CustomerController@login');
Route::get('/customer/logout', 'CustomerController@logout');
Route::get('/customer/create', 'CustomerController@create');
Route::post('/customer/save', 'CustomerController@store');
Route::post('/customer/checklogin', 'CustomerController@checklogin');
Route::post('/customer/address/save', 'CustomerController@addressSave');

//CART ROUTES
Route::get('/cart', 'checkout\CartController@index');
Route::get('/cart/checkout', 'checkout\CartController@checkout');

// ADMIN HOME ROUTES
Route::get('admin/dashboard', 'adminController@dashboard');
Route::get('admin', 'adminController@dashboard');
Route::get('admin/login', 'adminController@login');

// ADMIN PRODUCT ROUTES
Route::get('admin/product/index', 'productController@index');
Route::get('admin/product/new', 'productController@new');
Route::post('admin/product/save', 'productController@save');
Route::get('admin/product/edit', 'productController@edit');

// ADMIN CATEGORY ROUTES
Route::get('admin/category/index', 'categoryController@index');
Route::get('admin/category/add', 'categoryController@add');
Route::post('admin/category/save', 'categoryController@save');
Route::get('admin/category/edit', 'categoryController@edit');

// ADMIN ATTRIBUTE ROUTES
Route::get('admin/attributeset/index', 'attributesetController@index');
Route::get('admin/attributeset/new', 'attributesetController@new');
Route::post('admin/attributeset/save', 'attributesetController@save');

Route::get('admin/attribute/index', 'attributeController@index');
Route::get('admin/attribute/new', 'attributeController@new');
Route::post('admin/attribute/save', 'attributeController@save');
Route::get('admin/attribute/edit/{id?}', 'attributeController@edit');
Route::get('admin/attribute/delete/{id?}', 'attributeController@delete');


	