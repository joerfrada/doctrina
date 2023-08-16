<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Http\Request;

class Usuario extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'tb_usuarios';

    protected $primaryKey = 'usuario_id';

    protected $fillable = [
        'usuario',
        'email',
        'password',
        'estado',
        'usuario_creador',
        'usuario_modificador'
    ];

    protected $hidden = [
        'password',
    ];

    public $timestamps = false;

    public function getUsuarios() {
        $db = \DB::select('select * from tb_usuarios order by usuario_id');

        return $db;
    }
}
