<?php

namespace App\Http\Controllers\EventoControllers;

use App\Http\Controllers\Controller;
use App\Models\EventosModels\TipoEventoModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TipoEventoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return TipoEventoModel::where('estado', 2)->get();
    }

    public function tipoEventoPendietes()
    {
        return TipoEventoModel::where('estado', 1)->get();
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        TipoEventoModel::create($request->all());
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

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $tipoEvent = TipoEventoModel::find($id);
        if($tipoEvent){
            $tipoEvent->update(['estado' => $request->estado]);
        }
        return response()->json([
            'msg' => 'Actulizado con exito'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
