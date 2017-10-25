<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class file extends Model
{
	protected $table = 'files';
    protected $fillable = [
        'Đường dẫn', 'lopmonhoc_id', 'user_id',
    ];
	public $timestamps = true;
}
