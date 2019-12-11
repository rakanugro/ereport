<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Organisasi extends Model
{
    //
    protected $table = 'tm_organization_structure';
    protected $primaryKey = 'ORGANIZATION_STRUCTURE_ID';
    protected $fillable = [
        'DIRECTORATE_ID',
        'BRANCH_OFFICE_ID',
        'DIVISION_ID',
        'SUB_DIVISION_ID',
        'ACTIVE',
        'APPROVED_1_STATUS',
        'APPROVED_2_STATUS',
        'ALASAN_KEMBALIKAN'
    ];
}
