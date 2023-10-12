<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Usuario;

class LoginController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/login",
     *     tags={"login"},
     *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 required={"usuario","password"},
     *                 @OA\Property(
     *                     type="text",
     *                     property="usuario",
     *                     description="Corresponde al usuario empresarial del funcionario en la Policia Nacional",
     *                 ),
     *                 @OA\Property(
     *                     type="password",
     *                     property="password",
     *                     description="Corresponde a la contraseña del funcionario en la Policia Nacional",
     *                 ),
     *             ),
     *         ),
     *     ),
     *     @OA\Response(response="200", description="Login successful"),
     * )
     */
    public function login(Request $request) {
        // if (\Auth::attempt(['usuario' => $request->get('usuario'), 'password' => $request->get('password')])) {
        //     $usuario = \Auth::user();

        //     $data = array();
        //     $data['usuario_id'] = $usuario->usuario_id;
        //     $data['usuario'] = $usuario->usuario;
        //     $data['email'] = strtolower($usuario->email);
        //     $data['consecutivo'] = 843062;
        //     $data['undeconsecutivo'] = 46001;
        //     $data['undefuerza'] = 6;
        //     $data['identificacion'] = 1110177916;
        //     $data['unidad_fisica'] = 'OFITE';
        //     $data['descripcion_unidad_dependencia'] = 'OFITE - GRUPO DE DESARROLLO TECNOLOGICO';
        //     $data['undeconsecutivo_laborando'] = 49478;
        //     $data['grado'] = 'PT';
        //     $data['unidad_papa'] = 'OFITE';

        //     $response = json_encode(array('result' => $data), JSON_NUMERIC_CHECK);
        //     $response = json_decode($response);
            
        //     return response()->json(array('user' => $response, 'tipo' => 0));
        // }
        // else {
        //     $response = json_encode(array('mensaje' => 'Usuario y/o contraseña incorrectos.', 'tipo' => -1), JSON_NUMERIC_CHECK);
        //     $response = json_decode($response);

        //     return response()->json($response);
        // }
        $token = \WebService::getToken();
        $result = \WebService::getLogin($token, $request->get('usuario'), $request->get('password'));

        if ($result->Codigo == 5) {
            $response = json_encode(array('mensaje' => $result->Respuesta, 'tipo' => -1), JSON_NUMERIC_CHECK);
            $response = json_decode($response);

            return response()->json($response);
        }

        $data['usuario'] = $request->get('usuario');
        $data['email'] = $data['usuario'] . '@correo.policia.gov.co';
        // $data['consecutivo'] = 843062;
        // $data['undeconsecutivo'] = 46001;
        // $data['undefuerza'] = 6;
        // $data['identificacion'] = 1110177916;
        // $data['unidad_fisica'] = 'OFITE';
        // $data['descripcion_unidad_dependencia'] = 'OFITE - GRUPO DE DESARROLLO TECNOLOGICO';
        // $data['undeconsecutivo_laborando'] = 49478;
        // $data['grado'] = 'PT';
        // $data['unidad_papa'] = 'OFITE';

        $response = $result->Respuesta;
        
        foreach ($response as $item) {
            $data['consecutivo'] = $item->Consecutivo;
            $data['undeconsecutivo'] = $item->UndeConsecutivo;
            $data['undefuerza'] = $item->UndeFuerza;
            $data['identificacion'] = $item->Identificacion;
            $data['unidad_fisica'] = $item->UnidadFisica;
            $data['descripcion_unidad_dependencia'] = $item->DescripcionUnidadDependencia;
            $data['undeconsecutivo_laborando'] = $item->UndeConsecutivoLaborando;
            $data['grado'] = $item->Grado;
            $data['unidad_papa'] = $item->UnidadPapa;
        }

        $response = json_encode(array('result' => $data), JSON_NUMERIC_CHECK);
        $response = json_decode($response);

        return response()->json(array('user' => $response, 'tipo' => 0));
    }

    public function getConsultarImagenFuncionario(Request $request) {
        $token = \WebService::getToken();
        $result = \WebService::getConsultarImagenFuncionario($token, $request->get('identificacion'));
        // $result = 'avatar.jpg';

        return response()->json(array('result' => $result, 'tipo' => 0));
    }
}
