<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class lopmonhoc extends Model
{
	protected $table = 'lopmonhoc';
    protected $fillable = [
        'LOP MON HOC', 'HOCKY_id',
    ];
	public $timestamps = true;
}
