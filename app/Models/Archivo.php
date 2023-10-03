<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Archivo extends Model
{
    use HasFactory;

    protected $table = 'tb_archivos';

    protected $primaryKey = 'archivo_id';

    public $timestamps = false;
}
