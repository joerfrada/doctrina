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

            if ($a->articulo_id != 0) {
                if ($request->file('cover') || $request->file('doc') || $request->file('audio') || $request->file('video')) {
                    $m = new Archivo;
                    $m->registro_id = $a->articulo_id;
                    $m->usuario_creador = $obj['usuario'];
                    
                    if ($request->file('cover')) {
                        $folderPath = env('APP_FILE_DIR') . 'cover' . '\\' . $a->articulo_id;
                        if (!\File::exists($folderPath)) {
                            \File::makeDirectory($folderPath, 0755, true);
                        }
        
                        $file = $request->file('cover');
                        $fileName = Str::uuid() . '.' . $file->getClientOriginalExtension();
                        $file->move($folderPath, $fileName);

                        $m->ruta_cover = 'cover' . '\\' . $a->articulo_id . '\\' . $fileName;
                    }

                    if ($request->file('doc')) {
                        $folderPath = env('APP_FILE_DIR') . 'doc' . '\\' . $a->articulo_id;
                        if (!\File::exists($folderPath)) {
                            \File::makeDirectory($folderPath, 0755, true);
                        }
        
                        $file = $request->file('doc');
                        $fileName = Str::uuid() . '.' . $file->getClientOriginalExtension();
                        $file->move($folderPath, $fileName);
        
                        $m->ruta_doc = 'doc' . '\\' . $a->articulo_id . '\\' . $fileName;
                    }

                    if ($request->file('audio')) {
                        $folderPath = env('APP_FILE_DIR') . 'audio' . '\\' . $a->articulo_id;
                        if (!\File::exists($folderPath)) {
                            \File::makeDirectory($folderPath, 0755, true);
                        }
        
                        $file = $request->file('audio');
                        $fileName = Str::uuid() . '.' . $file->getClientOriginalExtension();
                        $file->move($folderPath, $fileName);
        
                        $m->ruta_audio = 'audio' . '\\' . $a->articulo_id . '\\' . $fileName;
                    }

                    if ($request->file('video')) {
                        $folderPath = env('APP_FILE_DIR') . 'video' . '\\' . $a->articulo_id;
                        if (!\File::exists($folderPath)) {
                            \File::makeDirectory($folderPath, 0755, true);
                        }
        
                        $file = $request->file('video');
                        $fileName = Str::uuid() . '.' . $file->getClientOriginalExtension();
                        $file->move($folderPath, $fileName);
        
                        $m->ruta_video = 'video' . '\\' . $a->articulo_id . '\\' . $fileName;
                    }

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

            $archivo_existe = $obj['archivo_existe'];

            if ($archivo_existe == 1) {
                if ($request->file('cover') || $request->file('doc') || $request->file('audio') || $request->file('video')) {
                    $m = Archivo::where('registro_id', $a->articulo_id)->first();
                    $m->registro_id = $a->articulo_id;
                    $m->usuario_modificador = $obj['usuario'];
                    
                    if ($request->file('cover')) {
                        $folderPath = env('APP_FILE_DIR') . 'cover' . '\\' . $a->articulo_id;
                        if (!\File::exists($folderPath)) {
                            \File::makeDirectory($folderPath, 0755, true);
                        }
        
                        $file = $request->file('cover');
                        $fileName = Str::uuid() . '.' . $file->getClientOriginalExtension();
                        $file->move($folderPath, $fileName);

                        $m->ruta_cover = 'cover' . '\\' . $a->articulo_id . '\\' . $fileName;
                    }

                    if ($request->file('doc')) {
                        $folderPath = env('APP_FILE_DIR') . 'doc' . '\\' . $a->articulo_id;
                        if (!\File::exists($folderPath)) {
                            \File::makeDirectory($folderPath, 0755, true);
                        }
        
                        $file = $request->file('doc');
                        $fileName = Str::uuid() . '.' . $file->getClientOriginalExtension();
                        $file->move($folderPath, $fileName);
        
                        $m->ruta_doc = 'doc' . '\\' . $a->articulo_id . '\\' . $fileName;
                    }

                    if ($request->file('audio')) {
                        $folderPath = env('APP_FILE_DIR') . 'audio' . '\\' . $a->articulo_id;
                        if (!\File::exists($folderPath)) {
                            \File::makeDirectory($folderPath, 0755, true);
                        }
        
                        $file = $request->file('audio');
                        $fileName = Str::uuid() . '.' . $file->getClientOriginalExtension();
                        $file->move($folderPath, $fileName);
        
                        $m->ruta_audio = 'audio' . '\\' . $a->articulo_id . '\\' . $fileName;
                    }

                    if ($request->file('video')) {
                        $folderPath = env('APP_FILE_DIR') . 'video' . '\\' . $a->articulo_id;
                        if (!\File::exists($folderPath)) {
                            \File::makeDirectory($folderPath, 0755, true);
                        }
        
                        $file = $request->file('video');
                        $fileName = Str::uuid() . '.' . $file->getClientOriginalExtension();
                        $file->move($folderPath, $fileName);
        
                        $m->ruta_video = 'video' . '\\' . $a->articulo_id . '\\' . $fileName;
                    }
                    
                    $m->save();
                }
            }
            else {
                if ($request->file('cover') || $request->file('doc') || $request->file('audio') || $request->file('video')) {
                    $m = new Archivo;
                    $m->registro_id = $a->articulo_id;
                    $m->usuario_creador = $obj['usuario'];
                    
                    if ($request->file('cover')) {
                        $folderPath = env('APP_FILE_DIR') . 'cover' . '\\' . $a->articulo_id;
                        if (!\File::exists($folderPath)) {
                            \File::makeDirectory($folderPath, 0755, true);
                        }
        
                        $file = $request->file('cover');
                        $fileName = Str::uuid() . '.' . $file->getClientOriginalExtension();
                        $file->move($folderPath, $fileName);
    
                        $m->ruta_cover = 'cover' . '\\' . $a->articulo_id . '\\' . $fileName;
                    }
    
                    if ($request->file('doc')) {
                        $folderPath = env('APP_FILE_DIR') . 'doc' . '\\' . $a->articulo_id;
                        if (!\File::exists($folderPath)) {
                            \File::makeDirectory($folderPath, 0755, true);
                        }
        
                        $file = $request->file('doc');
                        $fileName = Str::uuid() . '.' . $file->getClientOriginalExtension();
                        $file->move($folderPath, $fileName);
        
                        $m->ruta_doc = 'doc' . '\\' . $a->articulo_id . '\\' . $fileName;
                    }
    
                    if ($request->file('audio')) {
                        $folderPath = env('APP_FILE_DIR') . 'audio' . '\\' . $a->articulo_id;
                        if (!\File::exists($folderPath)) {
                            \File::makeDirectory($folderPath, 0755, true);
                        }
        
                        $file = $request->file('audio');
                        $fileName = Str::uuid() . '.' . $file->getClientOriginalExtension();
                        $file->move($folderPath, $fileName);
        
                        $m->ruta_audio = 'audio' . '\\' . $a->articulo_id . '\\' . $fileName;
                    }
    
                    if ($request->file('video')) {
                        $folderPath = env('APP_FILE_DIR') . 'video' . '\\' . $a->articulo_id;
                        if (!\File::exists($folderPath)) {
                            \File::makeDirectory($folderPath, 0755, true);
                        }
        
                        $file = $request->file('video');
                        $fileName = Str::uuid() . '.' . $file->getClientOriginalExtension();
                        $file->move($folderPath, $fileName);
        
                        $m->ruta_video = 'video' . '\\' . $a->articulo_id . '\\' . $fileName;
                    }

                    $m->save();
                }
            }

            return $a;
        }
    }
}
