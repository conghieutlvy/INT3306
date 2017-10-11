<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class namhoc extends Model
{
	protected $table = 'namhoc';
    protected $fillable = [
        'NAM HOC'
    ];
	public $timestamps = true;
}
