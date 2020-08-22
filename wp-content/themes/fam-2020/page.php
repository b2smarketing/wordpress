<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * To generate specific templates for your pages you can use:
 * /mytheme/views/page-mypage.twig
 * (which will still route through this PHP file)
 * OR
 * /mytheme/page-mypage.php
 * (in which case you'll want to duplicate this file and save to the above path)
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */

$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;

// inserir os videos automaticos no array context , pesquisar array_push

/*
if ($post->post_name == "clube-de-vantagens-fam") {
    $args = array(
        // Get post type project
        'post_type' => 'parceiro',
        // Get all posts
        'posts_per_page' => -1
    );
    $posts = Timber::get_posts( $args );
    $context['parceiros'] = $posts;
}
else if ($post->post_name == "encontrocomeducadores-famtalks") {
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: https://conteudo.vestibularfam.com.br/encontro-com-educadores-fam-talks");
    exit();
}
else if ($post->post_name == "megadescontofam") {
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: https://megadesconto2019.vestibularfam.com.br/");
    exit();
}
*/
Timber::render( array( 'page-' . $post->post_name . '.twig', 'page.twig' ), $context );