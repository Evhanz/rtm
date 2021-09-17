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
// 'auth.jwt'
Route::middleware([ 'dynamic'])->group(function () {
    Route::get('me', 'AuthController@me');
    Route::get('all-access', 'AccesoController@getAccess');
    Route::post('logout', 'AuthController@logout');
    Route::prefix('user-management')->group(function () {
        Route::get('users', 'UsuarioController@index');
        Route::get('users/{id}', 'UsuarioController@show');
        Route::put('users/{id}', 'UsuarioController@update');
    });
});
Route::middleware('dynamic')->group(function () {
    Route::post('login', 'AuthController@login');
});
Route::prefix('empresa')->group(function () {
    Route::get('/', 'EmpresaController@index');
});
