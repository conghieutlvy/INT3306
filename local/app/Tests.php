<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tests extends Model
{
    protected $table = 'test';
    protected $fillable = [
        'msv','name','birthday','classe'
    ];
}
