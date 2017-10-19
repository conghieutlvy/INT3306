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
}
