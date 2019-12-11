<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Head_KPI extends Model
{
    //
    protected $table = 'tx_header_kpi';
    protected $primaryKey = 'HEADER_KPI_ID';
    protected $fillable = [
        'YEAR',
        'PERIOD'
    ];
}
