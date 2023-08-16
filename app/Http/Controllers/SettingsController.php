<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Settings;

class SettingsController extends Controller
{
    public function getSettings() {
        $c = new Settings;
        $datos = $c->getSettings();

        $response = json_encode(array('result' => $datos, 'tipo' => 0), JSON_NUMERIC_CHECK);
        $response = json_decode($response);

        return response()->json($response, 200);
    }
}
