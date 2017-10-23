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
	protected function getData($tb,$fkey,$val){
		$data = DB::table($tb)->where($fkey,$val)->get();
		return json_decode(json_encode($data),true);
	}
	public function treeTest($tb,$fkey,$id){
		$namhoc = json_decode(json_encode(DB::table('namhoc')->get()),true);
		$data = $this->getData($tb,$fkey,$id);
		
		$itemsByReference = array();
		//Create node			
		foreach($namhoc as $key => &$item) {
				$itemsByReference[$item['id']] = &$item;
				$item['text'] = $item['nam hoc'];
				// Children array:
				$itemsByReference[$item['id']]['nodes'] = array(); 
		}
		
		//Set children array
		foreach($data as $key => &$item) {
				$temp = $item['id'];
				$item['id'] = $item['namhoc_id'].'-'.$item['id'];
				$item['text'] = $item['hoc ky'];
				$itemsByReference[$item['namhoc_id'].'-'.$temp['id']] = &$item;
				// Children array:
				$itemsByReference[$item['namhoc_id'].'-'.$temp['id']]['nodes'] = array();
				// Parent array
				if(isset($itemsByReference[$item['namhoc_id']])) {
					$itemsByReference[$item['namhoc_id']]['nodes'][] = &$item;
				}	 
		}
		return json_encode($namhoc);	
	}
	public function initNode($table){
		$data = DB::table($tb)->get();
		$data = json_decode(json_encode($data),true);
	}
	public function createNode($parent, $txtParent, $children, $txtChildren, $parent_id){
		$itemsByReference = array();
		//Create parent
		foreach($parent as $key => &$item) {
			$itemsByReference[$item['id']] = &$item;
			$item['text'] = $item[$txtParent];
			// Children array:
			$itemsByReference[$item['id']]['nodes'] = array(); 
		}
		//Set children array
		foreach($children as $key => &$item) {
			$temp = $item['id'];
			$item['id'] = $item[$parent_id].'-'.$item['id'];
			$item['text'] = $item[$txtChildren];
			$itemsByReference[$item[$parent_id].'-'.$temp['id']] = &$item;
			// Children array:
			$itemsByReference[$item[$parent_id].'-'.$temp['id']]['nodes'] = array();
			// Parent array
			if(isset($itemsByReference[$item[$parent_id]])) {
				$itemsByReference[$item[$parent_id]]['nodes'][] = &$item;
			}	 
		}
	}
}
