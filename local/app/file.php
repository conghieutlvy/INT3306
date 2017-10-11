<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class file extends Model
{
	protected $table = 'file';
    protected $fillable = [
        'PATH', 'LOPMONHOC_id', 'USER_id',
    ];
	public $timestamps = true;
}
