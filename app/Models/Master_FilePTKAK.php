<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Master_FilePTKAK extends Model
{
    //
    protected $table = 'tx_ptkak_file';
    protected $primaryKey = 'PTKAK_FILE_ID';
    protected $fillable = [
        'PTKAK_ID',
        'FILE_NAME',
        'FILE_LOCATION',
        'FILE_TYPE',
        'IS_DELETED'
    ];
}
