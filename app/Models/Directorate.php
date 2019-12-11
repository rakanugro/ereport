<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Directorate extends Model
{
    protected $table = 'tm_directorate';
    protected $primaryKey = 'DIRECTORATE_ID';
    protected $fillable = [
        'DIRECTORATE_CODE',
        'DIRECTORATE_NAME',
        'IS_CABANG',
        'ACTIVE'
    ];
}
