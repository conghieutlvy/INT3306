<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class monhoc extends Model
{
	protected $table = 'monhocs';
    protected $fillable = [
        'Mã môn học','Tên môn học',
    ];
	public $timestamps = true;
}
