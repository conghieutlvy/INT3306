<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Storage;

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

    public function getAll(){
        $authSv = Auth::guard('sinhvien')->check()? Auth::guard('sinhvien')->user()['id']:0;
        if($authSv) $data = 
            DB::table('sinhvien_lopmonhoc')->join('lopmonhocs','lopmonhocs.id','sinhvien_lopmonhoc.lopmonhoc_id')
            ->join('hockys','hockys.id','lopmonhocs.hocky_id')
            ->join('namhocs','namhocs.id','hockys.namhoc_id')->select('lopmonhocs.id','Tên lớp môn học','Mã lớp môn học','Học kỳ','Năm học','lopmonhocs.score')
            ->where('sinhvien_lopmonhoc.sinhvien_id',$authSv)->orderBy('hockys.id','desc')->get();

        return json_encode($data);
    }

    public function search($key){
        $authSv = Auth::guard('sinhvien')->check()? Auth::guard('sinhvien')->user()['id']:0;
        if($authSv) $data = 
            DB::table('sinhvien_lopmonhoc')->join('lopmonhocs','lopmonhocs.id','sinhvien_lopmonhoc.lopmonhoc_id')
            ->join('hockys','hockys.id','lopmonhocs.hocky_id')
            ->join('namhocs','namhocs.id','hockys.namhoc_id')->select('lopmonhocs.id','Tên lớp môn học','Mã lớp môn học','Học kỳ','Năm học','lopmonhocs.score')
            ->where('sinhvien_lopmonhoc.sinhvien_id',$authSv)
            ->where(function($q) use ($key){
                $q->where('Mã lớp môn học','LIKE','%'.$key.'%')->orWhere('Tên lớp môn học','LIKE','%'.$key.'%');
            })->orderBy('hockys.id','desc')->get();

        return json_encode($data);
    }
    public function viewPdf($lopmonhoc_id){ 
        $arrTemp = explode('-', $lopmonhoc_id);
        $authSv = Auth::guard('sinhvien')->check()? Auth::guard('sinhvien')->user()['id']:0;
        if($authSv && null == DB::table('sinhvien_lopmonhoc')->where([['lopmonhoc_id',$arrTemp[2]],['sinhvien_id',$authSv]])->first())
            return;
        if(Storage::exists('pdf/'.$arrTemp[0].'/'.$arrTemp[1].'/'.$arrTemp[2])){
            $filepath = 'local/storage/app/pdf/'.$arrTemp[0].'/'.$arrTemp[1].'/';
            $path = $filepath.$arrTemp[2];
            return response()->file($path);
        }
        return;
    }
}
