<?php 

namespace App\Services;

/**
 * 
 */

class ImageMimeService {

	public static $mimes = ["image/gif", "image/jpg","image/png"];

	public static function checkMime($path) {
		
		$index = exif_imagetype($path);

		return self::$mimes[($index - 1)];

	}

}