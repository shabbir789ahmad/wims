<?php 

namespace App\Helpers;

use DB;

/**
 * 
 */

class Vendor {
	
	public static function get() {

		$vendor = DB::table('branches')
			->select('vendors.id', 'vendors.vendor_name')
			->join('vendors', 'vendors.id', 'branches.vendor_id')
			->where('branches.id', \Auth::user()->branch_id)
			->first();

		return $vendor;

	}

	public static function getId() {
		
		try {

			return Vendor::get()->id;

		} catch (\Exception $e) {

			return null;

		}

	}

}