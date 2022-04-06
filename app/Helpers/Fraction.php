<?php 

namespace App\Helpers;

/**
 * 
 */

class Fraction {

	public static function frac($value) {

		try {

			$pieces = explode('{', $value);
			
			// $name = substr($value, 0, strrpos($value, '{'));
			$name = $pieces[0];
			$fraction = rtrim($pieces[1], '}');

			$fraction_pieces = explode(' ', $fraction);

			if (count($fraction_pieces) > 1) {
				
				$whole = $fraction_pieces[0];

				$numerator = explode('/', $fraction_pieces[1])[0];
				$denominator = explode('/', $fraction_pieces[1])[1];

				return $name . "
					<span class='whole'>$whole</span>
					<div class='frac'>
					    <span class='numerator'>$numerator</span>
					    <span class='symbol'>/</span>
					    <span class='bottom'>$denominator</span>
					</div>";

				die();

			}

			$numerator = explode('/', $fraction_pieces[0])[0];
			$denominator = explode('/', $fraction_pieces[0])[1];

			return $name . "<div class='frac'>
			    <span class='numerator'>$numerator</span>
			    <span class='symbol'>/</span>
			    <span class='bottom'>$denominator</span>
			</div>";
			
		} catch (\Exception $e) {
			
		}


	}

}