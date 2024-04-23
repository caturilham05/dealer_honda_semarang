<?php
namespace App\Helpers;

class Helper {
	public static function helper_number_format($number){return number_format($number,2,',','.');}
	public static function helper_nl2br($string){return nl2br(e($string));}
}