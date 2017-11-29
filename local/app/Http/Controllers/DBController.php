<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use DB;
use App\sinhvien;
use Auth;
class DBController extends Controller
{


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
        set_time_limit(300);
		$file = $request->file('fileSV_HK');
		$res['status'] = [1,1];
		$res['fail'] = $res['exists'] = array();
        if(isset($file) && $file->getSize() > 0) {
            $fileopen = fopen($file, "r");
            $arrTemp = array();
            while (($getData = fgetcsv($fileopen, 30, ",")) !== FALSE) {
                array_push($arrTemp,$getData);
            }
            $len = count($arrTemp,0);
            echo($len);
            ob_flush();
            flush();
            $count = 0;
            while ($count < $len) {
                $sinhvien_id = DB::table('sinhviens')->where('username', $arrTemp[$count][0])->value('id');
                if(isset($sinhvien_id)) {
                    $lopmonhoc_id = DB::table('lopmonhocs')->where([
                        ['hocky_id', $hocky_id],
                        ['Mã lớp môn học', $arrTemp[$count][1]]
                    ])->value('id');
                    if(!isset($lopmonhoc_id)){
                        $monhoc = DB::table('monhocs')->where('Mã môn học',explode(' ',$arrTemp[$count][1])[0])->value('Tên môn học');
                        if(isset($monhoc)) {
                            $lopmonhoc_id = DB::table('lopmonhocs')->insertGetId(['Mã lớp môn học' => $arrTemp[$count][1],'Tên lớp môn học' => $monhoc,'hocky_id'=>$hocky_id]);
                            $check = DB::table('sinhvien_lopmonhoc')->where([['sinhvien_id', $sinhvien_id], ['lopmonhoc_id', $lopmonhoc_id]])->first();
                            if (!$check) {
                                DB::table('sinhvien_lopmonhoc')->insert([['sinhvien_id' => $sinhvien_id, 'lopmonhoc_id' => $lopmonhoc_id]]);
                            } else {
                                array_push($res['exists'], $arrTemp[$count]);
                                $res['status'][0] = 0;
                            }
                        }else{
                            array_push($res['fail'],$arrTemp[$count]);
                            $res['status'][1] = 0;
                        }
                    }else{
                        $check = DB::table('sinhvien_lopmonhoc')->where([['sinhvien_id', $sinhvien_id], ['lopmonhoc_id', $lopmonhoc_id]])->first();
                        if (!$check) {
                            DB::table('sinhvien_lopmonhoc')->insert([['sinhvien_id' => $sinhvien_id, 'lopmonhoc_id' => $lopmonhoc_id]]);
                        } else {
                            array_push($res['exists'], $arrTemp[$count]);
                            $res['status'][0] = 0;
                        }
                    }
                } else {
                    array_push($res['fail'],$arrTemp[$count]);
                    $res['status'][1] = 0;
                }
                if(++$count % 100 == 0 || $count == $len){
                    echo(",".$count);
                    ob_flush();
                    flush();
                }
            }
            fclose($fileopen);
        }
		return json_encode($res);
	}
	public function importSV_LMH(Request $request, $lopmonhoc_id){
        set_time_limit(300);
        $file = $request->file('fileSV_HK');
        $res['status'] = [1,1];
        $res['fail'] = $res['exists'] = array();
        if(isset($file) && $file->getSize() > 0) {
            $fileopen = fopen($file, "r");
            $arrTemp = array();
            while (($getData = fgetcsv($fileopen, 30, ",")) !== FALSE) {
                array_push($arrTemp,$getData);
            }
            $len = count($arrTemp,0);
            echo($len);
            ob_flush();
            flush();
            $count = 0;
            while ($count < $len) {
                $sinhvien_id = DB::table('sinhviens')->where('username', $arrTemp[$count][0])->value('id');
                if (isset($sinhvien_id) && isset($lopmonhoc_id)) {
                    $check = DB::table('sinhvien_lopmonhoc')->where([['sinhvien_id', $sinhvien_id],['lopmonhoc_id', $lopmonhoc_id]])->first();
                    if (!$check){
                        DB::table('sinhvien_lopmonhoc')->insert([['sinhvien_id' => $sinhvien_id, 'lopmonhoc_id' => $lopmonhoc_id]]);
                    } else {
                        array_push($res['exists'],$arrTemp[$count]);
                        $res['status'][0] = 0;
                    }
                } else {
                    array_push($res['fail'],$arrTemp[$count]);
                    $res['status'][1] = 0;
                }
                if(++$count % 100 == 0 || $count == $len){
                    echo(",".$count);
                    ob_flush();
                    flush();
                }
            }
            fclose($fileopen);
        }
        return json_encode($res);
	}
	

	public function hockyExpand($id){
	    $authSv = Auth::guard('sinhvien')->check()? Auth::guard('sinhvien')->user()['id']:0;
		$namhoc_id = DB::table('hockys')->where('id',$id)->value('namhoc_id');
		if($authSv) $data = json_decode(json_encode(
		    DB::table('sinhvien_lopmonhoc')->join('lopmonhocs','lopmonhocs.id','sinhvien_lopmonhoc.lopmonhoc_id')->select('lopmonhocs.id','Tên lớp môn học','Mã lớp môn học')
                ->where([
		        ['sinhvien_lopmonhoc.sinhvien_id',$authSv],
                ['lopmonhocs.hocky_id',$id]
            ])->orderBy('Tên lớp môn học','asc')->get()),true);
		else $data = json_decode(json_encode(DB::table('lopmonhocs')->select('id','Tên lớp môn học','Mã lớp môn học')->where("hocky_id",$id)->orderBy('Tên lớp môn học','asc')->get()),true);
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
		$res['sinh vien'] = DB::table('sinhvien_lopmonhoc')->where('lopmonhoc_id',$id)->join('sinhviens','sinhviens.id','sinhvien_lopmonhoc.sinhvien_id')->select('Họ tên','username','Ngày sinh','Lớp khóa học')->orderBy('username','asc')->get();

		return json_encode($res);
	}
}
