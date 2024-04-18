<?php

namespace App\Http\Controllers\ProductoControllers;

use App\Http\Controllers\Controller;
use App\Models\ProductosModels\Producto;
use App\Models\ProductosModels\TruequeProductoServicio;
use Illuminate\Http\Request;

class TruequeProductoServicioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        TruequeProductoServicio::create($request->all());
        return response()->json([
            'msg' => 'Registrado con exito',
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $trueques = TruequeProductoServicio::where('usuario_oferta_id', $id)
            ->where('estado', 1)
            ->with('productoIntercambiar')
            ->with('servicioIntercambiar')
            ->get();

        return $trueques;
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $trueque = TruequeProductoServicio::find($request->trueque_producto_servicio_id);
        if ($trueque){
            $trueque->update(['estado' => $request->estado]);
            if($trueque->estado == 2){
                $this->updateProductoSoli($request);
            }
        }
        $trueques = TruequeProductoServicio::where('usuario_oferta_id', $request->usuario_oferta_id)
            ->where('estado', 1)
            ->with('productoIntercambiar')
            ->with('servicioIntercambiar')
            ->get();

        return $trueques;
    }

    private  function updateProductoSoli(Request $request)
    {
        $producto = Producto::find($request->producto_intercambiar_id);
        if ($producto){
            $calculoDescuento = $producto->cantidad_exit-$request->cantidad_producto;
            $producto->update(['cantidad_exit'=> $calculoDescuento]);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
