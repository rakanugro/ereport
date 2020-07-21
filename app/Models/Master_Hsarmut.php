<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Master_Hsarmut extends Model
{
    //
    protected $table = 'tx_header_sasaran_mutu';
    protected $primaryKey = 'HEADER_SASARAN_MUTU_ID';
    protected $fillable = [
        'FILE_UPLOAD',
        'FILE_DELETE',
        'FILE_NAME'
    ];
}
