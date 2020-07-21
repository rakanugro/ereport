<?php

namespace App\Models;;

use Illuminate\Database\Eloquent\Model;

class Form_File extends Model
{
    protected $table = "tx_form";
    protected $primaryKey = 'FM_ID';
    protected $fillable = [
        'WI_ID',
        'FM_NO',
        'FM_NAME',
        'ALS_REV',
        'ACTIVE',
        'FILE_NAME',
        'FILE_LOCATION',
        'FILE_TYPE',
    ];
}
