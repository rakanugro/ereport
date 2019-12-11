<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Det_KPI extends Model
{
    //
    protected $table = 'tx_det_kpi';
    protected $primaryKey = 'DET_KPI_ID';
    protected $fillable = [
        'ACTUAL_REALISASI'
    ];
}
