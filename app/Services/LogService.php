<?php 

namespace App\Services;

use DB;
use App\Helpers\WebSession;

/**
 * 
 */

class LogService {

	public function processData() {

		$user = WebSession::user();

		$log = [

			'ip_address' => $user->ip_address,
			'user_agent' => $user->useragent,
			'role_id' => $user->role_id,
			'role' => null,
			'user_id' => $user->id,
			'name' => $user->name,
			'logged_in' => date('Y-m-d H:i:s'),

		];

		return $log;

	}

	public function createLoginLogEntry() {

		$log = $this->processData();
		
		DB::table('login_logs')->insert($log);

	}

}