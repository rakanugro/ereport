<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Divisi extends Model
{
	protected $table = 'tm_division';
	protected $primaryKey = 'DIVISION_ID';
	protected $fillable = [
		'DIVISION_NAME',
		'DIVISION_CODE',
		'ACTIVE'
	];
}
