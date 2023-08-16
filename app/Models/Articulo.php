<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Archivo;

class Articulo extends Model
{
    use HasFactory;

    protected $table = 'tb_articulos';

    protected $primaryKey = 'articulo_id';

    public $timestamps = false;

    protected $casts = ['modelo' => 'json' ];

    public function getArticulos() {
        $db = \DB::select('select * from vw_articulos order by articulo_id');

        return $db;
    }

    public function crud_articulos(Request $request, $evento) {
        $obj = json_decode($request->modelo, true);

        if ($evento == 'C') {
            $a = new Articulo;
            $a->feature = $obj['recomendado'] == true ? 1 : 0;
            $a->categoria_id = $obj['categoria_id'];
            $a->titulo = $obj['titulo'];
            $a->subtitulo = $obj['subtitulo'];
            $a->descripcion = $obj['descripcion'];
            $a->keywords = $obj['keywords'];
            $a->num_pagina = $obj['num_pagina'];
            $a->usuario_creador = $obj['usuario'];
            $a->save();

            if ($request->file('cover')) {
                $folderPath = public_path('files') . '/cover' . '/' . $a->articulo_id;
                if (!\File::exists($folderPath)) {
                    \File::makeDirectory($folderPath, 0755, true);
                }

                $file = $request->file('cover');
                $fileName = Str::uuid() . '.' . $file->getClientOriginalExtension();
                $formato = $file->getClientOriginalExtension();
                $file->move($folderPath, $fileName);

                if ($a->articulo_id != 0) {
                    $m = new Archivo;
                    $m->registro = $a->articulo_id;
                    $m->nombre = $fileName;
                    $m->formato = $formato;
                    $m->ruta = 'files/cover' . '/' . $a->articulo_id;
                    $m->usuario_creador = $obj['usuario'];
                    $m->fecha_creacion = \DB::raw('GETDATE()');
                    $m->save();
                }
            }

            if ($request->file('doc')) {
                $folderPath = public_path('files') . '/doc' . '/' . $a->articulo_id;
                if (!\File::exists($folderPath)) {
                    \File::makeDirectory($folderPath, 0755, true);
                }

                $file = $request->file('doc');
                $fileName = Str::uuid() . '.' . $file->getClientOriginalExtension();
                $formato = $file->getClientOriginalExtension();
                $file->move($folderPath, $fileName);

                if ($a->articulo_id != 0) {
                    $m = new Archivo;
                    $m->registro = $a->articulo_id;
                    $m->nombre = $fileName;
                    $m->formato = $formato;
                    $m->ruta = 'files/doc' . '/' . $a->articulo_id;
                    $m->usuario_creador = $obj['usuario'];
                    $m->fecha_creacion = \DB::raw('GETDATE()');
                    $m->save();
                }
            }

            if ($request->file('audio')) {
                $folderPath = public_path('files') . '/audio' . '/' . $a->articulo_id;
                if (!\File::exists($folderPath)) {
                    \File::makeDirectory($folderPath, 0755, true);
                }

                $file = $request->file('audio');
                $fileName = Str::uuid() . '.' . $file->getClientOriginalExtension();
                $formato = $file->getClientOriginalExtension();
                $file->move($folderPath, $fileName);

                if ($a->articulo_id != 0) {
                    $m = new Archivo;
                    $m->registro = $a->articulo_id;
                    $m->nombre = $fileName;
                    $m->formato = $formato;
                    $m->ruta = 'files/audio' . '/' . $a->articulo_id;
                    $m->usuario_creador = $obj['usuario'];
                    $m->fecha_creacion = \DB::raw('GETDATE()');
                    $m->save();
                }
            }

            if ($request->file('video')) {
                $folderPath = public_path('files') . '/video' . '/' . $a->articulo_id;
                if (!\File::exists($folderPath)) {
                    \File::makeDirectory($folderPath, 0755, true);
                }

                $file = $request->file('video');
                $fileName = Str::uuid() . '.' . $file->getClientOriginalExtension();
                $formato = $file->getClientOriginalExtension();
                $file->move($folderPath, $fileName);

                if ($a->articulo_id != 0) {
                    $m = new Archivo;
                    $m->registro = $a->articulo_id;
                    $m->nombre = $fileName;
                    $m->formato = $formato;
                    $m->ruta = 'files/video' . '/' . $a->articulo_id;
                    $m->usuario_creador = $obj['usuario'];
                    $m->fecha_creacion = \DB::raw('GETDATE()');
                    $m->save();
                }
            }

            return $a;
        }
        else if ($evento == 'U') {
            $a = Articulo::find($obj['articulo_id']);
            $a->feature = $obj['recomendado'] == true ? 1 : 0;
            $a->categoria_id = $obj['categoria_id'];
            $a->titulo = $obj['titulo'];
            $a->subtitulo = $obj['subtitulo'];
            $a->descripcion = $obj['descripcion'];
            $a->keywords = $obj['keywords'];
            $a->num_pagina = $obj['num_pagina'];
            $a->usuario_modificador = $obj['usuario'];
            $a->save();

            $id = $obj['articulo_id'];

            if ($request->file('cover')) {
                $folderPath = public_path('files') . '/cover' . '/' . $id;
                if (!\File::exists($folderPath)) {
                    \File::makeDirectory($folderPath, 0755, true);
                }

                $file = $request->file('cover');
                $fileName = Str::uuid() . '.' . $file->getClientOriginalExtension();
                $formato = $file->getClientOriginalExtension();
                $file->move($folderPath, $fileName);

                if ($id != 0) {
                    $m = new Archivo;
                    $m->registro = $id;
                    $m->nombre = $fileName;
                    $m->formato = $formato;
                    $m->ruta = 'files/cover' . '/' . $id;
                    $m->usuario_creador = $obj['usuario'];
                    $m->fecha_creacion = \DB::raw('GETDATE()');
                    $m->save();
                }
            }

            if ($request->file('doc')) {
                $folderPath = public_path('files') . '/doc' . '/' . $id;
                if (!\File::exists($folderPath)) {
                    \File::makeDirectory($folderPath, 0755, true);
                }

                $file = $request->file('doc');
                $fileName = Str::uuid() . '.' . $file->getClientOriginalExtension();
                $formato = $file->getClientOriginalExtension();
                $file->move($folderPath, $fileName);

                if ($id != 0) {
                    $m = new Archivo;
                    $m->registro = $id;
                    $m->nombre = $fileName;
                    $m->formato = $formato;
                    $m->ruta = 'files/doc' . '/' . $id;
                    $m->usuario_creador = $obj['usuario'];
                    $m->fecha_creacion = \DB::raw('GETDATE()');
                    $m->save();
                }
            }

            if ($request->file('audio')) {
                $folderPath = public_path('files') . '/audio' . '/' . $id;
                if (!\File::exists($folderPath)) {
                    \File::makeDirectory($folderPath, 0755, true);
                }

                $file = $request->file('audio');
                $fileName = Str::uuid() . '.' . $file->getClientOriginalExtension();
                $formato = $file->getClientOriginalExtension();
                $file->move($folderPath, $fileName);

                if ($id != 0) {
                    $m = new Archivo;
                    $m->registro = $id;
                    $m->nombre = $fileName;
                    $m->formato = $formato;
                    $m->ruta = 'files/audio' . '/' . $a->articulo_id;
                    $m->usuario_creador = $obj['usuario'];
                    $m->fecha_creacion = \DB::raw('GETDATE()');
                    $m->save();
                }
            }

            if ($request->file('video')) {
                $folderPath = public_path('files') . '/video' . '/' . $id;
                if (!\File::exists($folderPath)) {
                    \File::makeDirectory($folderPath, 0755, true);
                }

                $file = $request->file('video');
                $fileName = Str::uuid() . '.' . $file->getClientOriginalExtension();
                $formato = $file->getClientOriginalExtension();
                $file->move($folderPath, $fileName);

                if ($id != 0) {
                    $m = new Archivo;
                    $m->registro = $id;
                    $m->nombre = $fileName;
                    $m->formato = $formato;
                    $m->ruta = 'files/video' . '/' . $id;
                    $m->usuario_creador = $obj['usuario'];
                    $m->fecha_creacion = \DB::raw('GETDATE()');
                    $m->save();
                }
            }

            return $a;
        }
    }
}
