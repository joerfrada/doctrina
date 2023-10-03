<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Archivo;

class PreviewController extends Controller
{
    public function getCover($id) {
        $a = Archivo::where('registro_id', $id)->first();

        $filename = env('APP_FILE_DIR') . $a->ruta_cover;
        $file_extension = substr(strrchr($filename, "."), 1);

        switch ($file_extension) {
            case "png" : $ctype = "image/png"; break;
            case "jpeg":
            case "jpg" : $ctype = "image/jpeg"; break;
            default:
        }

        return response()->file($filename, ['Content-Type' => $ctype]);
    }

    public function getDocumento($id) {
        $a = Archivo::where('registro_id', $id)->first();

        $filename = env('APP_FILE_DIR') . $a->ruta_doc;

        return response()->file($filename, ['Content-Type' => 'application/pdf']);
    }
}
