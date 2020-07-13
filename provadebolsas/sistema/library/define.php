<?php
	if ($_SERVER['HTTP_HOST'] == 'localhost'):
		define('HOST', 'localhost');
		define('USER', 'root');
		define('PASS', '');
		define('DBNAME', 'fam');
	else:
		define('HOST', 'localhost');
		define('USER', 'fam');
		define('PASS', 'hXWkLvJpQ&#9jSueR?5N');
		define('DBNAME', 'fam_lp');
	endif;
