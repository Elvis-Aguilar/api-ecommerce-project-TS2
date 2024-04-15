<?php

namespace App\Http\Controllers\OtrosControllers;

use App\Http\Controllers\Controller;
use App\Models\OtrosModels\Divisa;
use Illuminate\Http\Request;

class DivisaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Divisa::first();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function update(Request $request, int $id)
    {
        $divisa = Divisa::find($id);
        if ($divisa){
            $divisa->update($request->all());
        }
        return response()->json($divisa, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
