<?php
/**
 * The Template for displaying all single posts
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */

$context = Timber::get_context();
$post = Timber::query_post();
$context['post'] = $post;

// Posts recentes
if ($post->post_type == 'post') {
	$recentes = Timber::get_posts(array(
		'post_type' => 'post',
        'post__not_in' => array($post->ID),
		'posts_per_page' => 4,
		
		// Exibir posts relacionados (mesma categoria)
		'category__in' => wp_get_post_categories($post->ID)
	));

	$context['posts_recentes'] = $recentes;
}

if ( post_password_required( $post->ID ) ) {
	Timber::render( 'single-password.twig', $context );
} else {
	Timber::render( array( 'single-' . $post->ID . '.twig', 'single-' . $post->post_type . '.twig', 'single.twig' ), $context );
}
