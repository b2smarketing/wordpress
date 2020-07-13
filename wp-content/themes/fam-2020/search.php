<?php
/**
 * Search results page
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since   Timber 0.1
 */

// Don't allow empty search!
if (empty(trim($_GET['s']))) {
	header ('Location: /');
	exit;
}

$templates = array( 'search.twig', 'archive.twig', 'index.twig' );
$context = Timber::get_context();

$context['title'] = 'Search results for '. get_search_query();
$context['posts'] = Timber::get_posts();

Timber::render( $templates, $context );
