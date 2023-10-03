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
        $d = \DB::select('select count(*) as documento from tb_archivos where ruta_doc is not null');
        $doccount = $d[0]->documento;
        $a = \DB::select('select count(*) as audio from tb_archivos where ruta_audio is not null');
        $audcount = $a[0]->audio;
        $v = \DB::select('select count(*) as video from tb_archivos where ruta_video is not null');
        $vidcount = $v[0]->video;

        $response = json_encode(array('categorias' => $catcount, 'articulos' => $artcount, 'documentos' => $doccount, 'audios' => $audcount, 'videos' => $vidcount), JSON_NUMERIC_CHECK);
        $response = json_decode($response);

        return response()->json(array('result' => $response, 'tipo' => 0), 200);
    }
}
