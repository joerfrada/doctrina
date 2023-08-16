<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Articulo;

class ArticuloController extends Controller
{
    public function getArticulos() {
        $a = new Articulo;
        $datos = $a->getArticulos();

        $response = json_encode(array('result' => $datos, 'tipo' => 0), JSON_NUMERIC_CHECK);
        $response = json_decode($response);

        return response()->json($response, 200);
    }

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

    public function actualizarArticulos(Request $request) {
        $m = new Articulo;
        $a = $m->crud_articulos($request, 'U');

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

    public function eliminarArticulo(Request $request) {
        $a = Articulo::find($request->get('articulo_id'));

        $a->delete();

        $response = json_encode(array('mensaje' => 'Ha eliminado exitosamente.', 'tipo' => 0), JSON_NUMERIC_CHECK);
        $response = json_decode($response);

        return response()->json($response);
    }
}
