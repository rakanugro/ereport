<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Master_TKP extends Model
{
    //
    protected $table = 'tm_ting_kes_per';
    protected $primaryKey = 'TING_KES_PER_ID';
    protected $fillable = [
        'INDICATOR_ID',
        'ORGANIZATION_STRUCTURE_ID'
    ];
}
