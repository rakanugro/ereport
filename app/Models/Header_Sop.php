<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Header_Sop extends Model
{
    protected $table = "tx_header_sop";
    protected $primaryKey = 'HEADER_SOP_ID';
    protected $fillable = [
        'ORGANIZATION_STRUCTURE_ID',
        'SOP_CODE_NAME',
        'FROM_DATE',
        'TO_DATE',
    ];
}
