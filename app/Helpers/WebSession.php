<?php 

namespace App\Helpers;

/**
 * 
 */

class WebSession {

	public static function user() {

		$guard = WebSession::currentGuard();

		$user = new \stdClass;

		$user->id = \Auth::guard($guard)->user()->id;
		$user->name = \Auth::guard($guard)->user()->name;
		$user->ip_address = WebSession::ip();
		$user->useragent = WebSession::useragent();
		$user->role_id = \Auth::guard($guard)->user()->role_id;
		
		return $user;

	}

	public static function currentGuard() {

		if (\Auth::guard('admin')->check()) {
			
			return 'admin';

		}

	}

	public static function ip() {
		return request()->ip();
	}

	public static function useragent() {
		return request()->server('HTTP_USER_AGENT');
	}

}