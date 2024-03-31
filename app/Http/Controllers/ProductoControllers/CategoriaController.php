<?php

namespace App\Http\Controllers\ProductoControllers;

use App\Http\Controllers\Controller;
use App\Models\ProductosModels\Categoria;
use App\Models\ProductosModels\CategoriaProducto;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Categoria::where('estado', 2)->get();
    }

    public function categoriesPendietes()
    {
        return Categoria::where('estado', 1)->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Categoria::create($request->all());
        return response()->json([
            'msg' => 'Registrado con exito'
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function categoriaProducto(int $id){
        $categoriaProducto = CategoriaProducto::where('producto_id', $id)->with('categoria')->get();
        return $categoriaProducto;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $categoria = Categoria::find($id);
        if($categoria){
            $categoria->update(['estado' => $request->estado]);
        }
        return response()->json([
            'msg' => 'Actulizado con exito'
        ], 200);
    }

    public function destroyCategoriaProducto(int $id){
        $categoriaProducto = CategoriaProducto::find($id);
        $idProducto = 0;
        if($categoriaProducto){
            $idProducto = $categoriaProducto->producto_id;
            $categoriaProducto->delete();
        }
        $categoriaProductos = CategoriaProducto::where('producto_id', $idProducto)->with('categoria')->get();
        return $categoriaProductos;
    }

    public function storeCategoriaProducto(Request $request, int $id){
        CategoriaProducto::create([
            'producto_id' => $request->estado,
            'categoria_id' => $request->categoria_id
        ]);
        $categoriaProducto = CategoriaProducto::where('producto_id', $id)->with('categoria')->get();
        return $categoriaProducto;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
