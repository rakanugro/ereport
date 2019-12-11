<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sub_Det_KPI extends Model
{
    //
    protected $table = 'tx_sub_det_kpi';
    protected $primaryKey = 'SUB_DET_KPI_ID';
    protected $fillable = [
        'ACTUAL_REALISASI'
    ];
}
