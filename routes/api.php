<?php

use App\Http\Controllers\EventoControllers\EventoController;
use App\Http\Controllers\EventoControllers\TipoEventoController;
use App\Http\Controllers\OtrosControllers\DivisaController;
use App\Http\Controllers\ProductoControllers\CategoriaController;
use App\Http\Controllers\ProductoControllers\ProductoController;
use App\Http\Controllers\ProductoControllers\RechazoController;
use App\Http\Controllers\ProductoControllers\TruequeProductoController;
use App\Http\Controllers\ServicioControllers\OfertaController;
use App\Http\Controllers\ServicioControllers\ServicioController;
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
Route::get('user/{id}', [UsuarioController::class,'show']);
Route::get('cuenta-monetaria/{id}', [UsuarioController::class,'getCuentaMonetaria']);
Route::put('update-cuenta-monetaria/{id}', [UsuarioController::class,'updateCuentaMonetaria']);



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
Route::get('productos/categoria-producto/{id}', [CategoriaController::class,'categoriaProducto']);
Route::delete('productos/delete-categoria-producto/{id}', [CategoriaController::class,'destroyCategoriaProducto']);
Route::post('productos/asociar-categoria-producto/{id}', [CategoriaController::class,'storeCategoriaProducto']);
Route::put('productos/update-producto/{id}', [ProductoController::class,'update']);
Route::get('productos/get-rechazo/{id}', [RechazoController::class,'show']);
Route::get('productos/get-productos-filter-categoria/{id}', [CategoriaController::class,'productoCategoria']);
Route::get('productos/get-productos-filter-form-pago/{id}', [ProductoController::class,'indexFilterFormPago']);
Route::post('productos/save-report-producto', [ProductoController::class,'reportarProducto']);
Route::get('productos/get-reportes-productos', [ProductoController::class,'getReporteProductos']);
Route::put('productos/update-reporte-producto/{id}', [ProductoController::class,'updateReporte']);
Route::get('productos/get-reportes-producto/{id}', [ProductoController::class,'getReporteProducto']);
Route::put('productos/baja-producto/{id}', [ProductoController::class,'bajaProducto']);
Route::post('productos/save-compra-producto', [ProductoController::class,'comprarProducto']);
//rutas para el trueque de productos
Route::post('productos/save-trueque-producto', [TruequeProductoController::class,'store']);
Route::get('productos/get-trueques-producto-res/{id}', [TruequeProductoController::class,'show']);
Route::put('productos/update-trueque-producto', [TruequeProductoController::class,'update']);
Route::get('productos/get-trueques-producto/{id}', [TruequeProductoController::class,'showPersonal']);


//ruta para Eventos
Route::get('eventos/tipo-eventos', [TipoEventoController::class,'index']);
Route::post('eventos/evento-save-image', [EventoController::class,'saveImage']);
Route::post('eventos/evento-save', [EventoController::class,'store']);
Route::get('eventos/eventos-pendientes', [EventoController::class,'eventosPendientes']);
Route::post('eventos/rechazo-evento', [RechazoController::class,'storeEvento']);
Route::put('eventos/acept-evento', [RechazoController::class,'aceptEvento']);
Route::get('eventos/eventos-user/{id}', [EventoController::class,'show']);
Route::get('eventos/eventos-img/{id}', [EventoController::class,'imge']);
Route::get('eventos/get-rechazo/{id}', [RechazoController::class,'showEvent']);
Route::post('eventos/tipo-evento-save', [TipoEventoController::class,'store']);
Route::get('eventos/tipo-evento-pendientes', [TipoEventoController::class,'tipoEventoPendietes']);
Route::put('eventos/update-tipo-evento/{id}', [TipoEventoController::class,'update']);
Route::get('eventos/get-eventos', [EventoController::class,'index']);
Route::get('eventos/get-evento/{id}', [EventoController::class,'showById']);
Route::get('eventos/get-eventos-filter-tipo/{id}', [TipoEventoController::class,'eventoCategoria']);
Route::get('eventos/get-eventos-filter-form-pago/{id}', [EventoController::class,'indexFilterFormPago']);
Route::get('eventos/tipo-evento/{id}', [TipoEventoController::class,'categoriaProducto']);
Route::delete('eventos/delete-tipo-evento/{id}', [TipoEventoController::class,'destroyTipoEvento']);
Route::post('eventos/asociar-tipo-evento/{id}', [TipoEventoController::class,'storeTipoEvento']);
Route::put('eventos/update-evento/{id}', [EventoController::class,'update']);
Route::post('eventos/save-report-evento', [EventoController::class,'reportarEvento']);
Route::get('eventos/get-reportes-eventos', [EventoController::class,'getReporteEventos']);
Route::post('eventos/add-evento-list', [EventoController::class,'storeLista']);
Route::get('eventos/get-lista-eventos/{id}', [EventoController::class,'getlistasId']);
Route::put('eventos/update-evento-list', [EventoController::class,'updateListaId']);
Route::put('eventos/update-evento-lists', [EventoController::class,'updateLista']);
Route::put('eventos/gratificar-evento-lists', [EventoController::class,'gratificarLista']);


//rutas para el area de servicios
Route::post('servicios/servicio-save-image', [ServicioController::class,'saveImage']);
Route::post('servicios/servicio-save', [ServicioController::class,'store']);
Route::get('servicios/servicios-user/{id}', [ServicioController::class,'show']);
Route::get('servicios/servicios-img/{id}', [ServicioController::class,'imge']);
Route::get('servicios/get-servicios', [ServicioController::class,'index']);
Route::get('servicios/get-servicio/{id}', [ServicioController::class,'showById']);
//apartado para ofertas del servicio
Route::post('servicios/save-oferta', [OfertaController::class,'store']);
Route::get('servicios/get-servicios-user/{id}', [OfertaController::class,'show']);
Route::put('servicios/update-oferta', [OfertaController::class,'update']);



//rutas para la divisa
Route::get('divisa/get-divisa', [DivisaController::class,'index']);
Route::put('divisa/update-divisa/{id}', [DivisaController::class,'update']);





