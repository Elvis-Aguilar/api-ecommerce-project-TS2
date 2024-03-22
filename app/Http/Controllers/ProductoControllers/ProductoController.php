<?php

namespace App\Http\Controllers\ProductoControllers;

use App\Http\Controllers\Controller;
use App\Models\ProductosModels\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
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
        Producto::create([
            'nombre' => $request-> nombre,
            'usuario_vendedor' => $request->usuario_vendedor,
            'descripcion' => $request->descripcion,
            'especificaciones' => $request->especificaciones,
            'moneda_sistema' => $request->moneda_sistema,
            'cantidad_exit' => $request->cantidad_exit,
            'url_foto' => $request->url_foto,
            'permite_contactar' => $request->permite_contactar,
            'permite_trueque' => $request->permite_trueque,
            'moneda_local' => $request->moneda_local
        ]);
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
        $rutaImagen = $archivo->storeAs('public/productos', $nombreImagen);

        // Retornar la ruta completa de la imagen guardada
        return Storage::url($rutaImagen);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $productos = Producto::where('usuario_vendedor',$id)->get();
        return response()->json((
            $productos
        ), 200);

    }


    public function imge(string $id)
    {
       $path = storage_path(path: 'app/public/productos/' . $id);

        if (Storage::exists($path)) {
            abort(404);
        }

        return response()->file($path);

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
