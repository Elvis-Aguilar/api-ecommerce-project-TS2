<?php

namespace App\Http\Controllers\ProductoControllers;

use App\Http\Controllers\Controller;
use App\Models\ProductosModels\Producto;
use App\Models\ProductosModels\TruequeProducto;
use Illuminate\Http\Request;

class TruequeProductoController extends Controller
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
        TruequeProducto::create($request->all());
        return response()->json([
            'msg' => 'Registrado con exito',
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $trueques = TruequeProducto::where('usuario_propietario_id', $id)
            ->where('estado', 1)->with('usuarioSolicitante')
            ->with('productoSolicitado')
            ->with('productoAdar')
            ->get();

        return $trueques;
    }

    public function showPersonal(int $id)
    {
        $trueques = TruequeProducto::where('usuario_solicitante_id', $id)
            ->with('usuarioPropietario')
            ->with('productoSolicitado')
            ->with('productoAdar')
            ->get();

        return $trueques;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $trueque = TruequeProducto::find($request->trueque_producto_id);
        if ($trueque){
            $trueque->update(['estado' => $request->estado]);
            if ($trueque->estado == 2){
                $this->updateProductoDar($request);
                $this->updateProductoSoli($request);
            }
        }
        $trueques = TruequeProducto::where('usuario_propietario_id', $request->usuario_propietario_id)
            ->where('estado', 1)->with('usuarioSolicitante')
            ->with('productoSolicitado')
            ->with('productoAdar')
            ->get();
        return $trueques;
    }

    private  function updateProductoSoli(Request $request)
    {
        $producto = Producto::find($request->producto_solicitado_id);
        if ($producto){
            $calculoDescuento = $producto->cantidad_exit-$request->cantdad_solicitar;
            $producto->update(['cantidad_exit'=> $calculoDescuento]);
        }
    }
    private  function updateProductoDar(Request $request)
    {
        $producto = Producto::find($request->producto_intercambiar_id);
        if ($producto){
            $calculoDescuento = $producto->cantidad_exit-$request->cantidad_dar;
            $producto->update(['cantidad_exit' => $calculoDescuento]);
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
