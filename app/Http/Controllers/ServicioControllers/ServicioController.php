<?php

namespace App\Http\Controllers\ServicioControllers;

use App\Http\Controllers\Controller;
use App\Models\ServiciosModels\Servicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServicioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Servicio::where('estado', 2)
            ->orderBy('servicio_id', 'desc')
            ->take(12)
            ->get();
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Servicio::create($request->all());
        return response()->json([
            'msg' => 'Registrado con exito'
        ], 200);
    }

    public function saveImage(Request $request)
    {
        $imagen = null;
        if ($request->hasFile('imagen')) {
            // Obtener el archivo adjunto
            $archivo = $request->file('imagen');

            // Guardar la imagen
            $imagen = $this->guardarImagen($archivo);
        } else {
            $imagen = 'no hay ruta';
        }

        return response()->json([
            'res' => true,
            'msg' => 'Guardado con éxito',
            'url_foto' => $imagen
        ]);
    }

    private function guardarImagen($archivo)
    {
        // Guardar la imagen en el almacenamiento local
        $nombreImagen = 'imagen_' . time() . '.' . $archivo->getClientOriginalExtension(); // Generar un nombre único para la imagen
        $rutaImagen = $archivo->storeAs('public/servicios', $nombreImagen);

        // Retornar la ruta completa de la imagen guardada
        return Storage::url($rutaImagen);
    }


    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $servicios = Servicio::where('usuario_publicador',$id)->orderBy('servicio_id', 'desc')->get();
        return response()->json((
        $servicios
        ), 200);
    }

    public function imge(string $id)
    {
        $path = storage_path(path: 'app/public/servicios/' . $id);
        if (Storage::exists($path)) {
            abort(404);
        }
        return response()->file($path);
    }

    public function showById(int $id)
    {
        $evento = Servicio::where('servicio_id',$id)->first();
        return response()->json((
        $evento)
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
