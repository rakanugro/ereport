<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Master_PTKAK extends Model
{
    //
    protected $table = 'tx_ptkak';
    protected $primaryKey = 'PTKAK_ID';
    protected $fillable = [
        'NOMOR',
        'SOURCE_ID',
        'PTKAK_DATE',
        'NO_PTKAK',
        'LOCATION',
        'PTKAK_REFERENCES',
        'FIRST_ACT',
        'CAUSE',
        'ACT',
        'PREVENTIVE',
        'VERIFIED_BY_1',
        'VERIFIED_STATUS_1',
        'VERIFIED_BY_2',
        'VERIFIED_STATUS_2',
        'REVISION',
        'PAGE',
        'TYPE',
        'PROPOSER_AUDITOR',
        'TO_AUDITAN',
        'DESCRIPTION',
        'CREATED_BY',
        'CREATED_SUB_DIV',
        'CREATED_ORG_ID'
    ];
}
