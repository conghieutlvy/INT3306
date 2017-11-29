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
        return view('SinhVien.LMH');
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
        $authSv = (Auth::guard('sinhvien')->check() || Auth::guard('pdt')->check())?1:0;
        if(!$authSv)
            return;
        $detail = DB::table('lopmonhocs')->where('lopmonhocs.id',$lopmonhoc_id)
        ->join('hockys','hockys.id','lopmonhocs.hocky_id')
        ->join('namhocs','namhocs.id','hockys.namhoc_id')
        ->select('Năm học as namhoc','Học kỳ as hocky','Mã lớp môn học as lmh')->get();
        $path = 'pdf/'.$detail[0]->namhoc.'/'.$detail[0]->hocky.'/'.$detail[0]->lmh;
        if(Storage::exists($path)){
            $filepath = 'local/storage/app/';
            return response()->file($filepath.$path);
        }
        return;
    }
}
