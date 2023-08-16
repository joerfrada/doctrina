<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Usuario;

class LoginController extends Controller
{
    public function login(Request $request) {
        // if (\Auth::attempt(['email' => $request->get('email'), 'password' => $request->get('password')])) {
        //     $usuario = \Auth::user();

        //     $data = array();
        //     $data['usuario_id'] = $usuario->usuario_id;
        //     $data['usuario'] = $usuario->usuario;
        //     $data['email'] = strtolower($usuario->email);

        //     $response = json_encode(array('result' => $data), JSON_NUMERIC_CHECK);
        //     $response = json_decode($response);
            
        //     return response()->json(array('user' => $response, 'tipo' => 0));
        // }
        $token = \WebService::getToken();
        $result = \WebService::getLogin($token, $request->get('usuario'), $request->get('password'));

        if ($result->Codigo == 5) {
            $data['usuario'] = $request->get('usuario');

            // $response = $result->Respuesta;
            
            // foreach ($response as $item) {
            //     $data['consecutivo'] = $item->Consecutivo;
            //     $data['undeconsecutivo'] = $item->UndeConsecutivo;
            //     $data['undefuerza'] = $item->UndeFuerza;
            //     $data['identificacion'] = $item->Identificacion;
            //     $data['unidad_fisica'] = $item->UnidadFisica;
            //     $data['descripcion_unidad_dependencia'] = $item->DescripcionUnidadDependencia;
            //     $data['undeconsecutivo_laborando'] = $item->UndeConsecutivoLaborando;
            //     $data['grado'] = $item->Grado;
            //     $data['unidad_papa'] = $item->UnidadPapa;
            // }
            $data['usuario'] = 'cf.montaez';
            $data['email'] = 'cf.montaez@correo.policia.gov.co';

            $response = json_encode(array('result' => $data), JSON_NUMERIC_CHECK);
            $response = json_decode($response);

            return response()->json(array('user' => $response, 'tipo' => 0));
        }
        else if ($result->Codigo == 4) {
            $response = json_encode(array('mensaje' => 'Usuario y/o contraseña incorrectos.', 'tipo' => -1), JSON_NUMERIC_CHECK);
            $response = json_decode($response);

            return response()->json($response);
        }
        // return response()->json(array('codigo' => $result->Codigo, 'mensaje' => $result->Mensaje));
    }

    public function logout() {}
}
