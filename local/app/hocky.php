<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class hocky extends Model
{
	protected $table = 'hocky';
    protected $fillable = [
        'HOC KY', 'NAMHOC_id'
    ];
	public $timestamps = true;
}
