<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class sop_ind extends Model
{
    protected $table = "tx_sop_ind";
    protected $primaryKey = 'SOP_IND_ID';
    protected $fillable = [
        'SOP_ID',
        'INDICATOR_ID',
    ];
}
