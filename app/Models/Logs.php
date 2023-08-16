<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Logs extends Model
{
    use HasFactory;

    protected $table = 'tb_logs';

    protected $primaryKey = 'logs_id';

    public $timestamps = false;

    public function getLogs() {
        $db = \DB::select('select * from tb_logs order by logs_id');

        return $db;
    }
}
