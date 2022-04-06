<?php 

namespace App\Services;

use App\Services\ImageMimeService;

/**
 * 
 */

class ImageResizeService {

	public static function resize($path, $w, $h) {

		$type = ImageMimeService::checkMime($path);

		switch ($type) {

			case 'image/png':
				$image = imageCreateFromPng($path);
				break;

			case 'image/jpeg':
			case 'image/jpg':
				$image = imageCreateFromJpeg($path);
				break;
			
			default:

				throw new \Exception("Invalid Image Format", 1);
				break;
		}
		
		$width = imagesx($image);
		$height = imagesy($image);

		$newImg = imagecreatetruecolor($w, $h);

		$coefficient =  $h / $height;
		if ($h / $width > $coefficient) {
		    $coefficient = $h / $width;
		}

		imagealphablending($newImg, false);
		imagesavealpha($newImg, true);
		$transparent = imagecolorallocatealpha($newImg, 255, 255, 255, 127);
		imagefilledrectangle($newImg, 0, 0, $w, $h, $transparent);
		imagecopyresampled($newImg, $image, 0, 0, 0, 0, $width * $coefficient, $height * $coefficient, $width, $height);

		// imagepng($newImg, $path);

		return $newImg;

		

	}

	public static function png($path, $w, $h) {
		
		return imageCreateFromPng($path);

	}

	public static function jpeg($path, $w, $h) {
		
		return imageCreateFromJpeg($path);

	}


}