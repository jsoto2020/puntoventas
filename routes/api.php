<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::resource('/invtipos', 'InvtiposController');

Route::get('/invtipos{ tipo }', 'InvtiposController@show');

Route::resource('/invproductos', 'InvProductos');
Route::get('/invproductos{ producto }', 'InvProductos@show');

Route::resource('/invgrupos', 'InvgruposController');

Route::get('/invgrupos{ grupo }', 'InvgruposController@show');

Route::resource('/categorias', 'CategoriasController');

Route::get('/categorias{ categoria  }', 'CategoriasController@show');


Route::resource('/brands', 'BrandsController');

Route::get('/brands{ brand  }', 'BrandsController@show');



Route::get('/atributos{ atributo  }', 'atributosController@show');

Route::resource('/atributos', 'atributosController');
