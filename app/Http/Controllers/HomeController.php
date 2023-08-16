<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Categoria;
use App\Models\Articulo;

class HomeController extends Controller
{
    public function getStats() {
        $catcount = Categoria::count();
        $artcount = Articulo::count();

        $response = json_encode(array('categorias' => $catcount, 'articulos' => $artcount), JSON_NUMERIC_CHECK);
        $response = json_decode($response);

        return response()->json(array('result' => $response, 'tipo' => 0), 200);
    }
}
