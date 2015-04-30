<?php
//portada
Route::get('/', ['as' => 'home', 'uses' => 'HomeController@showWelcome']);
Route::post('/', ['as' => 'home', 'uses' => 'UsuarioController@postIndex']);
Route::get('/logout', ['as' => 'home', 'uses' => 'UsuarioController@getLogout']);
Route::get('/actualizar-informacion', ['as' => 'home', 'uses' => 'UsuarioController@getActualizacion']);
Route::post('/actualizar-informacion', ['as' => 'home', 'uses' => 'UsuarioController@postActualizacion']);

//Ecommerce comp
Route::get('categoria/{id}', ['as' => 'categoria', 'uses' => 'EcommerceController@showCategoria']);
Route::get('producto/{id}', ['as' => 'producto', 'uses' => 'EcommerceController@showProducto']);
Route::get('summary', ['as' => 'summary', 'uses' => 'EcommerceController@showSummary']);
Route::get('pedidos', ['as' => 'pedidos', 'uses' => 'EcommerceController@showPedidos']);
Route::post('checkout', ['as' => 'checkout', 'uses' => 'EcommerceController@showCheckout']);
Route::get('pdf/{id}', ['as' => 'pdf', 'uses' => 'EcommerceController@printPDF']);


//JSON
Route::get('json/{catid}/{page}', ['as' => 'json', 'uses' => 'EcommerceController@getJson']);

//Wish list
Route::post('wishlistset/{user}', ['as' => 'wishlistset', 'uses' => 'EcommerceController@setwishlist']);
Route::get('wishlistget/{user}', ['as' => 'wishlistget', 'uses' => 'EcommerceController@getwishlist']);


//Comment
Route::put('comment', ['as' => 'comment', 'uses' => 'CommentsController@save']);
Route::post('rate', ['as' => 'rate', 'uses' => 'CommentsController@rate']);


//Buscador
Route::post('buscar', ['as' => 'buscar', 'uses' => 'BuscarController@buscar']);