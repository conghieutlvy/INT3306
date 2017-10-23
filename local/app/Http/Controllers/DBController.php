<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tests;
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
	public function treeTest(Request $request){
		$data = [['id'=> '1', 'text' => '1', 'parent_id'=>'0'],
				['id'=> '11', 'text' => '11', 'parent_id'=>'1'],
					['id'=> '111', 'text' => '111', 'parent_id'=>'11'],
					['id'=> '112', 'text' => '112', 'parent_id'=>'11'],
			['id'=> '2', 'text' => '2', 'parent_id'=>'0'],
				['id'=> '21', 'text' => '21', 'parent_id'=>'2']];

		
		$itemsByReference = array();
		$json = "[";
		//Create node			
		foreach($data as $key => &$item) {
			$itemsByReference[$item['id']] = &$item;
			// Children array:
			$itemsByReference[$item['id']]['nodes'] = array(); 
		}
		//Set children array
		foreach($data as $key => &$item) {
			if($item['parent_id'] && isset($itemsByReference[$item['parent_id']])) {
				$itemsByReference [$item['parent_id']]['nodes'][] = &$item;
			} 
		}
		//Encode
		foreach ($data as $key => $value) {
			if(!$value['parent_id'] && !isset($itemsByReference[$value['parent_id']])) {
				$json .= json_encode($value).",";
			}
		}
		$json = trim($json,',');
		$json .= "]";
		return $json;
	}
}
