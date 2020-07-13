<?php
	require_once 'define.php';
    $pdo = new PDO("mysql:host=".HOST.";dbname=".DBNAME, USER, PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);