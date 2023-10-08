<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Archivo;
use App\Models\Articulo;
use App\Models\Settings;

class ArticuloController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/articulo/getArticulos",
     *     tags={"getArticulos"},
     *     @OA\Response(response="200", description="Mostrar los artículos"),
     * )
     */
    public function getArticulos() {
        $a = new Articulo;
        $datos = $a->getArticulos();

        $response = json_encode(array('result' => $datos, 'tipo' => 0), JSON_NUMERIC_CHECK);
        $response = json_decode($response);

        return response()->json($response, 200);
    }

    public function getArticulo(Request $request) {
        $categoria_id = $request->get('categoria_id');
        $featurecat = $request->get('featurecat');
        $feature = $request->get('feature');
        $top = $request->get('top');
        $titulo = $request->get('titulo');

        if (isset($titulo) && $titulo != "0") {
            $db = \DB::table('vw_articulos')->where('titulo', 'LIKE', '%'. $titulo . '%')->get();
        }
        else if (isset($top) && $top == 1) {
            $datos = Settings::where('setting_id', 1)->get();
            foreach ($datos as $item) {
                $db = \DB::select('select * from vw_articulos where articulo_id = :id', array('id' => $item->top));
            }
        }
        else if (isset($feature) && $feature == 1) {
            $db = \DB::select('select * from vw_articulos where estado = 1 and feature = 1 order by dbms_random.random');
            $t = 3;
        }
        else if (isset($categoria_id)) {
            if (isset($featurecat) && $featurecat == 1) {
                $db = \DB::select('select * from vw_articulos where estado = 1 and feature = 1 and categoria_id = :id', array('id' => $categoria_id));
            }
            else {
                $db = \DB::select('select * from vw_articulos where estado = 1 and categoria_id = :id', array('id' => $categoria_id));
            }            
        }
        else {
            $db = \DB::select('select * from vw_articulos where estado = 1 order by dbms_random.random');
        }

        $response = json_encode(array('result' => $db, 'tipo' => 0), JSON_NUMERIC_CHECK);
        $response = json_decode($response);

        return response()->json($response, 200);
    }

    /**
     * @OA\Post(
     *     path="/api/articulo/crearArticulos",
     *     tags={"crearArticulos"},
     *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 required={"modelo"},
     *                 @OA\Property(
     *                     type="string",
     *                     property="modelo",
     *                     description="Los objetos y los valores deben ser las comillas doble. Excepto las llaves {} y el entero sin comillas doble",
     *                     example="{recomendado:true,categoria_id:0,titulo:NombreTitulo,subtitulo:NombreSubtitulo,descripcion:Texto,keywords:[],num_pagina:0}"
     *                 ),
     *                 @OA\Property(
     *                     type="string",
     *                     property="cover",
     *                     format="binary",
     *                     description="Cover del artículo",
     *                 ),
     *                 @OA\Property(
     *                     type="string",
     *                     property="doc",
     *                     format="binary",
     *                     description="Documento del artículo",
     *                 ),
     *                 @OA\Property(
     *                     type="string",
     *                     property="audio",
     *                     format="binary",
     *                     description="Audio del artículo",
     *                 ),
     *                 @OA\Property(
     *                     type="string",
     *                     property="video",
     *                     format="binary",
     *                     description="Vídeo del artículo",
     *                 ),
     *                 @OA\Property(
     *                     type="text",
     *                     property="usuario",
     *                     description="Corresponde el usuario logueado",
     *                 ),
     *             ),
     *         ),
     *     ),
     *     @OA\Response(response="200", description="Ha creado exitosamente."),
     * )
     */
    public function crearArticulos(Request $request) {
        $m = new Articulo;
        $a = $m->crud_articulos($request, 'C');

        if ($a) {
            $response = json_encode(array('mensaje' => 'Ha creado exitosamente.', 'tipo' => 0), JSON_NUMERIC_CHECK);
            $response = json_decode($response);

            return response()->json($response);
        }
        else {
            $response = json_encode(array('mensaje' => 'Error guardado.', 'tipo' => -1), JSON_NUMERIC_CHECK);
            $response = json_decode($response);

            return response()->json($response);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/articulo/actualizarArticulos",
     *     tags={"actualizarArticulos"},
     *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 required={"modelo"},
     *                 @OA\Property(
     *                     type="string",
     *                     property="modelo",
     *                     description="Los objetos y los valores deben ser las comillas doble. Excepto las llaves {} y el entero sin comillas doble",
     *                     example="{articulo_id:0,recomendado:true,categoria_id:0,titulo:NombreTitulo,subtitulo:NombreSubtitulo,descripcion:Texto,keywords:[],num_pagina:0}"
     *                 ),
     *                 @OA\Property(
     *                     type="string",
     *                     property="cover",
     *                     format="binary",
     *                     description="Cover del artículo",
     *                 ),
     *                 @OA\Property(
     *                     type="string",
     *                     property="doc",
     *                     format="binary",
     *                     description="Documento del artículo",
     *                 ),
     *                 @OA\Property(
     *                     type="string",
     *                     property="audio",
     *                     format="binary",
     *                     description="Audio del artículo",
     *                 ),
     *                 @OA\Property(
     *                     type="string",
     *                     property="video",
     *                     format="binary",
     *                     description="Vídeo del artículo",
     *                 ),
     *                 @OA\Property(
     *                     type="text",
     *                     property="usuario",
     *                     description="Corresponde el usuario logueado",
     *                 ),
     *             ),
     *         ),
     *     ),
     *     @OA\Response(response="200", description="Ha actualizado exitosamente."),
     * )
     */
    public function actualizarArticulos(Request $request) {
        $m = new Articulo;
        $a = $m->crud_articulos($request, 'U');

        if ($a) {
            $response = json_encode(array('mensaje' => 'Ha actualizado exitosamente.', 'tipo' => 0), JSON_NUMERIC_CHECK);
            $response = json_decode($response);

            return response()->json($response);
        }
        else {
            $response = json_encode(array('mensaje' => 'Error guardado.', 'tipo' => -1), JSON_NUMERIC_CHECK);
            $response = json_decode($response);

            return response()->json($response);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/articulo/eliminarArticulos",
     *     tags={"eliminarArticulos"},
     *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 required={"articulo_id"},
     *                 @OA\Property(
     *                     type="integer",
     *                     property="articulo_id",
     *                     description="La ID del artículo.",
     *                 ),
     *             ),
     *         ),
     *     ),
     *     @OA\Response(response="200", description="Ha eliminado exitosamente."),
     * )
     */
    public function eliminarArticulo(Request $request) {
        $archivo = Archivo::where("registro_id", $request->get('articulo_id'));
        if ($archivo->exists()) {
            $archivo->delete();
        }

        $a = Articulo::find($request->get('articulo_id'));

        $a->delete();

        $response = json_encode(array('mensaje' => 'Ha eliminado exitosamente.', 'tipo' => 0), JSON_NUMERIC_CHECK);
        $response = json_decode($response);

        return response()->json($response);
    }
}
