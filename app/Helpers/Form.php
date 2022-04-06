<?php 

namespace App\Helpers;

class Form {

	public static function createEloquent($model, $data) {

		$route = explode('.', \Route::currentRouteName())[0];
		
		try {

			$model::create($data);

			\App\Helpers\Logger::logActivity(\Route::currentRouteName());

			return redirect()->route($route . ".index")->with('flash', 'success');
			
		} catch (\Exception $e) {

			return redirect()->route($route . ".index")->with('flash', 'error');
			
		}

	}

	public static function updateEloquent($model, $id, $data) {

		$route = explode('.', \Route::currentRouteName())[0];
		//dd($data);
		try {

			$model::findOrFail($id)->update($data);
              
			\App\Helpers\Logger::logActivity(\Route::currentRouteName());

			return redirect()->route($route . ".index")->with('flash', 'success');
			
		} catch (\Exception $e) {

			return redirect()->back()->withInput()->with('flash', 'error');
			
		}

	}

	public static function QBBulkInsert($table, $data) {

		$route = explode('.', \Route::currentRouteName())[0];
       // dd($data);
		try {

			\DB::table($table)->insert($data);

			\App\Helpers\Logger::logActivity(\Route::currentRouteName());

			return redirect()->route($route . ".index")->with('flash', 'success');

		} catch (\Exception $e) {
			
			return redirect()->route($route . ".index")->with('flash', 'error');

		}
		
	}

}