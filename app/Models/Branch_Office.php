<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch_Office extends Model
{
    protected $table = 'tm_branch_office';
    protected $primaryKey = 'BRANCH_OFFICE_ID';
    protected $fillable = [
        'BRANCH_OFFICE_NAME',
        'BRANCH_OFFICE_CODE',
        'ACTIVE'
    ];
}
