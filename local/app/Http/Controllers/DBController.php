<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\hocky;
use DB;
use App\sinhvien;
class DBController extends Controller
{
    public function importPdf(Request $request){
        $file = $request->file('filePdf');
        if(isset($file) && $file->getSize() > 0){

        }
    }
    public function importSv(Request $request){
		$file = $request->file('fileSV');
		$res = array();
		$count = 0;
        if(isset($file) && $file->getSize() > 0){
            $fileopen = fopen($file, "r");
            while (($getData = fgetcsv($fileopen, 10000, ",")) !== FALSE){
				$arr = explode('/',$getData[2]);
				$temp = $arr[0];
				$arr[0] = $arr[2];
				$arr[2] = $temp;
				$newData = implode('-',$arr);
				/*$c = DB::table('sinhviens')->insert(
					['username' => $getData[0],
					'Họ tên' => $getData[1],
					'Ngày sinh' => $newData,
					'Lớp khóa học' => $getData[3]]
					);
                   if(!$c){
                       $res[$count++] = $getData;
                   }*/
                $t = new sinhvien();
				$t->username = $getData[0];
				$t['Họ tên'] = $getData[1];
				$t['Ngày sinh'] = $newData;
				$t['Lớp khóa học'] = $getData[3];
				$result = $t->saveOrFail();
                if($result == False){
                    $res[$count++] = $getData;
                }
            }
            fclose($fileopen);
        }
        return json_encode($count);
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
			$temp = $item['id'];
				$newId = $item['namhoc_id'].'-'.$item['id'];
				//$temp = $item['id'];
				$item['id'] = $newId;
				$item['label'] = $item['Học kỳ']; 
				unset($item['Học kỳ']);
				$itemsByReference[$newId] = &$item;
				// Children array:
				$itemsByReference[$newId]['items'] = [["value" => $temp , "label" => "Loading..."]];

				// Parent array
				if(isset($itemsByReference[$item['namhoc_id']])) {
					$itemsByReference[$item['namhoc_id']]['items'][] = &$item;
				}	 
		}
		return json_encode($namhoc) ;
	}

	public function hockyExpand($id){
		$namhoc_id = DB::table('hockys')->where('id',$id)->value('namhoc_id');

		$data = json_decode(json_encode(DB::table('lopmonhocs')->select('id','Tên lớp môn học','Mã lớp môn học')->where("hocky_id",$id)->orderBy('Tên lớp môn học','asc')->get()),true);
		foreach($data as $key => &$item) {
			$newId = $namhoc_id.'-'.$id.'-'.$item['id'];
			$item['id'] = $newId;
			$item['label'] = $item['Tên lớp môn học']." - ".$item["Mã lớp môn học"];
			$item['value'] = $newId;
			$item['items'] = array();
		}	
		return json_encode($data) ;
	}

	public function getLMH($id){

		$res['thong tin'] = DB::table('lopmonhocs')->where("lopmonhocs.id",$id)->join('hockys','hockys.id','lopmonhocs.hocky_id')->join('namhocs','namhocs.id','hockys.namhoc_id')->select('Tên lớp môn học','Mã lớp môn học','Năm học','Học kỳ','Trạng thái điểm')->first();
		$res['sinh vien'] = DB::table('sinhvien_lopmonhoc')->where('lopmonhoc_id',$id)->join('sinhviens','sinhviens.id','sinhvien_lopmonhoc.sinhvien_id')->select('Họ tên','username')->get();
		return json_encode($res);
	}
}
