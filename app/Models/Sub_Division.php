<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sub_Division extends Model
{
    //
    protected $table = 'tm_sub_division';
    protected $primaryKey = 'SUB_DIVISION_ID';
    protected $fillable = [
        'SUB_DIVISION_NAME',
        'SUB_DIVISION_CODE'
    ];
}
