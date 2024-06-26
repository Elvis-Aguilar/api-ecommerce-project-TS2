<?php

namespace App\Http\Controllers\ProductoControllers;

use App\Http\Controllers\Controller;
use App\Models\OtrosModels\ReportePublicacion;
use App\Models\ProductosModels\Categoria;
use App\Models\ProductosModels\CategoriaProducto;
use App\Models\ProductosModels\CompraProducto;
use App\Models\ProductosModels\ConfiabilidadUsuario;
use App\Models\ProductosModels\Producto;
use App\Models\ProductosModels\RechazoProducto;
use App\Models\UsuarioModels\CuentaMonetaria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Producto::where('estado', 2)
            ->orderBy('producto_id', 'desc')
            ->take(12)
            ->get();
    }

    public function indexFilterFormPago(int $id)
    {
        return match ($id) {
            1 => Producto::where('estado', 2)
                ->where('moneda_sistema', '>', 0)
                ->orderBy('producto_id', 'desc')
                ->take(12)
                ->get(),
            2 => Producto::where('estado', 2)
                ->where('moneda_local', '>', 0)
                ->orderBy('producto_id', 'desc')
                ->take(12)
                ->get(),
            3 => Producto::where('estado', 2)
                ->where('permite_trueque', '>', 0)
                ->orderBy('producto_id', 'desc')
                ->take(12)
                ->get(),
            default => Producto::where('estado', 2)
                ->orderBy('producto_id', 'desc')
                ->take(12)
                ->get(),
        };


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $userConfiable = ConfiabilidadUsuario::where('usuario_id',$request->usuario_vendedor)->first();
        if($userConfiable){
            if($userConfiable->usuario_aprobados >= $userConfiable->min_aprobados){
                 $this->createProductoAprobado($request);
            }else{
                 $this->createProductoPendiente($request);
            }
        }else{
            $this->createProductoPendiente($request);
            ConfiabilidadUsuario::create([
                'usuario_id' => $request->usuario_vendedor,
                'usuario_aprobados' => 0
            ]);
        }

        return response()->json([
            'msg' => 'Registrado con exito'
        ], 200);
    }

    private function createProductoAprobado(Request $request){
        $producto = Producto::create([
            'nombre' => $request-> nombre,
            'usuario_vendedor' => $request->usuario_vendedor,
            'descripcion' => $request->descripcion,
            'especificaciones' => $request->especificaciones,
            'moneda_sistema' => $request->moneda_sistema,
            'cantidad_exit' => $request->cantidad_exit,
            'url_foto' => $request->url_foto,
            'permite_trueque' => $request->permite_trueque,
            'permite_contactar'=> $request->permite_contactar,
            'moneda_local' => $request->moneda_local,
            'estado' => 2
        ]);
        $prodcutoId = $producto->producto_id;

        CategoriaProducto::create([
            'producto_id' => $prodcutoId,
            'categoria_id' => $request->categoria
        ]);
    }

    private function  createProductoPendiente(Request $request)
    {
        $producto = Producto::create([
            'nombre' => $request-> nombre,
            'usuario_vendedor' => $request->usuario_vendedor,
            'descripcion' => $request->descripcion,
            'especificaciones' => $request->especificaciones,
            'moneda_sistema' => $request->moneda_sistema,
            'cantidad_exit' => $request->cantidad_exit,
            'url_foto' => $request->url_foto,
            'permite_trueque' => $request->permite_trueque,
            'permite_contactar'=> $request->permite_contactar,
            'moneda_local' => $request->moneda_local
        ]);
        $prodcutoId = $producto->producto_id;

        CategoriaProducto::create([
            'producto_id' => $prodcutoId,
            'categoria_id' => $request->categoria
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
        $rutaImagen = $archivo->storeAs('public/productos', $nombreImagen);

        // Retornar la ruta completa de la imagen guardada
        return Storage::url($rutaImagen);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $productos = Producto::where('usuario_vendedor',$id)->orderBy('producto_id', 'desc')->get();
        return response()->json((
            $productos
        ), 200);

    }

    public function showCategoria(int $id)
    {
        $productos = Producto::where('usuario_vendedor',$id)->orderBy('producto_id', 'desc')->get();
        return response()->json((
        $productos
        ), 200);

    }

    public function showById(int $id)
    {
        $productos = Producto::where('producto_id',$id)->first();
        return response()->json((
        $productos)
        , 200);

    }

    public function imge(string $id)
    {
       $path = storage_path(path: 'app/public/productos/' . $id);

        if (Storage::exists($path)) {
            abort(404);
        }

        return response()->file($path);

    }

    public function productosPendientes(){
        $productos = Producto::where('estado', 1)
            ->with('usuario')
            ->get();

        return $productos;
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $producto = Producto::find($id);
        if ($producto){
            $producto->update($request->all());
        }
        return response()->json([
            'msg' => 'Actulizado con exito'
        ], 200);
    }

    public function reportarProducto(Request $request)
    {
        ReportePublicacion::create([
            'producto_id' => $request->producto_id,
            'descripcion' => $request->descripcion
        ]);
        return response()->json([
            'msg' => 'Producto reportado'
        ], 200);
    }

    public function  getReporteProductos()
    {
        $reportePublicacion = ReportePublicacion::where('estado', 1)
            ->whereNotNull('producto_id')
            ->with('producto')
            ->get();

        return $reportePublicacion;

    }

    public function  getReporteProducto(int $id)
    {
        $reportePublicacion = ReportePublicacion::whereNotNull('producto_id')
            -> where('producto_id', $id)
            ->with('producto')
            ->get();

        return $reportePublicacion;

    }

    public function updateReporte(Request $request, int $id)
    {
        $reporte = ReportePublicacion::find($id);
        if ($reporte){
            $reporte->update($request->all());
        }
        return response()->json([
            'msg' => 'Actulizado con exito'
        ], 200);
    }

    public function bajaProducto(Request $request, int $id)
    {
        $producto = Producto::find($id);
        if ($producto){
            $producto->update(['estado' => $request->estado]);
        }
        return response()->json([
            'msg' => 'Actulizado con exito'
        ], 200);
    }

    public function comprarProducto(Request $request)
    {
        if ($this->saveCompra($request) && $this->descontarCantidadProducto($request)){
            $this->updateCuentaMonetaria($request);
            $this->updateCuentaMonedaAumento($request);
        }
        return response()->json([
            'msg' => 'Actulizado con exito'
        ], 200);
    }

    private function saveCompra(Request $request)
    {
        $compra = CompraProducto::create([
            'usuario_comprador_id' => $request->usuario_comprador_id,
            'usuario_vendedor_id' => $request->usuario_vendedor_id,
            'producto_id' => $request->producto_id,
            'cantidad_comprado' => $request->cantidad_comprado,
            'total_moneda_ms' => $request->total_moneda_ms,
            'total_moneda_local' => $request->total_moneda_local,
            'fecha_compra' => $request->fecha_compra
        ]);
        return $compra;
    }

    private  function descontarCantidadProducto(Request $request)
    {
        $producto = Producto::find($request->producto_id);
        if ($producto){
            $cantidad =  $producto->cantidad_exit - $request->cantidad_comprado;
            $producto->update([
                'cantidad_exit' => $cantidad
            ]);
        }
        return $producto;
    }

    private function updateCuentaMonetaria(Request $request){
        $id = $request->cuenta_monetaria['cuenta_monteraia_id'];
        $cuentamonetaria = CuentaMonetaria::find($id);
        if ($cuentamonetaria){
            $cuentamonetaria->update($request->cuenta_monetaria);
        }
    }

    private function updateCuentaMonedaAumento(Request $request){
        $cuentamonetaria = CuentaMonetaria::where('usuario_id', $request->usuario_vendedor_id)->first();
        if ($cuentamonetaria){
            $calculoms = $cuentamonetaria->moneda_ms + $request->total_moneda_ms;
            $calculoQ = $cuentamonetaria->moneda_local + $request->total_moneda_local;
            $cuentamonetaria->update([
                'moneda_ms' => $calculoms,
                'moneda_local' => $calculoQ
            ]);
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
