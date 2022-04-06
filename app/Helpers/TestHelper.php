<?php 

namespace App\Helpers;

class TestHelper {

	public static function getEloquent($model) {

		
		
		try {

			return $model::Branch()->get();
			
		} catch (\Exception $e) {

			return redirect()->route($route . ".index")->with('flash', 'error');
			
		}

	}




}