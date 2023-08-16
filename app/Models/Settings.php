<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;

    protected $table = 'tb_settings';

    protected $primaryKey = 'setting_id';

    public $timestamps = false;

    public function getSettings() {
        $db = \DB::select('select * from tb_settings order by setting_id');

        return $db;
    }
}
