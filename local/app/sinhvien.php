<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class sinhvien extends Authenticatable
{
    use Notifiable;
	public $table = "sinhviens";
	//protected $guard = 'sinhvien';
	
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'Tên', 'Ngày sinh', 'Lớp khóa học',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];
}
