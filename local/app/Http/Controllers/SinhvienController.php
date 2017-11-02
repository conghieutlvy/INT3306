<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class SinhvienController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('sv');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('SinhVien.home_sv');
    }

    public function LMH(){
        return view('SinhVien.LMH');
    }
}
