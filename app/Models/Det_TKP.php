<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Det_TKP extends Model
{
    //
    protected $table = 'tx_det_tingkat_kesehatan_perusahaan';
    protected $primaryKey = 'DET_TINGKAT_KESEHATAN_PERUSAHAAN_ID';
    protected $fillable = [
    	'HEADER_TING_KES_PER_ID',
    	'INDICATOR_ID',
        'ACTUAL_REALISASI',
        'BOBOT'
    ];
}
