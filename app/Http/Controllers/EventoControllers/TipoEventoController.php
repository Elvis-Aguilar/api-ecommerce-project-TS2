<?php

namespace App\Http\Controllers\EventoControllers;

use App\Http\Controllers\Controller;
use App\Models\EventosModels\ControlTipoEvento;
use App\Models\EventosModels\TipoEvento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TipoEventoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return TipoEvento::where('estado', 2)->get();
    }

    public function tipoEventoPendietes()
    {
        return TipoEvento::where('estado', 1)->get();
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        TipoEvento::create($request->all());
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
        $tipoEvento = ControlTipoEvento::where('evento_id', $id)->with('tipoEvento')->get();
        return $tipoEvento;
    }

    public function eventoCategoria(int $id)
    {
        $tipoEvento = ControlTipoEvento::where('tipo_evento_id', $id)
            ->with(['evento' => function($query){
                $query->where('estado',2)->orderBy('evento_id', 'desc')->take(6);
            }])->orderBy('evento_id', 'desc')->get();

        return $tipoEvento;
    }


    public function destroyTipoEvento(int $id){
        $controlTipoEvento = ControlTipoEvento::find($id);
        $idEvento = 0;
        if($controlTipoEvento){
            $idEvento = $controlTipoEvento->evento_id;
            $controlTipoEvento->delete();
        }
        $controlTipoEventos = ControlTipoEvento::where('evento_id', $idEvento)->with('tipoEvento')->get();
        return $controlTipoEventos;
    }

    public function storeTipoEvento(Request $request, int $id){
        ControlTipoEvento::create([
            'evento_id' => $request->evento_id,
            'tipo_evento_id' => $request->tipo_even_id,
        ]);
        $controlTipoEvento = ControlTipoEvento::where('evento_id', $id)->with('tipoEvento')->get();
        return $controlTipoEvento;
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $tipoEvent = TipoEvento::find($id);
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
