<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\hocky;
use DB;
class DBController extends Controller
{
    public function import(Request $request){
		echo $request;
		return;
		$file = $request->file('fileT');
		
		echo ("check\n".$file->getSize());
				 if($file->getSize() > 0)
				 { 
					$fileopen = fopen($file, "r");
					echo("open");
					while (($getData = fgetcsv($fileopen, 10000, ",")) !== FALSE)
					 {
						 echo("insert");
						DB::table('test')->insert(
							['msv' => $getData[0],
							'name' => $getData[1],
							'birthday' => $getData[2],
							'classe' => $getData[3]]
						);
						/*$t = new Tests();
						$t->msv = $getData[0];
						$t->name = $getData[1];
						$t->birthday = $getData[2];
						$t->classe = $getData[3];
						$result = $t->save();
						if(!isset($result))
						{
							echo "False";      
						}
						else {
							  echo "True";
						}*/
					 }
					 fclose($fileopen); 
				 }
	}
	public function initNode(){
		$namhoc = json_decode(json_encode(DB::table('namhoc')->select('id','nam hoc')->orderBy('id','desc')->get()),true);
		$data = json_decode(json_encode(DB::table('hocky')->select('id','hoc ky', 'namhoc_id')->get()),true);
		$itemsByReference = array();
		//Create node
		$namhoc['0']['expanded'] = true;
		foreach($namhoc as $key => &$item) {
				$item['label'] = "Năm học ".$item['nam hoc'];
				// Children array:
				unset($item['nam hoc']);
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
				$item['label'] = $item['hoc ky']; 
				unset($item['hoc ky']);
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
		$namhoc_id = DB::table('hocky')->where('id',$id)->value('namhoc_id');

		$data = json_decode(json_encode(DB::table('lopmonhoc')->select('id','ten lop mon hoc','hocky_id')->where("hocky_id",$id)->orderBy('ten lop mon hoc','asc')->get()),true);
		foreach($data as $key => &$item) {
			$newId = $namhoc_id.'-'.$item['hocky_id'].'-'.$item['id'];
			$item['id'] = $newId;
			$item['label'] = $item['ten lop mon hoc'];
			$item['value'] = $newId;
			$item['items'] = array();
		}	
		return json_encode($data) ;
	}

	public function getLMH($id){
		$res['thong tin'] = DB::table('lopmonhoc')->select('ten lop mon hoc')->where("id",$id)->first();
		$res['sinh vien'] = DB::table('sinhvien_lopmonhoc')->where('lopmonhoc_id',$id)->join('lopmonhoc','lopmonhoc.id','sinhvien_lopmonhoc.lopmonhoc_id')->join('sinhviens','sinhviens.id','sinhvien_lopmonhoc.sinhvien_id')->select('name','username')->get();
		return json_encode($res);
	}
}
