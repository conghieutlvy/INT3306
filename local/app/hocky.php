<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class hocky extends Model
{
	protected $table = 'hockys';
    protected $fillable = [
        'Học kỳ', 'namhoc_id'
    ];
	public $timestamps = true;
}
