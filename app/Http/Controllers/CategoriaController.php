<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Categoria;

class CategoriaController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/categoria/getCategorias",
     *     tags={"getCategorias"},
     *     @OA\Response(response="200", description="Mostrar las categorías"),
     * )
     */
    public function getCategorias() {
        $c = new Categoria;
        $datos = $c->getCategorias();

        $response = json_encode(array('result' => $datos, 'tipo' => 0), JSON_NUMERIC_CHECK);
        $response = json_decode($response);

        return response()->json($response, 200);
    }

    /**
     * @OA\Post(
     *     path="/api/categoria/crearCategorias",
     *     tags={"crearCategorias"},
     *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 required={"nombre","orden","usuario"},
     *                 @OA\Property(
     *                     type="text",
     *                     property="nombre",
     *                     description="Nombre de la categoría",
     *                 ),
     *                 @OA\Property(
     *                     type="integer",
     *                     property="orden",
     *                     description="Número del orden de la categoría",
     *                 ),
     *                 @OA\Property(
     *                     type="text",
     *                     property="usuario",
     *                     description="Corresponde el usuario logueado",
     *                 ),
     *             ),
     *         ),
     *     ),
     *     @OA\Response(response="200", description="Ha creado exitoasamente."),
     * )
     */
    public function crearCategorias(Request $request) {
        $m = new Categoria;
        $c = $m->crud_categorias($request, 'C');

        if ($c) {
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
     *     path="/api/categoria/actualizarCategorias",
     *     tags={"actualizarCategorias"},
     *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 required={"categoria_id","nombre","orden","usuario"},
     *                 @OA\Property(
     *                     type="integer",
     *                     property="categoria_id",
     *                     description="La ID de la categoría.",
     *                 ),
     *                 @OA\Property(
     *                     type="text",
     *                     property="nombre",
     *                     description="Nombre de la categoría",
     *                 ),
     *                 @OA\Property(
     *                     type="integer",
     *                     property="orden",
     *                     description="Número del orden de la categoría",
     *                 ),
     *                 @OA\Property(
     *                     type="text",
     *                     property="usuario",
     *                     description="Corresponde el usuario logueado",
     *                 ),
     *             ),
     *         ),
     *     ),
     *     @OA\Response(response="200", description="Ha actualizado exitoasamente."),
     * )
     */
    public function actualizarCategorias(Request $request) {
        $m = new Categoria;
        $c = $m->crud_categorias($request, 'U');

        if ($c) {
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
     *     path="/api/categoria/eliminarCategorias",
     *     tags={"eliminarCategorias"},
     *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 required={"categoria_id"},
     *                 @OA\Property(
     *                     type="integer",
     *                     property="categoria_id",
     *                     description="La ID de la categoría.",
     *                 ),
     *             ),
     *         ),
     *     ),
     *     @OA\Response(response="200", description="Ha eliminado exitosamente."),
     * )
     */
    public function eliminarCategoria(Request $request) {
        $c = Categoria::find($request->get('categoria_id'));

        $c->delete();

        $response = json_encode(array('mensaje' => 'Ha eliminado exitosamente.', 'tipo' => 0), JSON_NUMERIC_CHECK);
        $response = json_decode($response);

        return response()->json($response);
    }
}
