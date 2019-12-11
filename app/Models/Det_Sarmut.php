<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Det_Sarmut extends Model
{
    //
    protected $table = 'tx_det_sasaran_mutu';
    protected $primaryKey = 'DET_SASARAN_MUTU_ID';
    protected $fillable = [
        'ACTUAL_REALISASI'
    ];
}
