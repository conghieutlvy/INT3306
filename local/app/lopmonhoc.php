<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class lopmonhoc extends Model
{
	protected $table = 'lopmonhocs';
    protected $fillable = [
        'Mã lớp môn học','Tên lớp môn học','Trạng thái điểm', 'hocky_id',
    ];
	public $timestamps = true;
}
