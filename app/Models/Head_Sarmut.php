<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Head_Sarmut extends Model
{
    //
    protected $table = 'tx_header_sasaran_mutu';
    protected $primaryKey = 'HEADER_SASARAN_MUTU_ID';
    protected $fillable = [
        'YEAR',
        'MONTH'
    ];
}
