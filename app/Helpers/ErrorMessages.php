<?php 

namespace App\Helpers;

/**
 * 
 */

class ErrorMessages {

	public static function msg($code) {

		$msg = "";
		
		switch ($code) {
			case 422:
			case "validation":
				$msg = "Error Validating Input";
				break;
			case 201:
			case "success":
				$msg = "Your Work Saved Successfully";
				break;
			default:
				// code...
				break;
		}

		return $msg;

	}

	public static function title($code) {

		$msg = "";
		
		switch ($code) {
			case 422:
			case "validation":
				$msg = "Validating Error";
				break;

			case 201:
			case "success":
				$msg = "Success";
				break;
			
			default:
				// code...
				break;
		}

		return $msg;

	}

	public static function color($code) {

		$c = "";
		
		switch ($code) {
			case 422:
			case "validation":
				$c = "warning";
				break;
			case 201:
			case "success":
				$c = "success";
				break;
			
			default:
				// code...
				break;
		}

		return $c;

	}

}
