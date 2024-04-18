<?php

namespace App\Http\Controllers\ServicioControllers;

use App\Http\Controllers\Controller;
use App\Models\ServiciosModels\Oferta;
use App\Models\ServiciosModels\Servicio;
use App\Models\UsuarioModels\CuentaMonetaria;
use Illuminate\Http\Request;

class OfertaController extends Controller
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
        Oferta::create($request->all());
        return response()->json([
            'msg' => 'Registrado con exito'
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $servicios = Oferta::where('usuario_propietario_id', $id)
            ->where('estado', 1)
            ->with('usuarioOfertante')
            ->get();
        return $servicios;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $oferta = Oferta::find($request->oferta_id);
        if ($oferta) {
            $oferta->update(['estado'=> $request->estado]);
            if ($oferta->estado == 2){
                $this->transaccionPago($request);
            }
        }
        $servicios = Oferta::where('usuario_propietario_id', $request->usuario_propietario_id)
            ->where('estado', 1)
            ->with('usuarioOfertante')
            ->get();
        return $servicios;
    }

    private  function transaccionPago(Request $request)
    {
        $cuentaMonetariaDEs = CuentaMonetaria::where('usuario_id', $request->usuario_propietario_id)->first();
        $cuentaMonetariaAumet = CuentaMonetaria::where('usuario_id', $request->usuario_ofertante_id)->first();
        if ($request->servicio_id == 1){
            $calculo =$cuentaMonetariaDEs->moneda_ms - $request->moneda_ms;
            $calculo1 = $cuentaMonetariaAumet->moneda_ms + $request->moneda_ms;
            $cuentaMonetariaDEs->update(['moneda_ms'=> $calculo]);
            $cuentaMonetariaAumet->update(['moneda_ms'=> $calculo1]);
        }else{
            $cuentaMonetariaDEs->update(['moneda_local'=> $cuentaMonetariaDEs->moneda_ms - $request->moneda_local]);
            $cuentaMonetariaAumet->update(['moneda_local'=> $cuentaMonetariaAumet->moneda_ms + $request->moneda_local]);
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
