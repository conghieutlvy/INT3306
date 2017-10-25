<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sinhvien_lopmonhoc extends Model
{
	protected $table = 'sinhvien_lopmonhoc';
    protected $fillable = [
        'sinhvien_id', 'lopmonhoc_id',
    ];
	public $timestamps = true;
}
