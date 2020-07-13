<?php

/**
 * Arquivo de contextos globais
 * Matt Pratta, 2017
 */

// Preloader

$dir_ctx = __DIR__ . '/ctx';
if (is_dir($dir_ctx)) {
	$dh = opendir ($dir_ctx);
	while ($file = readdir ($dh)) {
		if ($file == '.' || $file == '..') continue;

		include_once ($dir_ctx . '/' . $file);
	}
	closedir ($dh);
}

// Edit below this line.

$context['categories'] = Timber::get_terms('category');
$context['tags'] = Timber::get_terms('tag');

$context['menu'] = new TimberMenu('Principal');
$context['menu_rodape'] = new TimberMenu('Rodape');