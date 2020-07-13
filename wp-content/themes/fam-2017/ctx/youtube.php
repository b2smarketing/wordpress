<?php

require_once (__DIR__ . '/../lib/autoload.php');
require_once (__DIR__ . '/../lib/Madcoda/Youtube.php');
require_once (__DIR__ . '/../lib/Madcoda/Youtube/Constants.php');

use Madcoda\Youtube;

class CTX_YouTube {
	private $youtube;
	static function init ($key) {
		return new Youtube(array('key' => $key));
	}
}

$context['YT'] = CTX_YouTube::init('AIzaSyBEzG7sfgD09TikOg4gxdq2mmYNQl2Pk4k');