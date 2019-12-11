<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Head_TKP extends Model
{
    //
    protected $table = 'tx_header_ting_kes_per';
    protected $primaryKey = 'HEADER_TING_KES_PER_ID';
    protected $fillable = [
        'ORGANIZATION_STRUCTURE_ID',
        'YEAR',
        'TOTAL_KRITERIA',
        'IS_DELETED',
        'APPROVED_1_BY',
        'APPROVED_1_STATUS',
        'APPROVED_2_BY',
        'APPROVED_2_STATUS',
        'ALASAN_KEMBALIKAN'

    ];
}
