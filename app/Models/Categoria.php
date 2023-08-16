<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Categoria extends Model
{
    use HasFactory;

    protected $table = 'tb_categorias';

    protected $primaryKey = 'categoria_id';

    public $timestamps = false;

    public function getCategorias() {
        $db = \DB::select('select * from tb_categorias order by categoria_id');

        return $db;
    }

    public function crud_categorias(Request $request, $evento) {
        if ($evento == 'C') {
            $c = new Categoria;
            $c->nombre = $request->get('nombre');
            $c->orden = $request->get('orden');
            $c->usuario_creador = $request->get('usuario');
            $c->save();

            return $c;
        }
        else if ($evento == 'U') {
            $c = Categoria::find($request->get('categoria_id'));
            $c->nombre = $request->get('nombre');
            $c->orden = $request->get('orden');
            $c->usuario_modificador = $request->get('usuario');
            $c->save();

            return $c;
        }
    }
}
