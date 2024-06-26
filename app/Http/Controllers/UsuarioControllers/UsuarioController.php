<?php

namespace App\Http\Controllers\UsuarioControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UsuarioRequests\RegistrarUsuarioRequest;
use App\Models\UsuarioModels\CuentaMonetaria;
use App\Models\UsuarioModels\Usuario;
use App\Models\UsuarioModels\UsuarioInfoContacto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Usuario::all();
    }

    public function logUser(Request $request){
        $usuario = Usuario::where('nombre_usuario', $request->username)->first();
        if($usuario && $usuario->contrasenia == $request->password){
            return response()->json((
                $usuario
            ), 200);
        }
        return response()->json((
            null
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

          $infoContacto = UsuarioInfoContacto::create([
          'url_facebook' => $request['url_facebook'],
          'url_instagram' => $request['url_instagram'],
          'url_linkedin' => $request['url_linkedin'],
          'url_telegram' => $request['url_telegram'],
          'number_whatsapp' => $request['number_whatsapp'],
          'correo' => $request['correo'],
          ]);

          $infoContactoId = $infoContacto->id;

          $usuario = Usuario::create([
          'nombre_completo' => $request['nombre_completo'],
          'contrasenia' => $request['contrasenia'],
          'nombre_usuario' => $request['nombre_usuario'],
          'url_foto' => $request['url_foto'],
          'info_contacto' =>$infoContactoId,
          'rol' => $request['rol'],
          ]);

        //se crea su cuanta valores en 0 y 10
        CuentaMonetaria::create([
            'usuario_id' => $usuario->usuario_id,
            'moneda_ms' => 5
        ]);


        return response()->json((
            $usuario
        ), 200);
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
        $rutaImagen = $archivo->storeAs('public', $nombreImagen);

        // Retornar la ruta completa de la imagen guardada
        return Storage::url($rutaImagen);
    }

    public function imge(string $id)
    {
        $path = storage_path(path: 'app/public/' . $id);

        if (Storage::exists($path)) {
            abort(404);
        }

        return response()->file($path);

    }


    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $usuario = Usuario::where('usuario_id',$id)->first();
        return response()->json((
        $usuario)
            , 200);
    }

    public function getCuentaMonetaria(int $id)
    {
        $cuentamonetaria = CuentaMonetaria::where('usuario_id', $id)->first();
        return $cuentamonetaria;
    }

    public function updateCuentaMonetaria(Request $request, int $id)
    {
        $cuentamonetaria = CuentaMonetaria::find($id);
        if ($cuentamonetaria){
            $cuentamonetaria->update($request->all());
        }
        return CuentaMonetaria::find($id);;
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
