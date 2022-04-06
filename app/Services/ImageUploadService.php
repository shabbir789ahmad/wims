<?php 

namespace App\Services;

use App\Services\ImageResizeService;

/**
 * 
 */

class ImageUploadService {

	public $image;

	public function __construct($image) {
		$this->image = $image;
	}

	public function upload() {

		$file_name = md5(microtime());

		if ( ! file_exists('uploads/products')) {

		    mkdir('uploads/products', 0755, true);

		}

		$uploaded = 'uploads/products/' . $file_name;

		move_uploaded_file($this->image['tmp_name'], $uploaded);

		$resized = ImageResizeService::resize($uploaded, 256, 256);

		imagepng($resized, $uploaded);

		return $file_name;

	}

}