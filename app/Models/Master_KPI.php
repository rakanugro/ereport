<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Master_KPI extends Model
{
    //
    protected $table = 'tm_kpi';
    protected $primaryKey = 'KPI_ID';
    protected $fillable = [
        'INDICATOR_ID',
        'ORGANIZATION_STRUCTURE_ID'
    ];
}
