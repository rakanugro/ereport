<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sub_Det_TKP extends Model
{
    //
    protected $table = 'tx_sub_det_tingkat_kesehatan_perusahaan';
    protected $primaryKey = 'SUB_DET_TINGKAT_KESEHATAN_PERUSAHAAN_ID';
    protected $fillable = [
        'DET_TINGKAT_KESEHATAN_PERUSAHAAN_ID',
        'INDICATOR_ID',
        'ACTUAL_REALISASI'
    ];
}
