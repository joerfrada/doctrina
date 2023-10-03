<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ArticuloController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LogsController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\UsuarioController;

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

Route::post('login', [LoginController::class, 'login']);
Route::group(['prefix' => 'auth'], function() {
    Route::post('getConsultarImagenFuncionario', [LoginController::class, 'getConsultarImagenFuncionario']);
});

Route::group(['prefix' => 'articulo'], function() {
    Route::get('getArticulos', [ArticuloController::class, 'getArticulos']);
    Route::post('crearArticulos', [ArticuloController::class, 'crearArticulos']);
    Route::post('actualizarArticulos', [ArticuloController::class, 'actualizarArticulos']);
    Route::post('eliminarArticulo', [ArticuloController::class, 'eliminarArticulo']);
});

Route::group(['prefix' => 'categoria'], function() {
    Route::get('getCategorias', [CategoriaController::class, 'getCategorias']);
    Route::post('crearCategorias', [CategoriaController::class, 'crearCategorias']);
    Route::post('actualizarCategorias', [CategoriaController::class, 'actualizarCategorias']);
    Route::post('eliminarCategoria', [CategoriaController::class, 'eliminarCategoria']);
});

Route::group(['prefix' => 'config'], function() {
    Route::get('getSettings', [SettingsController::class, 'getSettings']);
});

Route::group(['prefix' => 'logs'], function() {
    Route::get('getLogs', [LogsController::class, 'getLogs']);
});

Route::group(['prefix' => 'home'], function() {
    Route::get('getStats', [HomeController::class, 'getStats']);
});

Route::group(['prefix' => 'usuario'], function() {
    Route::get('getUsuarios', [UsuarioController::class, 'getUsuarios']);
});