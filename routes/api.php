<?php

use App\Http\Controllers\ProductoControllers\CategoriaController;
use App\Http\Controllers\ProductoControllers\ProductoController;
use App\Http\Controllers\ProductoControllers\RechazoController;
use App\Http\Controllers\UsuarioControllers\UsuarioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//rutas para el usuario
Route::post('user-register', [UsuarioController::class,'store']);
Route::post('user-register-foto', [UsuarioController::class,'saveImage']);
Route::get('users', [UsuarioController::class, 'index']);
Route::post('user-login', [UsuarioController::class,'logUser']);
Route::get('user-img/{id}', [UsuarioController::class,'imge']);


//rutas para las producto
Route::get('productos/categories', [CategoriaController::class,'index']);
Route::get('productos/categories-pendientes', [CategoriaController::class,'categoriesPendietes']);
Route::put('productos/update-categoria/{id}', [CategoriaController::class,'update']);
Route::post('productos/producto-save-image', [ProductoController::class,'saveImage']);
Route::post('productos/producto-save', [ProductoController::class,'store']);
Route::get('productos/productos-user/{id}', [ProductoController::class,'show']);
Route::get('productos/get-productos', [ProductoController::class,'index']);
Route::get('productos/productos-img/{id}', [ProductoController::class,'imge']);
Route::get('productos/get-procuto/{id}', [ProductoController::class,'showById']);
Route::post('productos/categoria-save', [CategoriaController::class,'store']);
Route::get('productos/productos-pendientes', [ProductoController::class,'productosPendientes']);
Route::post('productos/rechazo-producto', [RechazoController::class,'store']);
Route::put('productos/acept-producto', [RechazoController::class,'acept']);


