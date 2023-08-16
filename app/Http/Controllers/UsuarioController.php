<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Usuario;

class UsuarioController extends Controller
{
    public function getUsuarios() {
        $u = new Usuario;
        $datos = $u->getUsuarios();

        $response = json_encode(array('result' => $datos, 'tipo' => 0), JSON_NUMERIC_CHECK);
        $response = json_decode($response);

        return response()->json($response, 200);
    }
}
