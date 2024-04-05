<?php

namespace App\Http\Controllers\ProductoControllers;

use App\Http\Controllers\Controller;
use App\Models\EventosModels\Evento;
use App\Models\EventosModels\RechazoEvento;
use App\Models\ProductosModels\ConfiabilidadUsuario;
use App\Models\ProductosModels\Producto;
use App\Models\ProductosModels\RechazoProducto;
use Illuminate\Http\Request;

class RechazoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        RechazoProducto::create($request->all());
        $producto = Producto::find($request->producto_id);
        if($producto){
            $producto->update(['estado' => 3]);
        }
        return response()->json([
            'msg' => 'Registrado con exito',
        ], 200);
    }


    /**
     * funcion para registrar El rechazo de los eventos
     */
    public function storeEvento(Request $request)
    {
        RechazoEvento::create($request->all());
        $evento = Evento::find($request->evento_id);
        if($evento){
            $evento->update(['estado' => 3]);
        }
        return response()->json([
            'msg' => 'Registrado con exito',
        ], 200);
    }

    /**
     * funcion para aceptar un producto, aumenta aprobados en la tabla de confiabilidad
     */
    public function acept(Request $request)
    {
        $producto = Producto::find($request->producto_id);
        if($producto){
            $producto->update(['estado' => 2]);
        }
        $confiabilidad = ConfiabilidadUsuario::where('usuario_id', $request->usuario_id)->first();
        if ($confiabilidad){
            $aumento = $confiabilidad->usuario_aprobados + 1;
            $confiabilidad->update(['usuario_aprobados' => $aumento]);
        }else{
            ConfiabilidadUsuario::create([
                'usuario_id' => $request->usuario_id,
                'usuario_aprobados' => $request->usuario_aprobados
            ]);
        }
        return response()->json([
            'msg' => 'Registrado con exito',
        ], 200);
    }

    /**
     * funcion para aceptar un evento, aumenta los aprobados en la tabla de confiabilidad
     */
    public function aceptEvento(Request $request)
    {
        $evento = Evento::find($request->evento_id);
        if($evento){
            $evento->update(['estado' => 2]);
        }
        $confiabilidad = ConfiabilidadUsuario::where('usuario_id', $request->usuario_id)->first();
        if ($confiabilidad){
            $aumento = $confiabilidad->usuario_aprobados + 1;
            $confiabilidad->update(['usuario_aprobados' => $aumento]);
        }else{
            ConfiabilidadUsuario::create([
                'usuario_id' => $request->usuario_id,
                'usuario_aprobados' => $request->usuario_aprobados
            ]);
        }
        return response()->json([
            'msg' => 'Registrado con exito',
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $rechazoProducto =  RechazoProducto::where('producto_id', $id)->first();
        return response()->json((
        $rechazoProducto)
            , 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
