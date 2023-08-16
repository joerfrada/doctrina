<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Logs;

class LogsController extends Controller
{
    public function getLogs() {
        $l = new Logs;
        $datos = $l->getLogs();

        $response = json_encode(array('result' => $datos, 'tipo' => 0), JSON_NUMERIC_CHECK);
        $response = json_decode($response);

        return response()->json($response, 200);
    }
}
