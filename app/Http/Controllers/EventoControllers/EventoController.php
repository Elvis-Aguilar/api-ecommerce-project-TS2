<?php

namespace App\Http\Controllers\EventoControllers;

use App\Http\Controllers\Controller;
use App\Models\EventosModels\ControlTipoEvento;
use App\Models\EventosModels\Evento;
use App\Models\ProductosModels\ConfiabilidadUsuario;
use App\Models\ProductosModels\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventoController extends Controller
{
    /**
     * obtener todos los eventos publicados y que esten aprobado estado = 2
     */
    public function index()
    {
        return Evento::where('estado', 2)
            ->orderBy('evento_id', 'desc')
            ->take(12)
            ->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $userConfiable = ConfiabilidadUsuario::where('usuario_id',$request->usuario_publicador)->first();
        if($userConfiable){
            if($userConfiable->usuario_aprobados >= $userConfiable->min_aprobados){
                $this->createEventoAprobado($request);
            }else{
                $this->createEventoPendiente($request);
            }
        }else{
            //usuario aun no ha publicado ningun evento por lo tanto no esta registrado en la tabla confiabilidad
            $this->createEventoPendiente($request);
            ConfiabilidadUsuario::create([
                'usuario_id' => $request->usuario_publicador,
                'usuario_aprobados' => 0
            ]);
        }

        return response()->json([
            'msg' => 'Registrado con exito'
        ], 200);
    }

    private function createEventoPendiente(Request $request){
        $evento = Evento::create([
            'nombre' => $request->nombre,
            'usuario_publicador' => $request->usuario_publicador,
            'descripcion' => $request->descripcion,
            'permite_contactar' => $request->permite_contactar,
            'es_voluntariado' => $request->es_voluntariado,
            'remunerar_moneda_local' => $request->remunerar_moneda_local,
            'remunerar_moneda_sitema' => $request->remunerar_moneda_sitema,
            'max_participantes' => $request->max_participantes,
            'lugar_realizacion' => $request->lugar_realizacion,
            'url_foto' => $request->url_foto,
            'fecha_realizacion' => $request->fecha_realizacion
        ]);
        $eventoId = $evento->evento_id;
        ControlTipoEvento::create([
            'evento_id' => $eventoId,
            'tipo_evento_id' => $request->tipo_evento
        ]);
    }

    private function createEventoAprobado(Request $request){
        $evento = Evento::create([
            'estado' => 2,
            'nombre' => $request->nombre,
            'usuario_publicador' => $request->usuario_publicador,
            'descripcion' => $request->descripcion,
            'permite_contactar' => $request->permite_contactar,
            'es_voluntariado' => $request->es_voluntariado,
            'remunerar_moneda_local' => $request->remunerar_moneda_local,
            'remunerar_moneda_sitema' => $request->remunerar_moneda_sitema,
            'max_participantes' => $request->max_participantes,
            'lugar_realizacion' => $request->lugar_realizacion,
            'url_foto' => $request->url_foto,
            'fecha_realizacion' => $request->fecha_realizacion
        ]);
        $eventoId = $evento->evento_id;
        ControlTipoEvento::create([
            'evento_id' => $eventoId,
            'tipo_evento_id' => $request->tipo_evento
        ]);
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
        $rutaImagen = $archivo->storeAs('public/eventos', $nombreImagen);

        // Retornar la ruta completa de la imagen guardada
        return Storage::url($rutaImagen);
    }

    /**
     * funcion para devolver todos los eventos publicados de un usuario
     * @param int $id es el id del usuario
     */
    public function show(int $id)
    {
        $evento = Evento::where('usuario_publicador',$id)->orderBy('evento_id', 'desc')->get();
        return response()->json((
        $evento
        ), 200);
    }

    /**
     * funcion para devolver la imagen registrada
     */
    public function imge(string $id)
    {
        $path = storage_path(path: 'app/public/eventos/' . $id);
        if (Storage::exists($path)) {
            abort(404);
        }
        return response()->file($path);
    }

    /**
     * funcion para obtener los eventos pendientes de confirmar o rechazar
     */
    public function eventosPendientes(){
        $eventos = Evento::where('estado', 1)
            ->with('usuario')
            ->get();

        return $eventos;
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
