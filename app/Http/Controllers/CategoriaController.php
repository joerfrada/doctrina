<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Categoria;

class CategoriaController extends Controller
{
    public function getCategorias() {
        $c = new Categoria;
        $datos = $c->getCategorias();

        $response = json_encode(array('result' => $datos, 'tipo' => 0), JSON_NUMERIC_CHECK);
        $response = json_decode($response);

        return response()->json($response, 200);
    }

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

    public function actualizarCategorias(Request $request) {
        $m = new Categoria;
        $c = $m->crud_categorias($request, 'U');

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

    public function eliminarCategoria(Request $request) {
        $c = Categoria::find($request->get('categoria_id'));

        $c->delete();

        $response = json_encode(array('mensaje' => 'Ha eliminado exitosamente.', 'tipo' => 0), JSON_NUMERIC_CHECK);
        $response = json_decode($response);

        return response()->json($response);
    }
}
