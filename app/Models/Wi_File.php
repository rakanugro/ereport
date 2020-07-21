<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wi_File extends Model
{
    protected $table = "tx_wi";
    protected $primaryKey = 'WI_ID';
    protected $fillable = [
        'SOP_ID',
        'WI_NO',
        'WI_NAME',
        'ALS_REV',
        'ACTIVE',
        'FILE_NAME',
        'FILE_LOCATION',
        'FILE_TYPE',
    ];
}
