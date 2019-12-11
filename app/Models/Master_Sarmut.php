<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Master_Sarmut extends Model
{
    //
    protected $table = 'tm_ind_sasaran_mutu';
    protected $primaryKey = 'IND_SASARAN_MUTU_ID';
    protected $fillable = [
        'INDICATOR_ID',
        'ORGANIZATION_STRUCTURE_ID'
    ];
}
