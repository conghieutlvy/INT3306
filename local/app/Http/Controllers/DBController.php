<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use DB;
use App\sinhvien;
class DBController extends Controller
{
    public function addPdf(Request $request, $lopmonhoc_id){
        $Upfile = $request->file('filePdf');
        if(isset($Upfile) && $Upfile->getSize() > 0){
            $files = Storage::files('PDF/1/1');
            $fileName = $lopmonhoc_id.'.pdf';
            foreach($files as $file){
                if($file == $fileName) Storage::delete($file);
            }
            $path = Storage::putFileAs('PDF/1/1',$Upfile,$fileName);
            DB::table('files')->insert(
               ['Đường dẫn'=> $path,
               'lopmonhoc_id'=> $lopmonhoc_id,
               'user_id' => 1]
            );
        } else return "Cap nhat file khong thanh cong";
        return 'Cap nhat file thanh cong';
    }
    public function importSv(Request $request){
    	return json_encode($request->file());
		$file = $request->file('fileSV');
		$res = array();
		$count = 0;
        if(isset($file) && $file->getSize() > 0){
            $fileopen = fopen($file, "r");
            while (($getData = fgetcsv($fileopen, 1000, ",")) !== FALSE){
				$arr = explode('/',$getData[2]);
				$temp = $arr[0];
				$arr[0] = $arr[2];
				$arr[2] = $temp;
				$newData = implode('-',$arr);
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
	public function importSV_HK(Request $request, $hocky_id){
		$file = $request->file('fileSV_HK');
		$res['status'] = [1,1];
		$res['fail'] = $res['exists'] = array();
        if(isset($file) && $file->getSize() > 0) {
            $fileopen = fopen($file, "r");
            while (($getData = fgetcsv($fileopen, 30, ",")) !== FALSE) {
                $sinhvien_id = DB::table('sinhviens')->where('username', $getData[0])->value('id');
                $lopmonhoc_id = DB::table('lopmonhocs')->where([
                    ['hocky_id', $hocky_id],
                    ['Mã lớp môn học', $getData[1]]
                ])->value('id');
                if (isset($sinhvien_id) && isset($lopmonhoc_id)) {
                    $check = DB::table('sinhvien_lopmonhoc')->where([['sinhvien_id', $sinhvien_id],['lopmonhoc_id', $lopmonhoc_id]])->first();
                    if (!$check){
                        DB::table('sinhvien_lopmonhoc')->insert([['sinhvien_id' => $sinhvien_id, 'lopmonhoc_id' => $lopmonhoc_id]]);
                    } else {
                        array_push($res['exists'],$getData);
                        $res['status'][0] = 0;
                    }
                } else {
                    array_push($res['fail'],$getData);
                    $res['status'][1] = 0;
                }
            }
            fclose($fileopen);
        }
		return json_encode($res);
	}
	public function importSV_LMH(Request $request, $lopmonhoc_id){

		return "importSV_LMH";
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
				$item['id'] = $newId;
				$item['label'] = $item['Học kỳ']; 
				unset($item['Học kỳ']);
				$itemsByReference[$newId] = &$item;
				// Children array:
				$itemsByReference[$newId]['items'] = [['value'=> $temp, "label" => "Loading..."]];

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
			$item['label'] = $item["Mã lớp môn học"]." - ".$item['Tên lớp môn học'];
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
