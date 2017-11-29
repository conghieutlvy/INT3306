<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Auth;
use DB;
class PDTController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('pdt');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return view('PDT.home');
    }
    public function QL_LMH(){
        return view('PDT.QL_LMH');
    }
        public function QLSV(){
        return view('PDT.QLSV');
    }
    public function initNode(){
        $namhoc = json_decode(json_encode(DB::table('namhocs')->select('id','Năm học')->orderBy('id','desc')->get()),true);
        $data = json_decode(json_encode(DB::table('hockys')->select('id','Học kỳ', 'namhoc_id')->get()),true);
        $itemsByReference = array();
        //Create node
        $namhoc['0']['expanded'] = true;
        foreach($namhoc as $key => &$item) {
                $item['label'] = "Năm học ".$item['Năm học'];
                // Children array:
                unset($item['Năm học']);
                //$item['expanded'] = true;
                $itemsByReference[$item['id']] = &$item;
                $itemsByReference[$item['id']]['items'] = array(); 
        }
        
        //Set children array
        foreach($data as $key => &$item) {
            $newId = $item['namhoc_id'].'-'.$item['id'];
            $item['id'] = $newId;
            $item['label'] = $item['Học kỳ'];
            unset($item['Học kỳ']);
            $itemsByReference[$newId] = &$item;

            // Parent array
            if(isset($itemsByReference[$item['namhoc_id']])) {
                $itemsByReference[$item['namhoc_id']]['items'][] = &$item;
            }
        }
        return json_encode($namhoc);
    }
    public function addPdf(Request $request, $lopmonhoc_id){
        $fileUp = $request->file('filePdf');
        if(isset($fileUp) && $fileUp->getSize() > 0){
            $detail = DB::table('lopmonhocs')->where('lopmonhocs.id',$lopmonhoc_id)
                ->join('hockys','hockys.id','lopmonhocs.hocky_id')
                ->join('namhocs','namhocs.id','hockys.namhoc_id')
                ->select('lopmonhocs.id','Năm học as namhoc','Học kỳ as hocky','Mã lớp môn học as lmh')->get();
            $path = 'PDF/'.($detail[0]->namhoc).'/'.($detail[0]->hocky).'/'.($detail[0]->lmh);
            $exist = Storage::exists($path);
            if($exist) Storage::delete($path);
            Storage::putFileAs('PDF/'.$detail[0]->namhoc.'/'.$detail[0]->hocky,$fileUp,($detail[0]->lmh));
            DB::table('lopmonhocs')->where('id',$lopmonhoc_id)->update(['score' => 1]);
        } else return "Cập nhật không thành công";
        return 'Cập nhật thành công';
    }

    public function getAll($id){
        $data = DB::table('lopmonhocs')->where('hocky_id',$id)->select('id','Mã lớp môn học','Tên lớp môn học','score')->get();
        return json_encode($data);
    }

    public function search($id,$key){
        $data = DB::table('lopmonhocs')->where('hocky_id',$id)->where(function($q) use ($key){
            $q->where('Mã lớp môn học','LIKE','%'.$key.'%')->orWhere('Tên lớp môn học','LIKE','%'.$key.'%');
        })->select('id','Mã lớp môn học','Tên lớp môn học','score')->get();
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
