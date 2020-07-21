<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Header_Sop extends Model
{
    protected $table = "tx_sop";
    protected $primaryKey = 'SOP_ID';
    protected $fillable = [
        'ORGANIZATION_STRUCTURE_ID',
        'SOP_NO',
        'SOP_NAME',
        'ALS_REV',
        'G_CODE',
        'ACTIVE',
        'FILE_NAME',
        'FILE_LOCATION',
        'FILE_TYPE',
    ];
}
