<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class giangvien extends Model
{
	protected $table = 'giangvien';
    protected $fillable = [
        'TEN GV'
    ];
	public $timestamps = true;
}
