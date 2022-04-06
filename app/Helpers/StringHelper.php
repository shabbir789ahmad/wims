<?php 

namespace App\Helpers;

/**
 * 
 */

class StringHelper {

	public $str;

	public function __construct($str) {

		$this->str = $str;
		
	}

	public function ucfirst() {
		
		$this->str = ucfirst($this->str);

		return $this;

	}

	public function deSnake() {
		
		$this->str = str_replace('_', ' ', $this->str);

		return $this;

	}

	public function str() {
		
		return $this->str;

	}

}