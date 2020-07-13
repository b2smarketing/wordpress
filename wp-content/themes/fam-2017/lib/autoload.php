<?php

function __autoload($class_name) {
	require_once(__DIR__ . "/$class_name.php");
}

?>