<?php 

namespace App\Helpers;

use DB;

/**
 * 
 */

class Branch {
	
	public static function get() {
		
		$branch = DB::table('branches')
			->where('branches.id', request('_branchId'))
			->first();

		return $branch;

	}

	public static function getId() {
		
		return Branch::get()->id;

	}

}