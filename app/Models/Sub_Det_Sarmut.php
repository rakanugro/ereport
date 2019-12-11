<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sub_Det_Sarmut extends Model
{
    //
    protected $table = 'tx_sub_det_sasaran_mutu';
    protected $primaryKey = 'SUB_DET_SASARAN_MUTU_ID';
    protected $fillable = [
        'ACTUAL_REALISASI'
    ];
}
