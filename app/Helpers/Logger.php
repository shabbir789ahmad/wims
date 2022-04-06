<?php 

namespace App\Helpers;

use DB;

/**
 * 
 */

class Logger {

	public static function logActivity($activity) {

		$route = explode('.', $activity);

		$controller = $route[0] ?? null;
		$method = $route[1] ?? null;

		DB::table('activity_logs')->insert([

			'vendor_id' => request('_vendorId'),
			'branch_id' => request('_branchId'),
			'ip_address' => request()->ip,
			'controller' => $controller,
			'method' => $method,
			'created_at' => date('Y-m-d H:i:s'),

		]);

	}

}